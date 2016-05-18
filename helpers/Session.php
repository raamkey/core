<?php
/**
 * Session Class.
 *
 * @author Ramki A - kvraamkey@outlook.com
 *
 * @version 1.0
 * @date July 05, 2016
 * 
 */
class Session 
{
	 
	private static $sessionStarted = false;
	
    public static function init()
    {
        if (self::$sessionStarted == false) {
            session_start();
            self::$sessionStarted = true;
        }
    }

	public static function set($name , $value) {
		return $_SESSION[$name] = $value;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function remove($name) {
		if (self::has($name)) {
			unset($_SESSION[$name]);
		}
	}

	public static function has($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}
	public static function all() {
		return $_SESSION;
	}
	public static function flesh($name , $string = "") {
		if(self::has($name)){
			$sessionName = self::get($name);
			self::remove($name);
			return $sessionName;
		} else {
			self::set($name , $string);
		}
	}
}