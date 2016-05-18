<?php
namespace App\Helpers;
/**
* 
*/
class Hash 
{
	
	public static function make($str){
		return hash('sha256', $str);
	}
	public static function saltLength()	{
		return mcrypt_create_iv(50);
	}
	public static function unique()	{
		return self::make(uniqid());
	}

}