<?php

class User{

     private $_db;
     private $_config;
     private $_data;
     private $_session_name;
     private $_cookie_name;
     private $_cookie_duration;
     private $_isLogedIn;

     public function __construct($userId = null){
          $this->_config = Config::get('session');
          $this->_session_name = $this->_config['session']['session_name'];
          $this->_cookie_name = $this->_config['remember']['cookie_name'];
          $this->_cookie_duration = $this->_config['remember']['cookie_expiry'];
          $this->_db = DB::getInstance();

          if (!$userId) {
               if (Session::exists($this->_session_name)) {
                    $user = Session::get($this->_session_name);

                    if ($this->find($user)) {
                         $this->_isLogedIn = true;
                    }else {
                         $this->_isLoggedIn = false;
                    }
               }
          }else {
               $this->find($userId);
          }
     }

     public function create($fields = array()){
          if (!$this->_db->insert('users', $fields)) {
               throw new Exception("There was a problem creating an account");
          }
     }

     public function find($userIdentification){
          if ($userIdentification) {
               $field = (is_numeric($userIdentification)) ? 'id' : 'username';
               $data = $this->_db->get('*', 'users', [$field, '=', $userIdentification]);

               if ($data->getCount()) {
                    $this->_data = $data->getFirst();
                    return true;
               }
          }
          return false;
     }

     public function login($username = null, $password = null, $remember = null){

          if (!$username && !$password && $this->exists()) {
               Session::put($this->_session_name, $this->data()->id);
               return true;
          }else {
               $user = $this->find($username);

               if ($user) {
                       //Password from database === Hash Password
                    if ($this->data()->password === Hash::make($password, $this->data()->salt) && $this->data()->username === Input::get('username')) {
                         Session::put($this->_session_name, $this->data()->id);

                         if ($remember) {
                              $hash = Hash::unique();
                              //Check if there is a record in database from table sessions for user
                              $hashCheck = $this->_db->get('hash', 'sessions', ['user_id', '=', $this->data()->id]);
                              //If there is not a record put him in sessions table
                              if (!$hashCheck->getCount()) {
                                   $this->_db->insert('sessions', [
                                        'hash'    => $hash,
                                        'user_id' => $this->data()->id
                                   ]);
                              }else {
                                   $hash = $hashCheck->getFirst()->hash;
                              }
                              Cookie::put($this->_cookie_name, $hash, $this->_cookie_duration);
                         }
                         return true;
                    }
               }
          }
          return false;
     }

     public function logout(){
          $this->_db->delete('sessions', ['user_id', '=', $this->data()->id]);
          Session::delete($this->_session_name);
          Cookie::delete($this->_cookie_name);
          session_destroy();
     }

     public function exists(){

         return (!empty($this->_data)) ? true : false;
     }

     public function data(){
          return $this->_data;
     }

     public function check(){
          return $this->_isLogedIn;
     }
}

?>
