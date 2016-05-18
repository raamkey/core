<?php
/**
* 
*/
class Router
{
	protected static 
            $url ,
            $routes = [];
	
	public static function __callStatic($name, $arguments)  {
        $path = $arguments[0];
        $callable = $arguments[1];
        $route = new Route($path , $callable);
        self::$routes[strtoupper($name)][] = $route;
    }

    public static function ParseUrl(){
        $url = $_GET['url'];
        $_routes = self::$routes[$_SERVER['REQUEST_METHOD']];
       if(!isset($_routes)){
            throw new RouterException("REQUEST_METHOD not exit");
        }
        foreach ($_routes as $key => $route) {
            if($route->match($url)){
                return $route->call();   
            }
        }
        show_error("No Routes Matches");
    }
}