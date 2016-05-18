<?php
	if (!function_exists('escape')) {
		function escape($string){
			return htmlentities($string, ENT_QUOTES, 'UTF-8');
		}
	}

	if (!function_exists('redirect')) {
		function redirect($location = null)	{
			if ($location) {
				header("Location:{$location}");
				exit();
			}
		}
	}
	if (!function_exists('responce_json')) {
		function responce_json($array)	{
			return json_encode($array);
		}
	}
	if (!function_exists('obj')) {
		function obj($array)	{
			if(is_array($array)){
				return (object)$array;
			} else {
				show_error("not object");
			}
		}
	}
	if (!function_exists('seoUrl')) {
		function seoUrl($url , $en = true)	{
			if ($en) {
				return str_replace(' ', '-', strtolower($url));
			} else {
				return ucwords(str_replace('-', ' ', $url));
			}
		}
	}
	
	if (!function_exists('show_error')) {
		function show_error($error){
			echo "<div style='width: 600px;position: relative;left: 0px;right: 0px;top: 40%;bottom: 0px;margin: auto;max-width: 100%;max-height: 100%;overflow: auto;line-height: 25px;font-size: 18px;text-align: center;font-family: sans-serif;'>{$error}</div>"; die();
		}
	}
	if (!function_exists('getImage')) {
		function getImage($imgUrl) {
			return  'http://ntpl.workstaging.com/boat.bak/inc/helpers/containerBridge.php?path='.urlencode($imgUrl);
		}
	}
	if (!function_exists('oldInput')) {
		function oldInput($field){
			return (empty($_POST[$field])) ? '' : $_POST[$field];
		}
	}

	if (!function_exists('csrf_token')) {
		function csrf_token(){
			return "<input type='hidden' name='_token' value='".Token::generate()."'>".PHP_EOL;
		}
	}

	if(!function_exists('view')){
		function view($path , $datas=[]){
			$file_path_name =view_path.str_replace('.','/',$path).".phtml";
			if(file_exists($file_path_name)){
				extract($datas);
				include "{$file_path_name}";
			}
			else{show_error('View Not Found');}
		}
	}

	if(!function_exists('URL')){
		function URL($url = ''){
			return sprintf("%s://%s%s",
			    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'],'/boats/'
			).$url;
		}
	}

	if(!function_exists('import')){
		function import($file,$datas=null) {
			$file_path_name =view_path.str_replace('.','/',$file).".phtml";
			if(file_exists($file_path_name)){
				if(!is_null($datas)){
					extract($datas);
				}
				include "{$file_path_name}";
			}
			else{show_error('View Not Found');}
		}
	}

	if (!function_exists('asset')) {
		function asset($type , $files) {
			switch ($type) {
				case 'css':
					foreach ($files as $value) {
						echo '<link rel="stylesheet" type="text/css" href="'.URL("public/css/{$value}.css").'">'.PHP_EOL;
					}
				break;
				case 'js':
					foreach ($files as $value) {
						echo '<script type="text/javascript" src="'.URL("public/js/{$value}.js").'"></script>'.PHP_EOL;
					}
				break;
				case 'img':
					 echo URL("public/images/{$files}");
				break;
			}
		}
	}