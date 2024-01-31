<?php
require __DIR__ . '/includes/classes/session.php';
global $database, $session;

require 'title.php';
 $firstValue = "";
   $phone = "";
   $location = "";
   $profession = ""; 
if(isset($_POST['search'])){
   $postValue= $_POST['search'];
 
   $values= explode(",", $postValue);
   
   $arrayCount = count($values);
 if($arrayCount > 1){
         $firstValue = $values[0];
   $phone = $values[1];
   $location = $values[2];
   $profession = $values[3]; 
   
 }else{
     $firstValue = $values[0];
 }
 
   

   
}
  



?>
<head>
    <title><?php ?></title>
</head>

<?php
if (($session->isEmployee()) && ($session->logged_in)) {
    require 'headerUser.php';
    ?>
    <div class="w3-container">
        <?php
          if($arrayCount == 1){
        $database->getRawSearch($firstValue);
    }else{
      $database->getSearchUsername($phone);
    }
        ?>
    </div><?php
    } elseif (($session->isEmployer()) && ($session->logged_in)) {
    require 'headerEmployer.php';
    ?>
    <div class="w3-container">
        <?php
          if($arrayCount == 1){
        $database->getRawSearch($firstValue);
    }else{
      $database->getSearchUsername($phone);
    }
        ?>
    </div><?php
    } else {
        require 'headerGuest.php';
        ?>
    <div class="w3-container">
    <?php
    if($arrayCount == 1){
        $database->getRawSearch($firstValue);
    }else{
      $database->getSearchUsername($phone);
    }
    
    ?>
    </div>
        <?php
    }
    ?>


<?php
include 'footer.php';

