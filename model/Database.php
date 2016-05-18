<?php
namespace App\Model;
use App\Config\Config as Config;
use FileMaker;
use Illuminate\Database\Capsule\Manager as Capsule;

	/**
	* 
	*/
	class Database extends FileMaker
	{
		protected $conf;
		function __construct()	{
			$conf = Config::getInstance();
			$this->conf = $conf;
			if($conf->get('default') == 'filemaker'){
				$this->fm_connect();
			}
			if($conf->get('default') == 'mysql'){
				/**
				 * Configure the database and boot Eloquent
				 */
				$this->mysql_connect();
			}
		}
		public function fm_connect() {
			parent::__construct($this->conf->get('connections.filemaker.name'), $this->conf->get('connections.filemaker.host'),$this->conf->get('connections.filemaker.username'), $this->conf->get('connections.filemaker.password'));
			$connected = $this->listLayouts();
			if($this->isError($connected)):
				show_error($connected->getMessage());
			endif;
		}
		public function mysql_connect()	{
				$mysql = "connections.{$this->conf->get('default')}";
				$capsule = new Capsule;
				 $capsule->addConnection([
			        'driver'    => 'mysql',
			        'host'      => 'localhost',
			        'database'  => 'tickets_web',
			        'username'  => 'root',
			        'password'  => '',
			        'charset'   => 'utf8',
			        'collation' => 'utf8_unicode_ci',
			        'prefix'    => '',
			    ]);
				$capsule->setAsGlobal();
				$capsule->bootEloquent();
				// set timezone for timestamps etc
				date_default_timezone_set('UTC');
		}
	}
?>