<?php
require __DIR__ . '/includes/classes/session.php';
global $database, $session;
$id = $_GET['id'];
$pro_name = $_GET['pro_name'];
$color = $_GET['color'];

require 'title.php';
?>
<head>
    <title><?php echo $pro_name ?></title>
</head>

<?php
if (($session->isEmployee()) && ($session->logged_in)) {
    require 'headerUser.php';
    ?>
    <div class="container">
          <div class="row">
              <div id="load_data"></div>
              
          </div>
      <div id="load_data_message"></div>
        <?php
        //$database->getEmployTab($id);
        ?>
    </div><?php
    } elseif (($session->isEmployer()) && ($session->logged_in)) {
    require 'headerEmployer.php';
    ?>
    <div class="container">
          <div class="row">
              <div id="load_data"></div>
              
          </div>
      <div id="load_data_message"></div>
        <?php
        //$database->getEmployTab($id);
        ?>
    </div><?php
    } else {
        require 'headerGuest.php';
        ?>
    <div class="container">
          <div class="row">
              <div id="load_data"></div>
              
          </div>
      <div id="load_data_message"></div>
    <?php
    //$database->getEmployTab($id);
    ?>
    </div>
        <?php
    }
    ?>


<?php
include 'footer.php';
?>
<script>
 
$(document).ready(function(){
  $('#load_data_message').html("<img src='images/loading.gif'/>");
 var limit = 10;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start)
 {
     var profid = <?php echo $id?>;
  $.ajax({
   url:"includes/classes/ajaxCalls.php",
   method:"POST",
   data:{limit:limit, start:start, profid:profid},
   cache:false,
   success:function(data)
   {
        $('#load_data_message').html("");
    $('#load_data').append(data);
    if(data === '')
    {
     $('#load_data_message').html("<div  class='btn btn-link'>No More Data</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<img src='images/loading.gif'/>");
     action = "inactive";
    }
   }
  });
 }
 
 if(action === 'inactive')
 {
  action = 'active';
  load_country_data(limit, start);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action === 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start);
   }, 1000);
  }
 });
 
});
</script>

