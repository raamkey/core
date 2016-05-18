<?php 
namespace App\Config;
/**
* 
*/
class Config
{
	private static $_instance = null;
	private $_data,
			$_default;
	public function __construct()	{
		$this->load("../app/config/config.php");
	}
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new Config();
		}
		return self::$_instance;
	}
	public function load($file)	{
		$this->_data = require $file;
	}
	public function get($key, $default = null)	{
		$this->_default = $default;
		$segments = explode('.', $key);
		$data = $this->_data;
		foreach ($segments as $segment) {
			if(isset($data[$segment])){
				$data = $data[$segment];
			} else {
				$data = $this->_default;
				break;
			}
		}
		return $data;
	}
	public function exists($key) {
		return $this->get($key) !== $this->_default;
	}
}