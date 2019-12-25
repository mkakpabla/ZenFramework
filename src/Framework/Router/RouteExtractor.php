<?php


namespace Framework\Router;

use ReflectionException;

class RouteExtractor
{

    /**
     * @var string
     */
    private $directory;


    /**
     * @var array
     */
    private $classList = [];

    /**
     * the routes found in the class annotations
     *
     * @var array
     */
    private $routes = [];

    /**
     * @var string
     */
    private $cacheFile = "routes.cache";

    /**
     * @var bool|null
     */
    private $cache;


    /***
     * Reader constructor.
     * @param string $controllerPath
     * @param string|null $cache
     */
    public function __construct(string $controllerPath, ?string $cache = null)
    {
        $this->directory = $controllerPath;
        $this->cache = $cache;
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function run(): array
    {
        /**
         * On verifie si le cache est définie ou pas
         *      si oui on recupère les routes des dossiers indiqués
         *      si non on recupère les routes du cache
         */
        if ($this->cache === null || !file_exists($this->cache . DIRECTORY_SEPARATOR . $this->cacheFile)) {
            $this->calculateclassList();
            $this->buildRoutes();
        } else {
            $fileContent = file($this->cache . DIRECTORY_SEPARATOR . $this->cacheFile)[0];
            $this->routes = unserialize(urldecode($fileContent));
        }
        return $this->routes;
    }

    /**
     * Recupere tous les class controller et insert dans $this->classList
     */
    private function calculateclassList(): void
    {
        $directoryIterator = new \RecursiveDirectoryIterator(realpath($this->directory));
        $interator = new \RecursiveIteratorIterator($directoryIterator);
        $filter = new \RegexIterator(
            $interator,
            '/^.+Controller\.php$/i',
            \RecursiveRegexIterator::GET_MATCH
        );

        // Parcourir tous les fichiers trouvés
        foreach ($filter as $fileName => $foo) {
            // Récupération du contenu du fichier
            $classContent = file_get_contents($fileName);
            
            // Recupération du namespace de la class
            preg_match("/\s+namespace\s+(.*?);/i", $classContent, $classNamespace);
            // Récupération du nom de la class
            preg_match("/\s+class\s+(.*?)[\s{]/i", $classContent, $className);
            // Ajout de de class à $this->classList
            $this->classList[] = trim($classNamespace[1]) . "\\" . trim($className[1]);
        }
    }

    /**
     * Construit les routes suivant les annotations
     *
     * @throws ReflectionException
     */
    private function buildRoutes(): void
    {
        foreach ($this->classList as $className) {
            $classReflection = new \ReflectionClass($className);
            foreach ($classReflection->getMethods() as $method) {
                $methodReflection = new \ReflectionMethod($method->class, $method->name);
                $methodComment = $methodReflection->getDocComment();
                if ($methodComment !== false) {
                    $action = "\\" . $method->class . "#" . $method->name;
                    preg_match_all(
                        "/@Route[(]([a-zA-Z']+)(,\s+)([a-zA-Z'\/{}]+)(,\s+)([a-zA-Z.'\/]+)/i",
                        $methodComment,
                        $matches,
                        PREG_SET_ORDER
                    );
                    foreach ((array)$matches as $match) {
                        $routeMethod = trim(strtolower($match[1]), "'");
                        $routeName = trim(strtolower((string)$match[5]), "'");
                        $routeMethodUri = trim(strtolower($match[3]), "'");
                        if (isset($baseRoute)) {
                            $routeUri = preg_replace("/\/{2,}/is", "/", $baseRoute . $routeMethodUri);
                        } else {
                            $routeUri = preg_replace("/\/{2,}/is", "/", $routeMethodUri);
                        }
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
                        ];
                    }
                }
            }
        }

        // Verifier si le cache est définie si oui mettre en cache si non on fait rien
        if ($this->cache !== null) {
            file_put_contents($this->cache . DIRECTORY_SEPARATOR . $this->cacheFile, urlencode(serialize($this->routes)));
        }
    }
}