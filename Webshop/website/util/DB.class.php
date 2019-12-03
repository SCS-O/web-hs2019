<?php
/*
 * Singleton class copied from slides
 * Author: Locher Philipp
 * Slide 31: http://www.sws.bfh.ch/~locher/webprog/pdf/topic09.pdf
 */
class DB extends mysqli{


    static private $instance;
    
	
	static public function create($host, $user, $pw, $dbname) {
		@self::$instance = new DB($host, $user, $pw, $dbname);
		return self::$instance->connect_errno == 0;
	}

    static public function getInstance() 
    {
        if ( !self::$instance ) {
            @self::$instance = new DB();
            if(self::$instance->connect_errno > 0){
                die("Unable to connect to database [".self::$instance->connect_error."]");
            }
        }
        return self::$instance;
    }

    static public function doQuery($sql) {
        //TODO: May do some exception handling right here
        //TODO: Prevent some injection possibilities
        return self::getInstance()->query($sql);
    }


	public function __construct($host, $user, $pw, $dbname) {
		parent::__construct($host, $user, $pw, $dbname);
	}
}