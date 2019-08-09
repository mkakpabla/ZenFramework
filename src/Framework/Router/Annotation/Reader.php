<?php

namespace Framework\Router\Annotation;

class Reader implements ReaderInterface
{

    /**
     * @var array
     */
    private $directories = [];



    /**
     * @var array
     */
    private $classlist = [];

    /**
     * the routes found in the class annotations
     *
     * @var array
     */
    private $routes = [];

    /**
     * @var string
     */
    private $cacheFile = "routes.php";

    /**
     * @var bool|null
     */
    private $cache;


    /***
     * Reader constructor.
     * @param array $directories
     * @param string|null $cache
     */
    public function __construct(array $directories, ?string $cache = null)
    {
        $this->directories = $directories;
        $this->cache = $cache;
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function run(): void
    {
        /**
         * On verifie si le cache est définie ou pas
         *      si oui on recupère les routes des dossiers indiqués
         *      si non on recupère les routes du cache
         */
        if ($this->cache === null || !file_exists($this->cache.DIRECTORY_SEPARATOR. $this->cacheFile)) {
            $this->calculateClassList();
            $this->buildRoutes();
        } else {
            $this->routes =  require $this->cache.DIRECTORY_SEPARATOR. $this->cacheFile;
        }
    }

    /**
     * Recupere tous les class controller et insert dans $this->classList
     */
    private function calculateClassList(): void
    {

        // walk through all the directories
        foreach ($this->directories as $directory) {
            // and look for files ending with "{$this->classPostfix}.php"

            $directoryIterator = new \RecursiveDirectoryIterator(realpath($directory));

            $interator = new \RecursiveIteratorIterator($directoryIterator);

            $filter = new \RegexIterator(
                $interator,
                '/^.+Controller\.php$/i',
                \RecursiveRegexIterator::GET_MATCH
            );
            // walk through all the controller files and build up a list of classes
            foreach ($filter as $fileName => $foo) {
                // fetch the namespace and the class name
                $classContent = file_get_contents($fileName);

                preg_match("/\s+namespace\s+(.*?);/i", $classContent, $classNamespace);
                preg_match("/\s+class\s+(.*?)[\s{]/i", $classContent, $className);
                // and add it to the class list
                $this->classlist[] = trim($classNamespace[1]) . "\\" . trim($className[1]);
            }
        }
    }


    /**
     * builds the routes out of the class annotations
     *
     * @throws \ReflectionException
     */
    private function buildRoutes(): void
    {
        // walk through the class list
        foreach ($this->classlist as $className) {
            // and build a new reflection class object
            $classReflection = new \ReflectionClass($className);

            // now preg through the class comment and get the base route
            if ($classReflection->getDocComment() !== false) {
                preg_match("/@GroupRoute\s+(.*?)\s/i", $classReflection->getDocComment(), $baseRoute);
                $baseRoute = $baseRoute[1];
                // and the base middlewares
                $baseMiddlewares = [];
                $middlewares = [];
                preg_match_all(
                    "/@Middleware\s+(.*?)\s+/i",
                    $classReflection->getDocComment(),
                    $middlewares,
                    PREG_SET_ORDER
                );
                foreach ($middlewares as $middleware) {
                    $baseMiddlewares[] = trim($middleware[1]);
                }
            }

            // walk through all the methods
            foreach ($classReflection->getMethods() as $method) {
                // reflect on the method
                $methodReflection = new \ReflectionMethod($method->class, $method->name);
                $methodComment = $methodReflection->getDocComment();

                // check if this is an "...Action" method and if a docblock for this method exists
                if ($methodComment !== false) {
                    $action = "\\".$method->class . "#" . $method->name;

                    // initialize
                    if (isset($baseMiddlewares)) {
                        $middlewares = $baseMiddlewares;
                        $methodMiddlewares = [];
                    } else {
                        $middlewares = [];
                        $methodMiddlewares = [];
                    }

                    // Récupérer les middlewares
                    preg_match_all("/@Middleware\s+(.*?)\s+/i", $methodComment, $methodMiddlewares, PREG_SET_ORDER);
                    foreach ((array)$methodMiddlewares as $methodMiddleware) {
                        $middlewares[] = $methodMiddleware[1];
                    }
                    $middlewares = array_unique($middlewares);

                    // get the method comment and fetch the route
                    preg_match_all(
                        "/@Route[(]([a-zA-Z']+)(,\s+)([a-zA-Z'\/{}]+)(,\s+)([a-zA-Z.'\/]+)/i",
                        $methodComment,
                        $matches,
                        PREG_SET_ORDER
                    );

                    foreach ((array)$matches as $match) {
                        // clean route part, method and name values (cast name to string, because it can be NULL)
                        if ($match[3] == "/") {
                            $comment[3] = "";
                        }

                        $routeMethod = trim(strtolower($match[1]), "'");
                        $routeName = trim(strtolower((string)$match[5]), "'");
                        $routeMethodUri = trim(strtolower($match[3]), "'");
                        if (isset($baseRoute)) {
                            $routeUri = preg_replace("/\/{2,}/is", "/", $baseRoute . $routeMethodUri);
                        } else {
                            $routeUri = preg_replace("/\/{2,}/is", "/", $routeMethodUri);
                        }

                        // Vérifier s'il n'y as pas de collision entre l'es uri et les nms des routes
                        array_walk(
                            $this->routes,
                            function ($route, $key) use ($routeMethod, $routeName, $routeUri, $action) {
                                // Virification de l'uri
                                if ($route["method"] === $routeMethod && $route["route"] === $routeUri) {
                                    throw new \Exception(
                                        "Route collision detected: " . $routeMethod . " " . $routeUri . " in " . $action
                                    );
                                }
                                // Virification du name
                                if ($route["name"] === $routeName && $routeName !== "") {
                                    throw new \Exception(
                                        "Route name collision detected: "
                                        . $routeMethod . " " . $routeUri . " in " . $action
                                    );
                                }
                            }
                        );

                        $this->routes[] = [
                            "method" => $routeMethod,
                            "route" => $routeUri,
                            "action" => $action,
                            "name" => $routeName,
                            "middlewares" => $middlewares
                        ];
                    }
                }
            }
        }

        // Verifier si le cahe est définie si oui mettre en cache si non on fait rien
        if ($this->cache !== null) {
            file_put_contents($this->cache.DIRECTORY_SEPARATOR. $this->cacheFile, $this->routes);
        }
    }

    /**
     * Retourne la liste des routes detecter en tableau
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
