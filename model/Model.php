<?php
namespace App\Model;
use App\Model\Database;
class Model extends Database{
	public static $layout_name;
	function __construct() {
		parent::__construct();
		/*self::$layout_name = explode('_model',mb_strtolower($table));
		self::$layout_name = self::$layout_name[0]; */
		$this->db = new Database();
	}
}