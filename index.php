<?php
require __DIR__ . '/includes/classes/session.php';
global $database, $session;
include 'title.php';
?>

    <?php
//There should be something in this gab. Don't hesitate to call on mei


    if  (($session->isEmployee()) && ($session->logged_in)) {
        require 'headerUser.php';
        ?>
        <div class = "w3-container">


            <div class = "jumbotron center-block"> 
                <div class="labour-jumbotron">
                    <h1>Hupgo Labour</h1>
                    <p>Together, We Build!!!.</p>


                </div>
            </div>





            <br>
            <?php
            $database->getProfessionTab();
            $database->getLimitEmployeeTab($session->username);

            $database->getLimitEmployers($session->username);
            include 'footer.php';
            ?></div><?php
        } else if(($session->isEmployer()) && ($session->logged_in)) {
        require 'headerEmployer.php';
        ?>
        <div class = "w3-container">


            <div class = "jumbotron center-block"> 
                <div class="labour-jumbotron">
                    <h1>Hupgo Labour</h1>
                    <p>Together, We Build!!!.</p>


                </div>
            </div>





            <br>
            <?php
            $database->getProfessionTab();
            $database->getLimitEmployeeTab($session->username);

            $database->getLimitEmployers($session->username);
            include 'footer.php';
            ?></div><?php
        } else {
            require 'headerGuest.php';
            ?>
        <div class = "w3-container ">


            <div class = "jumbotron center-block"> 
                <div class="labour-jumbotron">
                    <h1>Hupgo Labour</h1>
                    <p>Together, We Build!!!.</p>


                </div>
            </div>
            <br>
    <?php
    
    $database->getProfessionTab();
    $database->getLimitEmployeeTab($session->username);
   $database->getLimitEmployers($session->username);
    include 'footer.php';
    ?></div><?php
        }
        
        ?>



<script>
    $(function () {
        $("[data-toggle = 'tooltip']").tooltip();
    });
</script>
</body>
</html>
