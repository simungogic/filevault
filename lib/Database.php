<?php
class Database extends PDO {

    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;

    public function __construct(){
        $this->engine = 'mysql';
        $this->host = DB_SERVER;
        $this->database = DB_NAME;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
}








