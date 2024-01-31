<?php
    echo $sform->successss("log_success");
     $splitImage = explode(",", $session->userinfo['image']);
             $bigImage = $splitImage[0];
             $smallImage = $splitImage[1];
    ?>
<nav class="navbar navbar-default navbar-fixed-top navbar-xs" role="navigation">

    <div class="collapse navbar-collapse" id="contact-menu" style="margin-right: 20px;" >

        <ul class="nav navbar-nav navbar-left">
            <li><a href="tel:+23324619998"><i class="fa fa-phone">  +233246199998</i></a></li>
            <li><a href="mailto:info@hupgo.com"><i class="fa fa-envelope">  info@hupgo.com</i></a>
        </ul>

      
    </div>
  

</nav>

<div id="mySidenav" class="sidenav">
    
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" >&times;</a>
  
    <div class="logged-in-profile">
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <img src=" <?php echo $smallImage;     ?>" alt="User Image">
         </div>
        
       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<label><?php echo $session->userinfo['first_name']." ".$session->userinfo['surname'] ?></label>
           </div>
       </div>
       
    </div>
    <a href="index"><i class="fa fa-home"></i>Home</a>   
    <a href="employers"><i class="fa fa-user"></i>Employers</a>   
   
    <a href="setting"><i class="fa fa-gears"></i>Settings</a>
    <a href="#"><i class="fa fa-database"></i>About</a>
    <a href="#" ><i class="fa fa-support"></i>Help</a>
    <a href="process" ><i class="fa fa-power-off"></i>Logout</a>
     
</div>

<nav class="navbar navbar-inverse labour-nav-bar">
    
       
    <div class="container">
    <div class="row">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <a href="#" class="login-user-menu" ><i class="fa fa-bars" id = "openBtn" onclick="openNav()"></i></a>  
    </div>


      
           
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <form class="login-user-search-form search-form" method="post" action="searchresults"  id="search-form" role = "search">
       
           
            
                    <div class="input-group input-append">
                        <input type = "search" name="search" id="search" class = "mysearch form-control" placeholder = "Search">
                        <span class="input-group-addon add-on"><button type="submit" ><i class="fa fa-search"></i></button></span>
                    </div>
           
           
               
                </form>  
</div>
    </div>
    </div>
</nav>
      
    
    
</nav>
    
  
  <script type="text/javascript">
    function openNav(){
document.getElementById("mySidenav").style.width = "250px";
}

function closeNav(){
    document.getElementById("mySidenav").style.width = "0px";
}



</script> 



