<?php

return[
     'remember' => [
          'cookie_name' => 'hash',
          'cookie_expiery' => 604800 // Tjedan dana
     ],
     'session' => [
          'session_name' => 'user',
          'session_token_name' => 'token'
     ]
]

?>
