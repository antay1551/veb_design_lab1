<?php

class Connection {
    const DSN = 'mysql:host=localhost; dbname=lab1';
    public $dbh;
    public $user;
    public $pass;
    private static $instance;

    public static function get_instance(){
        if(!isset(self::$instance)){
            self::$instance = new self('root','');
        }
        return self::$instance;
    }

    private function __wakeup(){

    }
    private function __clone(){

    }
    private function __construct($user, $pass){
        $this->user = $user;
        $this->pass = $pass;

        try {
            $this->dbh = new PDO(
                self::DSN,
                $this->user,
                $this->pass
            );

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (PDOException $e) {
            exit ('Error connecting to database: ' . $e->getMessage());
        }

        return $this->dbh;
    }

}


