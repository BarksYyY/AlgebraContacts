<?php

class DB{
     private static $_instance = null;
     private $_config;
     private $_conn;
     private $_query;
     private $_error = false;
     private $_results;
     private $_count = 0;

     // Constructor
     private function __construct(){
          $this->_config = Config::get('database');
          $driver = $this->_config['driver'];
          $db_name = $this->_config[$driver]['db'];
          $host = $this->_config[$driver]['host'];
          $user = $this->_config[$driver]['user'];
          $pass = $this->_config[$driver]['password'];
          $charset = $this->_config[$driver]['charset'];
          $dsn = $driver . ':dbname=' .$db_name. ';host=' .$host. ';charset=' .$charset;

          try{
               $this->_conn = new PDO($dsn, $user, $pass);
          }catch (PDOException $e) {
               die($e->getMessage());
          }
     }

     // Singleton pattern
     public static function getInstance(){
          if(!self::$_instance) {
               self::$_instance = new self();
          }
          return self::$_instance;
     }
     private function query($sql, $params = array()){
          $this->_error = false;

          if($this->_query = $this->_conn->prepare($sql)){

               if (!empty($params)) {

               /* for ($i=0; $i < count($params); $i++) {
               $this->query->bindValue($i+1, $params[$i]);
               } */
               $counter = 1;
                    foreach ($params as $key => $param) {
                         $this->_query->bindValue($counter, $param);
                         $counter++;
                    }
               }
               if($this->_query->execute()){
                    $this->_results = $this->_query->fetchAll(Config::get('database')['fetch']);
                    $this->_count = $this->_query->rowCount();
               }else {
                    $this->_error = true;
               }
          }
          return $this;
     }

     private function action($action, $table, $where = array()){
          if (count($where) === 3) {
               $operators = array('=', '<', '>', '<=', '>=');

               $field = $where[0];
               $operator = $where[1];
               $value = $where[2];

                    if (in_array($operator, $operators)) {
                         $sql = "$action FROM $table WHERE $field $operator ?";

                         if (!$this->query($sql, array($value))->getError()) {
                              return $this;
                         }
                    }
          }else {
               $sql = "$action FROM $table";

               if (!$this->query($sql)->getError()) {
                    return $this;
               }
          }
          return false;
     }

     public function get($columns, $table, $where = array()){
          return $this->action("SELECT $columns", $table, $where);
     }

     public function find($id, $table){
          return $this->action("SELECT *", $table, ['id', '=', $id]);
     }

     public function delete($table, $where = array()){
          return $this->action("DELETE", $table, $where);
     }

     public function insert($table, $fields){
          $keys = implode(',', array_keys($fields));
          $field_num = count($fields);
          $values = '';
          $x = 1;

          foreach ($fields as $key => $field) {
               $values .= '?';

               if ($x < $field_num) {
                    $values .= ',';
               }
               $x++;
          }
          $sql = "INSERT INTO $table ($keys) VALUES ($values)";

          if (!$this->query($sql, $fields)->getError()) {
               return $this;
          }
          return false;
     }

     public function update($table, $id, $fields){
          $field_num = count($fields);
          $set = '';
          $i = 1;

          foreach ($fields as $key => $field) {
               $set .= "$key = ?";
               if ($i < $field_num) {
                    $set .= ', ';
               }
               $i++;
          }
          $sql = "UPDATE $table SET $set WHERE id=$id";

          if (!$this->query($sql, $fields)->getError()) {
               return $this;
          }
          return false;
     }

     public function getError(){
          return $this->_error;
     }

     public function getConnection(){
          return $this->_conn;
     }

     public function getResults(){
          return $this->_results;
     }

     public function getCount(){
          return $this->_count;
     }
}
?>
