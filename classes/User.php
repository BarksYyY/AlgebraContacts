<?php

class User{

     private $_db;
     private $_config;
     private $_data;
     private $_session_name;
     private $_isLogedIn;

     public function __construct(){
          $this->_config = Config::get('session');
          $this->_session_name = $this->_config['session']['session_name'];
          $this->_db = DB::getInstance();

          if (Session::exists($this->_session_name)) {
               $user = Session::get($this->_session_name);

               if ($this->find($user)) {
                    $this->_isLogedIn = true;
               }else {
                    // logout
               }
          }
     }

     public function create($fields = array()){
          if (!$this->_db->insert('users', $fields)) {
               throw new Exception("There was a problem creating an account");
          }
     }

     public function find($userId = null){
          if ($userId) {
               $field = (is_numeric($userId)) ? 'id' : 'username' ;
               $_data = $this->_db->get('*', 'users', [$field, '=', $userId]);

               if ($_data->count()) {
                    $this->_data = $_data->first();
                    return true;
               }
          }
          return false;
     }

     public function login($username = null, $password = null){

     }

     public function data(){
          return $this->_data;
     }

     public function check(){
          return $this->_isLogedIn;
     }
}

?>
