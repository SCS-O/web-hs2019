<?php


/*
 * Singleton class copied from slides
 * Slide 31: http://www.sws.bfh.ch/~locher/webprog/pdf/topic09.pdf
 */
class DB extends mysqli{
    const HOST = "localhost";
    const USER = "www";
    const PW = "1234";
    const DB_NAME = "meme_shop";

    static private $instance;
    
    public function __construct() {
        parent::__construct(
        self::HOST, self::USER, self::PW,self::DB_NAME);
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
        return self::getInstance()->query($sql);
    }
}