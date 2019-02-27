<?php

return [
     'fetch'   => PDO::FETCH_OBJ,
     'driver'  => 'mysql',
     'mysql'   => [
          'host'         => '127.0.0.1',
          'user'         => 'root',
          'password'     => '',
          'db'           => 'algebra_contacts',
          'charset'      => 'UTF8',
          'collation'    => 'utf8_general_ci'
     ],
     'sqlite' => [
          'db'           => ''
     ],
     'pgsql' => [
          'host'         => '',
          'user'         => '',
          'password'     => '',
          'db'           => '',
          'charset'      => 'UTF8',
          'collation'    => 'utf8_general_ci'
     ]
]

?>
