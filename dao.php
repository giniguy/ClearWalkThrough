<?php
class Dao {
private $host = "us-cdbr-iron-east-04.cleardb.net";
private $db = "heroku_912aebf8b73e1cb";
private $user = "b318bad12b27a3";
private $pass = "9f921efe";
public function getConnection () {
	return new PDO("mysql:host={$this->host};dbname={$this->db}"
	}
}