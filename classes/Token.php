<?php

class Token{

     private static $token_name;

     private function __construct(){
          self::$token_name = Config::get('session')['session']['session_token_name'];
     }
     //factory pattern
     public static function factory(){
          return new self;
     }

     public static function generate(){
          Session::put(self::$token_name, md5(uniqid()));
          return Session::get(self::$token_name);
     }

     public function check($token){
          if (Session::exists(self::$token_name) && $token === Session::get(self::$token_name)) {
               return true;
          }
          return false;
     }
}

?>
