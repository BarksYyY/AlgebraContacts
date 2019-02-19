<?php

require_once 'core/init.php';

Helper::getHeader('Algebra Contacts', 'main_header');

require 'notification.php';

?>

<div class="row">
     <div class="col-md-4 col-md-offset-4 col-lg-3">
          <div class="panel panel-primary">
               <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
               </div>
               <div class="panel-body">

                    <form method="post">
                         <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                         </div>
                         <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                         </div>
                         <div class="form-group">
                              <button type="submit" class="btn btn-primary">Sign In</button>
                         </div>
                         <p>If you don't have an account, please <a href="register.php">Register</a></p>
                    </form>

               </div>
          </div>
     </div>
</div>

<?php

Helper::getFooter();

?>
