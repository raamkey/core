<?php
namespace App\Mail;
use App\Mail\Message;
/**
* 
*/
class Mail
{
	
	public static function send($template , $data, $callback){
		$message = new Message();
		extract($data);
		ob_start();
		require "{$template}";
		$template = ob_get_clean();
		ob_end_clean();
		$message->body($template);
		call_user_func($callback , $message);
		$message->send();
	}
}