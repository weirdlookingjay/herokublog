<?php

class Database
{
    protected $pdo;
    protected static $instance;

	protected function __construct() {
		$this->pdo = new PDO("mysql:host=".getenv('JAWSDB_HOST')."; dbname=".getenv('JAWSDB_NAME'), getenv('JAWSDB_USER'), getenv('JAWSDB_PASS'));
	}

    public static function instance() {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->pdo, $method), $args);
    }
}