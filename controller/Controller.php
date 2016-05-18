<?php
namespace App\Controller;
/**
* 
*/
class Controller
{
	public function loadModel($name) {
		$path = model_path.$name.'.php';
		if (file_exists($path)) {
			require $path;
			$modelName = $name;
			$this->$name = new $modelName();
		}
		else{ show_error("Model Not Found {$path}");}		
	}
}
?>