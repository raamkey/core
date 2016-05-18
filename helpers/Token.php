<?php
namespace App\Helpers;
/**
* 
*/
class Token 
{
	
	public static function generate()	{
		return Session::set('_token',md5(uniqid()));
	}
	public static function check($token){
		$tokenName = '_token';
		if (Session::has($tokenName) && $token === Session::get($Token)) {
				Session::remove($tokenName);
				return true;
		}
		return false;
	}


}