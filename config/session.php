<?php

return[
     'remember' => [
          'cookie_name' => 'hash',
          'cookie_expiry' => 604800 // One week in seconds
     ],
     'session' => [
          'session_name' => 'user',
          'session_token_name' => 'token'
     ]
]

?>
