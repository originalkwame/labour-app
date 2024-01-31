<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="maximum-scale=1, initial-scale=1, user-scalable=no, minimal-ui">
        
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="mobile-web-app-capable" content="yes">
     
        <link rel="icon" type="image/icon" href="images/laboroffice.png"/>
            
        <script type="text/javascript"  src="includes/java/alertifyjs/alertify.js"></script>
        
        <link type="text/css"  href="includes/java/alertifyjs/css/alertify.css" rel="stylesheet" media="screen">
        <link type="text/css"  href="includes/java/alertifyjs/css/themes/default.css" rel="stylesheet" media="screen">

        <script type="text/javascript" src="includes/java/java/js/jquery-1.11.0.js"></script>
        <script type="text/javascript" src="includes/java/java/jquery.js"></script>
        <script type="text/javascript" src="includes/java/java/js/jquery-ui-1.10.4.custom.js"></script>

        <script type="text/javascript" src="includes/bootstrap/js/bootstrap.min.js"></script>
  

        <link rel="stylesheet" type="text/css" href="includes/designs/w3.css">
        
          <link rel="stylesheet" href="includes/java/java/js/jquery-ui-1.10.4.custom/css/smoothness/jquery-ui-1.10.4.custom.css" />	
       
     
      
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
        <link rel="stylesheet" type="text/css" href="includes/designs/ripple.css">
        <link rel="stylesheet" type="text/css" href="includes/designs/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="includes/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="includes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="includes/designs/labour-styles.css"> 
        <title>Hupgo Labour</title>
          
        <style type="text/css">
            li .ui-menu-item{
                font-size: 12px; 
                color:#0077b5;
              
            }
            
            body .ui-autocomplete{
                font-size:12px;
                z-index: 99999;
                border: none !important;
                box-shadow: 1px 1px 5px #777777;
            }
            
            body .ui-autocomplete .ui-menu-item .ui-corner-all{
               color:#0077b5;
              
            }
            body .ui-autocomplete .ui-menu-item .ui-state-focus{
                color:#ffffff;
                background:none !important;
                background-color:#0077b5 !important;
                border:none !important;
            }
            
            
        </style>
        <script type="text/javascript">
       	$(document).ready(function(){
            
          
		$('#search, #search1').autocomplete({
                   
        		source : 'includes/classes/search.php',
			minLength : 3,
                        select:function(event, ui){
                            $('#search').val(ui.item.value);
                            $('#search-form').submit();
                        }
                        
			});
			});        
    </script>

    </head>
    
    <body style="padding-top: 25px;">

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

