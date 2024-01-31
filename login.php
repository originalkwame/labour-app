<?php
require __DIR__ . '/includes/classes/session.php';
global $database, $session;

require 'title.php';

if (($session->isEmployee()) && ($session->logged_in)) {
    header("Location: index.php");
} else if (($session->isEmployer()) && ($session->logged_in)) {
    header("Location: index.php");
}else {
    require 'headerGuest.php';
    ?>
<div class="container">
        <div class="login-former">
            <form id="loginForm"  action="process.php" method="post">


                <div class="welcome-message">
                    <img src="images/laboroffice.png" alt="logo"/>
                    

                </div>
               

                <div class="form-group">
                    <label class="sr-only">User Phone or Email</label>
                    <div class="input-group input-append">
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="pro-credentials" id="pro-credentials" placeholder="Mobile Number or Email"/>
                    </div>
                </div>
                <div class="form-group"><label class="sr-only"> Password</label>
                    <div class="input-group input-append">
                        <span class="input-group-addon add-on"><span class="fa fa-lock"></span></span>
                        <input type="password" name="pro-password" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="sublogin" value="1">
                    <button class="btn btn-group-lg btn-success" type="submit" value="LOG IN" id="login">LOG IN</button>
                </div>
                <div class="forgotten-pass">
                    <a href="#" >Forgot Password?</a>
                </div>
                <div class="login-create">
                    <a href="registration.php" >CREATE NEW hLABOUR ACCOUNT</a>
                </div>

            </form>
        </div>
</div>
    <?php
    require 'footer.php';
}