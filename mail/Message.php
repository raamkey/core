<?php
namespace App\Mail;
/**
* 
*/
class Message
{
	protected $from; 
	
	protected $to;

	protected $subject;

	protected $body;
	
	function __construct()	{}
	public function to($to)	{
		$this->to = $to;
		return $this;
	}
	public function from($from)	{
		$this->from = $from;
		return $this;
	}
	public function subject($subject)	{
		$this->subject = $subject;
		return $this;
	}
	public function body($body)	{
		$this->body = $body;
	}
	public function send() {
		var_dump($this);
	}
}