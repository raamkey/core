<?php
/**
* 
*/
class Route
{
	private $path;
    private $callable;
    private $matches;
    function __construct($path , $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }
    public function match($url) {
        $url = trim($url, '/');
        $path = preg_replace("#:([\w]+)#", "([^/]+)", $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url , $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }
    public function call()  {
        if(is_string($this->callable)){
            $param = explode('@', $this->callable);
            $controllerFile = controller_path."{$param[0]}.php";
            if(file_exists($controllerFile)){
                require_once $controllerFile;
                $controller = new $param[0];
                if(method_exists($controller, $param[1])){
                    return call_user_func_array([$controller, $param[1]],$this->matches); 

                } else {
                    show_error("Method Not Exit {$param[0]}::{$param[1]} ");
                }
            } else {
                show_error("{$param[0]}.php Not Found in Controller Folder");
            }
             
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }
}