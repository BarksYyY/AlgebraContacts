<!DOCTYPE html>
<html lang="hr">
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">

               <title><?php echo $title ?></title>
                    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
     </head>
     <body>
          <div class="container-fluid">
               <nav class="navbar navbar-default">
                    <div class="container-fluid">
                         <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                   <span class="sr-only">Toggle navigation</span>
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                              </button>
                              <a class="navbar-brand" href="#">Project name</a>
                         </div>
                         <div id="navbar" class="navbar-collapse collapse">
                              <ul class="nav navbar-nav">
                                   <li class="active"><a href="#">Home</a></li>
                                   <li><a href="#">About</a></li>
                                   <li><a href="#">Contact</a></li>
                                   <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                             <li><a href="#">Action</a></li>
                                             <li><a href="#">Another action</a></li>
                                             <li><a href="#">Something else here</a></li>
                                             <li role="separator" class="divider"></li>
                                             <li class="dropdown-header">Nav header</li>
                                             <li><a href="#">Separated link</a></li>
                                             <li><a href="#">One more separated link</a></li>
                                        </ul>
                                   </li>
                              </ul>
                              <ul class="nav navbar-nav navbar-right">
                                   <?php

                                   $user = new User();
                                   if ($user->check()) {

                                   ?>
                                   <!-- When User is Logged In-->
                                   <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                             <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $user->data()->username ?> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                             <li> <a href="logout.php">Logout</a></li>
                                        </ul>
                                   </li>
                                   <?php

                                   }else{

                                   ?>
                                        <!-- When User in Not Logged In-->
                                        <li><a href="login.php">Sign In</a></li>
                                        <li><a href="register.php">Sign Up</a></li>
                                   <?php

                                   }
                                   
                                   ?>
                              </ul>
                         </div>
                    </div>
               </nav>
