<nav class="navbar navbar-default navbar-fixed-top navbar-xs" role="navigation">

    <div class="collapse navbar-collapse" id="contact-menu" style="margin-right: 20px;" >

        <ul class="nav navbar-nav navbar-left">
            <li><a href="tel:+233246199998"><i class="fa fa-phone">  +233246199998</i></a></li>
            <li><a href="mailto:info@hupgo.com"><i class="fa fa-envelope">  info@hupgo.com</i></a>
        </ul>

     
    </div>


</nav>

<nav class="navbar navbar-inverse labour-nav-bar">
    <div class="navbar-header">



<!--        <button type = "button" class = "navbar-toggle" 
                data-toggle = "collapse" data-target = "#example-navbar-collapse">
            <span class = "sr-only">Toggle navigation</span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>


</button>--> 
        <div class="mytoggle">
        
            <a id ="signin" href="javascript:void(0);" class="navbar-toggle login-join-cover">Log In</a>
          
            <a href="registration" class="navbar-toggle login-join-cover">Join</a>  
       
             <form class = "navbar-toggle search-form" method="post" action="searchresults" id="search-form" role = "search">

                
                        <input type = "search" id="search" name="search"  class = " input-sm form-control" placeholder = "Search">
                			
                    <button type = "submit" style="color:#2196F3; display: none;"class = "btn btn-sm"><i class="fa fa-search"></i>
                    </button>

                </form>  
            <a href="index" class=" navbar-brand"style="margin-right: 10px; font-size: 1.5em;"><i class="fa fa-home"></i></a>
        </div>
       
    </div>


    <div class = "collapse navbar-collapse" id = "example-navbar-collapse">

        <ul class="nav navbar-nav navbar-right">

           

            <li>

               
             <form class = "navbar-form search-form" method="post" action="searchresults" id="search-form" role = "search">

                
                        <input type = "search" id="search1" name="search"  class = " input-sm form-control" placeholder = "Search">
                			
                    <button type = "submit" style="color:#2196F3; display: none;"class = "btn btn-sm"><i class="fa fa-search"></i>
                    </button>

                </form>
            </li>
           <li><a href="registration" >Join</a></li>
           
          

            <li><a id ="signin1" href="javascript:void(0);" >Log In</a></li>
        </ul>
    </div>
</nav>

<div id="login-form"></div>

<?php
echo $form->error("pro-credentials");
 echo $form->error("pro-password");                        

?>


<script type="text/javascript">
    $(document).ready(function () {

    $('#signin,#signin1' ).click(function () {
    $('#login-form').append('<form id="loginForm" action="process.php" method="post">\n\
    <fieldset>\n\
<div class="form-group">\n\
<label class="sr-only">User Phone or Email</label>\n\
<div class="input-group input-append">\n\
<span class="input-group-addon add-on"><span class="glyphicon glyphicon-user"></span></span>\n\
<input type="text" class="form-control" name="pro-credentials" id="pro-credentials" placeholder="Mobile Number or Email"/>\n\
</div>\n\
</div>\n\
<div class="form-group"><label class="sr-only"> Password</label>\n\
<div class="input-group input-append">\n\
<span class="input-group-addon add-on"><span class="fa fa-lock"></span></span>\n\
<input type="password" name="pro-password" class="form-control" placeholder="Password"/>\n\
</div>\n\
</div>\n\
<div class="form-group">\n\
<input type="hidden" name="sublogin" value="1">\n\
<button class="btn btn-group-lg btn-success" type="submit" value="LOG IN" id="login">LOG IN</button>\n\
</div>\n\
<div class="forgotten-pass">\n\
<a href="#" >Forgot Password?</a>\n\
</div>\n\
<div class="login-create">\n\
<a href="registration.php" >CREATE NEW hLABOUR ACCOUNT</a>\n\
</div>\n\
</fieldset>\n\
</form>');
            alertify.genericDialog || alertify.dialog('genericDialog', function () {
            return{
            main: function (content) {
            this.setContent(content);
            },
                    setup: function () {
                    return{
                    focus: {
                    element: function () {
                    return this.elements.body.querySelector(this.get('selector'));
                    },
                            select: true
                    },
                            options: {

                            basic: true,
                                    maximizable: true,
                                    resizable: false,
                                    padding: false,
                                    modal:true,
                                    movable:false,
                                    transition:'zoom',
                                    startMaximized:false
                            }
                    };
                    },
                    settings: {
                    selector: undefined
                    }
            };
            });
            alertify.genericDialog($('#loginForm')[0]).set({'selector':'input[type="text"]'});
            $('#login').click(function(){
    if ($('#pro-credentials').val() === ""){
    alertify.alert("Please Input required", "Check Input", function(){
    $('#pro-credentials').focus();
    });
            return false;
    }
    });
    });
    });
    </script>

