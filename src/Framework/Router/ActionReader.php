<?php


namespace Framework\Router;


use ReflectionException;

class ActionReader
{

    private $routes = [];

    /**
     * builds the routes out of the class annotations
     *
     * @param string $action
     * @return array
     * @throws ReflectionException
     */
    public function buildRoutes(string $action): array
    {
        // and build a new reflection class object
        $classReflection = new \ReflectionClass($action);
        // now preg through the class comment and get the base route
        if ($classReflection->getDocComment() !== false) {
            preg_match("/@Group\s+(.*?)\s/i", $classReflection->getDocComment(), $baseRoute);
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
                    ];
                }
            }
        }
        return $this->routes;
    }

}