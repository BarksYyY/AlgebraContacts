<?php

class DB{

     private static $_instance = null;
     private $_config;
     private $_conn;
     private $_query;
     private $_error = false;
     private $_result;
     private $_count = 0;

     // Constructor
     private function __construct(){

          $this->config = Config::get('database');

          $driver = $this->config['driver'];
          $db_name = $this->config['driver']['db'];
          $host = $this->config['driver']['host'];
          $user = $this->config['driver']['user'];
          $pass = $this->config['driver']['pass'];
          $dsn = $driver. 'db_name=' .$db_name. 'host=' .$host;

          try {
               $this->conn = new PDO($dsn, $user, $pass);
          } catch (PDOException $e) {
               die($e->getMessage());
          }

     }
     //Singletone pattern
     public static function getInstance(){
          if (!self::$instance) {
               self::$instance = new self();
          }
          return self::$instance;
     }

     public function query($sql, $params = array()){
          $this->error = false;
          $this->_query = $this->conn->prepare($sql);

          if(!empty($params)){

               for ($i=1; $i < count($params); $i++) {
                    $this->_query->bindValue($i, $params[$i-1]);
               }

          }else{

          }
     }

     private function action(){

     }

     public function get(){

     }

     public function find(){

     }

     public function delete(){

     }

     public function insert(){

     }

     public function update(){

     }

     public function getConnection(){
          return $this->_conn;
     }

     public function getError(){
          return $this->_error;
     }

     public function getresults(){
          return $this->_results;
     }

     public function getCount(){
          return $this->_count;
     }
}

?>
