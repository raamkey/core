<?php
namespace App\Helpers;
/**
* 
*/
class Validator
{
	public static $_errors = [];
	public static function check($postValue , $items=[])	{
		foreach ($items as $item => $rules) {
			foreach (explode('|', $rules) as $rule) {
				$value = $postValue[$item];
				if($rule === "required" && empty($value)){
					self::addError("{$item} is required");
				} else if (!empty($value)){
					switch ($rule) {
						case strpos($rule, 'min') !== false :
							$max = explode(':', $rule);
							if(strlen($value) < $max[1]){
								self::addError("{$item} must be a minimum of {$max[1]}");
							}
						break;
						case strpos($rule, 'max') !== false :
							$max = explode(':', $rule);
							if(strlen($value) > $max[1]){
								self::addError("{$item} must be a maximum of {$max[1]}");
							}
						break;
					}
				}
			}
		}
		if(empty(self::$_errors)){}
		return new static;
	}
	public static function addError($get_error){
		self::$_errors[] = $get_error;
	}
	
	public static function all() {
		return self::$_errors;
	}

	public static function fails() {
		$errors = count (self::$_errors);
		return (empty(self::$_errors)) ? false : true;
	}
}