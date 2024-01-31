<?php
require __DIR__ . '/includes/classes/session.php';

global $database, $session;
?>

<?php
include 'title.php';
if (($session->isEmployee()) && ($session->logged_in)) {
    header("Location: index.php");
} else if (($session->isEmployer()) && ($session->logged_in)) {
    header("Location: index.php");
} else {
    require 'headerGuest.php';


    $images = "";

    $imagetosave = "";
    ?>
    <div class="registration-content top-content">

        <div class="inner-bg">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5  text">
                        <h1><strong>Registration Form</strong></h1>
                        <div class="description">
                            <p>Welcome to the <strong>Labour Office</strong> registration form. 
                                <br>
                                You can register as: 
                            </p>

                            <ol>
                                <li>Employer or </li> 
                                <li>Employee</li>

                            </ol>

                            <p>
                                <strong>Employees</strong> register with the purpose of finding potential people who wants to accomplish a task for.
                            </p>
                            <p><strong>Employers</strong> register to find skilled people to work with. Eg. Foreman or a contractor</p>
    <?php
    echo $form->error("form-phone");
    echo $form->error("form-email");
    echo $form->error("form-password");
    echo $form->error("form-confirm-pass");
    echo $form->error("fileinput");
    echo $sform->successss("success");
    echo $form->error("image")
//                        $text = "kwame";
//                        $random = uniqid(rand());
//                        echo "Salt =$random<br>";
//                        $hash = crypt($text, '$5$rounds=5000$' . $random . '$');
//                        echo "Salt = " . $hash . "<br>";
//
//                        echo "Salt2 = " . $hash2 = crypt($text, $hash) . "<br>";
//
//                        echo hash_equals($hash, $hash2);
//
//                        echo $imagetosave . "<br>$fileType<br>$imageSize";
//
//                        echo $formPassword;
    ?>

                        </div>
                    </div>




                    <div class="col-sm-1 middle-border"></div>
                    <div class="col-sm-1"></div>

                    <div class="col-sm-5">
                        <div id="some"></div>
                        <form role="form" action="process.php" method="post" id="registration-form" class="registration-form" enctype="multipart/form-data">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p>Fill in the form below to get instant jobs:</p>
                                    </div>

                                </div>


                                <div class="form-bottom">

                                    <ul id = "myTab" class = "nav nav-tabs">
                                        <li class = "active">
                                            <a href = "#personal" id="person" data-toggle = "tab">
                                                Personal
                                            </a>
                                        </li>

                                        <li><a href = "#contacts" id="contact" data-toggle = "tab">Contact</a></li>
                                        <li>
                                            <a href = "#images" id="image" data-toggle = "tab">
                                                Image
                                            </a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div id = "myTabContent" class = "tab-content">
                                        <div class = "tab-pane fade in active" id = "personal">
                                            <div class="form-group">
                                                <label class="sr-only" for="form-first-name">First name...</label>
                                                <input type="text" name="form-first-name" placeholder="First name..." value="<?php echo $form->value("form-first-name"); ?>" class="form-first-name form-control" id="form-first-name">
                                            </div>

                                            <div class="form-group">
                                                <label class="sr-only" for="form-last-name">Last name...</label>
                                                <input type="text" name="form-last-name" placeholder="Last name..." value="<?php echo $form->value("form-last-name"); ?>" class="form-last-name form-control" id="form-last-name">
                                            </div>


                                            <div class="form-group date">

                                                <div class="row">
                                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                        <h6 class="label label-default" for="form-dob">Date of Birth:</h6>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                        <select  name="days" ><option disabled selected>--</option>
    <?php
    foreach ($arithmatics->get_days() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                        <select name="months" ><option disabled selected>--</option>
    <?php
    foreach ($arithmatics->get_months() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>  
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                        <select name="years" ><option disabled selected>----</option>
    <?php
    foreach ($arithmatics->get_years() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thiskey . '</option>';
    }
    ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <select  class="form-control" name="form-gender" >
                                                    <option disabled selected>Gender</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="O">Other</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="sr-only" for="form-password">Password...</label>
                                                <input type="password" name="form-password" placeholder="Password..." title="Above 8 Character Alphanumeric and (!@#$%^&*()_+.)  " class="form-password form-control" id="form-password">
                                            </div>


                                            <div class="form-group date">
                                                <label class="sr-only" for="form-confirm-pass">Confirm Password...</label>
                                                <input type="password" name="form-confirm-pass" placeholder="Confirm Password" title="Above 8 Character Alphanumeric and (!@#$%^&*()_+.)" class="form-confirm-pass form-control " id="form-confirm-pass">
                                            </div>


                                            <a class="btn btn-link" id="next" href= "#contacts" data-toggle = "tab">Next  <i class="fa fa-arrow-right"></i></a>

                                        </div>

                                        <div class = "tab-pane fade" id = "contacts">
                                            <div class="form-group">
                                                <label class="sr-only" for="form-address">Address...</label>
                                                <input type="text" name="form-address" placeholder="Address..." value="<?php echo $form->value("form-address"); ?>"class="form-address form-control" id="form-address">
                                            </div>

                                            <div class = "form-group">

    <?php
//This is for calling the region selection and it's options
    $database->getOptions("regions", "reg_name", 1);
    ?>
                                            </div>


                                            <div class = "form-group">

                                                <select name="location" id="locations" class="form-control">

                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label class="sr-only" for="form-phone">Mobile No</label>
                                                <input type="tel" name="form-phone" placeholder="Mobile No..." value="<?php echo $form->value("form-phone"); ?>" maxlength="10" class="form-phone form-control" id="form-phone" >
                                            </div>


                                            <div class="form-group">
                                                <label class="sr-only" for="form-email">Email</label>
                                                <input type="email" name="form-email" placeholder="Email..." value="<?php echo $form->value("form-email"); ?>" class="form-email form-control" id="form-email">
                                            </div>


                                            <div class = "radio">
                                                <label>
                                                    <input type = "radio" name = "professionRadio" id = "employee" value = "employee">Employee (I want to be hired by others)
                                                </label>
                                            </div>


                                            <div class = "radio">
                                                <label>
                                                    <input type = "radio" name = "professionRadio" id ="employer" value = "employer">
                                                    Employer (I want others to work for me)
                                                </label>
                                            </div>


                                            <div class = "form-group" id="professional" value="<?php echo $formProfession; ?>" >


                                            </div>


                                            <div id="checkboxes">


                                            </div>



                                            <div class="form-group" id="company">

                                            </div>




                                            <div class="form-group">
                                                <label class="sr-only" for="form-comment">About yourself</label>
                                                <textarea name="form-comment" placeholder="About yourself..." value="<?php echo $form->value("form-comment"); ?>" 
                                                          class="form-comment form-control" id="form-comment"></textarea>
                                            </div>
                                            <input type="hidden" name="form-register" >
                                            <input type="hidden" name="success">
                                            <a href="#personal" class="btn btn-link" data-toggle = "tab" id="prev-personal"><i class="fa fa-arrow-left"></i>  Back</a>
                                            <a href="#images" class="btn btn-link" data-toggle = "tab" id="next-image">Next  <i class="fa fa-arrow-right"></i>  </a>

                                        </div>

                                        <div class = "tab-pane fade" id = "images">
                                            <div class="form-top-right">
                                                <div  class="image-upload">
                                                    <label for="inputfile">
                                                        <img  src="<?php
    if ($images == NULL) {
        $avatar = 'images/avatar.png';
    } else {
        $avatar = $imagetosave;
    }
    echo $avatar;
    ?>" alt="image" id="blah">

                                                    </label>

                                                    <input type="file" name="inputfile" class="inputfile" value="<?php echo $form->value("inputfile"); ?>" onchange="readURL(this);" id="inputfile">
                                                </div>
                                            </div>
                                            <br>
                                              <a href="#contacts" class="btn btn-link" data-toggle = "tab" id="prev-contact"><i class="fa fa-arrow-left"></i>  Back</a>
                                             <button type="submit" name="submit-btn" id="submit-btn" class="btn btn-info">Sign me up!</button>
                                
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <script type="text/javascript">


    //Dealing with the image requires fileReader to read the stream for the user  to see the type of image selected before uploading
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }



        function validateInput(location, formInput, message) {
            $(location).click();

            alertify.alert("Check Input", message, function () {
                $(formInput).css({'border-color': 'red', 'background-color': 'rgba(252, 248, 215, 0.95'});
                $(formInput).focus();

            }).set({'pinnable': false, 'modal': true, 'closable': false, 'transition': 'zoom', 'movable': false});

        }


        $(document).ready(function () {

            $('#myTab li:eq(0) a').tab('show');
            $("#locations").prop('disabled', true);
            $("#employee").prop('checked', true);
            $("#professional").append("<?php $database->getProfessionOptions("professions", "prof_name", 1) ?>");


            $("#next").click(function () {

                var location_person = $("#person");
                var formFirstName = $("#form-first-name");
                var formPassword = $("#form-password");
                var formConfirmPass = $("#form-confirm-pass");
                var messageFirstName = "Enter First Name";
                var messagePassword = "Enter Valid Password";
                var messageConfirmPass = "Enter Confirm Password";
                var messagePassMismatche = "Password don't match";


                //validating to check a compulsory first name entered
                if (formFirstName.val() === "") {
                    validateInput(location_person, formFirstName, messageFirstName);
                    return false;
                }

    //validating to check of a compulsory password entered.
                if (formPassword.val() === "" || formPassword.val().length < 8) {
                    validateInput(location_person, formPassword, messagePassword);
                    return false;
                }

                //validating to check of compulsory confirm password is entered

                if (formConfirmPass.val() === "")
                {
                    validateInput(location_person, formConfirmPass, messageConfirmPass);
                    return false;
                }

                //validating to check whether the password entered really corresponds to the confirmed password

                if (formPassword.val() !== formConfirmPass.val()) {
                    validateInput(location_person, {formPassword, formConfirmPass}, messagePassMismatche);
                    return false;
                }


                $("#contact").click();
            });

            $("#prev-personal").click(function () {
                $("#person").click();
            });
            
            
            
           

 $("#next-image").click(function(){
                 $("#image").click();
            });
 $("#prev-contact").click(function(){
                 $("#contact").click();
            });
            $("#submit-btn").click(function (e) {
                var location_person = $("#person");
                var location_contact = $("contact");
                var formFirstName = $("#form-first-name");
                var formPassword = $("#form-password");
                var formConfirmPass = $("#form-confirm-pass");
                var formPhone = $("#form-phone");
                var formEmail = $("#form-email");
                var formRegions = $("#region :selected");
                var formSecondRegions = $("#region");
                var formLocation = $("#locations :selected");
                var formSecondLocation = $("#locations");
                var formProfession = $("#profession :selected");
                var formSecondProfession = $("#profession");
                var messageEmail = "Enter Email";
                var messageValidEmail = "Enter a valid Email";
                var messageRegions = "Select your Region";
                var messageLocation = "Select your location";
                var messageProfession = "Select your Profession";
                var messagePhone = "Enter Phone Number and Should be Eg. 0241000000 format";
                var messageValidPhone = "Enter a valid Phone Number";
                var messageFirstName = "Enter First Name";
                var messagePassword = "Enter Password";
                var messageConfirmPass = "Enter Confirm Password";
                var messagePassMismatche = "Password don't match";
                var reg = /^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{1,})*\.([a-z]{2,}){1}$/;
                var resultsEmail = reg.test($("#form-email").val());
                var regPhone = /^([0-9])+$/;
                var resultsPhone = regPhone.test($("#form-phone").val());


                //validating to check a compulsory first name entered
                if (formFirstName.val() === "") {
                    validateInput(location_person, formFirstName, messageFirstName);
                    e.preventDefault();
                }


    //validating to check of a compulsory password entered.
                if (formPassword.val() === "") {
                    validateInput(location_person, formPassword, messagePassword);
                    e.preventDefault();
                }

                //validating to check of compulsory confirm password is entered

                if (formConfirmPass.val() === "")
                {
                    validateInput(location_person, formConfirmPass, messageConfirmPass);
                    e.preventDefault();
                }
                //validating to check whether the password entered really corresponds to the confirmed password

                if (formPassword.val() !== formConfirmPass.val()) {
                    validateInput(location_person, formPassword, messagePassMismatche);
                    e.preventDefault();
                }



                //validation to check if the user have selected his region of residence
                if (formRegions.text() === "Choose your Region") {
                    validateInput(location_contact, formSecondRegions, messageRegions);

                    e.preventDefault();
                }

                //validating to check whether the user have really selected his location corresponding tho the region selected above

                if (formLocation.val() === "") {
                    validateInput(location_contact, formSecondLocation, messageLocation);
                    e.preventDefault();
                }



                if (formPhone.val() === "" || formPhone.val().length < 10) {
                    validateInput(location_contact, formPhone, messagePhone);
                    e.preventDefault();
                }


                if (!resultsPhone) {
                    validateInput(location_contact, formPhone, messageValidPhone);

                    e.preventDefault();
                }

    //            if (formEmail.val() === "") {
    //                validateInput(location_contact, formEmail, messageEmail);
    //                return false;
    //
    //            }
    //
    //
    //            if (!resultsEmail) {
    //                validateInput(location_contact, formEmail, messageValidEmail);
    //                return false;
    //            }

                if (formProfession.text() === "Choose your Profession") {
                    validateInput(location_contact, formSecondProfession, messageProfession);
                    e.preventDefault();

                }

                location.replace("registration.php");


            });


            $("#form-password").keyup(function () {
                var reg = /^([0-9a-zA-Z!@#\$%\^\&*\)\(+=._-])+$/;
                var results = reg.test($("#form-password").val());

                if (($("#form-password").val().length < 8) || (!results)) {
                    $("#form-password").css("color", "red");
                } else if (($("#form-password").val().length <= 12) || (!results)) {

                    $("#form-password").css({"color": "yellow", 'transform': 'scale(1, 1)', 'transition': 'transform 2s'});

                } else {
                    $("#form-password").css("color", "green");
                }

                $("#form-password").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });
            //
            $("#form-first-name").keyup(function () {
                $("#form-first-name").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });


            $("#form-confirm-pass").keyup(function () {
                var reg = /^([0-9a-zA-Z!@#\$%\^\&*\)\(+=._-])+$/;
                var results = reg.test($("#form-confirm-pass").val());

                if (($("#form-password").val() === ($("#form-confirm-pass").val()))) {
                    $("#form-confirm-pass").css("color", "green");
                } else {
                    $("#form-confirm-pass").css("color", "red");
                }

                $("#form-confirm-pass").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });

            $("#form-phone").keyup(function () {
                var reg = /^([0-9])+$/;
                var results = reg.test($("#form-phone").val());
                if (($("#form-phone").val().length < 10) || (!results)) {
                    $("#form-phone").css("color", "red");
                } else {
                    $("#form-phone").css("color", "green");
                }

                $("#form-phone").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});

            });


            $("#form-email").keyup(function () {
                var reg = /^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{1,})*\.([a-z]{2,}){1}$/;
                var results = reg.test($("#form-email").val());
                if ((!results)) {
                    $("#form-email").css("color", "red");
                } else {
                    $("#form-email").css("color", "green");
                }

                $("#form-email").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });




            //        $("#displaying-btn").click(function(){
            //            $("#profession-unstable").show();
            //            $("#displaying-btn").hide();
            //        });
            $("#employer, #employee").change(function (event) {
                event.preventDefault();
                if ($("#employer").is(":checked")) {

                    $("#company").append(" <label class=\"sr-only\" for=\"form-company\">Company/Firm</label><input type=\"text\" name=\"form-company\" placeholder=\"Company/Firm...\" class=\"form-company form-control\" id=\"form-company\">");
                    $("#professional").empty();

                    var employerRadio = 'employerRadio=' + $("#employer").val();
                    //alert(employerRadio);
                    $.ajax({
                        type: "POST", // HTTP method POST or GET
                        url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                        dataType: "html", // Data type, HTML, json etc.
                        data: employerRadio, //Form variables
                        cache: false,
                        async: false,
                        success: function (data) {
                            //on success, hide  element user wants to delete.
                            $("#checkboxes").html(data);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            //On error, we alert user
                            alert(thrownError);
                        }
                    });

                } else {
                    $("#checkboxes").empty();
                    $("#company").empty();
                    $("#professional").append("<?php $database->getProfessionOptions("professions", "prof_name", 1) ?>");
                }


            });





            $("#region").change(function () {




                var myData = 'reg_id=' + $("#region").val();


                $.ajax({
                    type: "POST", // HTTP method POST or GET
                    url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                    dataType: "html", // Data type, HTML, json etc.
                    data: myData, //Form variables
                    cache: false,
                    async: false,
                    success: function (data) {
                        $("#locations").html(data);
                        $("#locations").prop('disabled', false);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                        //On error, we alert user
                        alert(thrownError);
                    }


                });
                $("#region").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});



            });

            $("#locations").change(function () {
                $("#locations").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });


            $("#profession").change(function () {
                $("#profession").css({'border-color': 'blue', 'background-color': 'rgba(255, 255, 255, 0.95'});
            });



        });

    </script>

    <?php
    include 'footer.php';
}
/*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */


    