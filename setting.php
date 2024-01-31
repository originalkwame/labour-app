<?php
require 'includes/classes/session.php';
global $database, $session, $form, $sform;
include 'title.php';
echo $form->error("image");
echo $sform->successss("image");
        

$splitImage = explode(",", $session->userinfo['image']);
            $bigImage = $splitImage[0];
            $smallImage = $splitImage[1];
?>
<div class="background" id="alerti">
    <div class="labour-nav-background">

    </div>

    <?php

    if (($session->isEmployee()) && ($session->logged_in)) {
        require 'headerUser.php';
        ?>

        <div class="container">
            <ul id = "myTab" class = "nav nav-tabs">
                <li class = "active">
                    <a href = "#personal" id="person" data-toggle = "tab">Personal
                    </a>
                </li>

                <li><a href = "#contacts" id="contact" data-toggle = "tab">Contact</a></li>

                <li><a href = "#securitys" id="security" data-toggle = "tab">Security</a></li>
            </ul>
            <br>
            <div id = "myTabContent" class = "tab-content">
                <div class = "tab-pane fade in active cover-edit" id = "personal">
                    <div class=" cover-edit">
                        <table class="table table-hover">
<tr>
                  <td class="editLabel"></td>             
                  <td class="editDetails" id="editUserImage"><img src="<?php echo $smallImage ?>"><div id="editImageLogo" class="camera-upload"><i class="fa fa-camera"></i></div></td>
                                <td class="edit-text" id="editImage"><a href="javascript:void(0);">Change</a></td>
                            </tr>
                            <tr id="">
                                <td class="editLabel">Name:</td>
                                <td class="editDetails" id="editUserName"><?php echo $session->userinfo['first_name'] . " " . $session->userinfo['surname']; ?></td>
                                <td class="edit-text" id="editName"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Birthday:</td>
                                <td class="editDetails" id="editUserDOB"><?php echo $session->userinfo['DOB']; ?></td>
                                <td class="edit-text" id="editDOB"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Gender:</td>
                                <td class="editDetails" id="editUserGender"><?php
                                    $value = $session->userinfo['gender'];
                                    if ($value == "M") {
                                        $value = "Male";
                                    } else if ($value == "F") {
                                        $value = "Female";
                                    } else {
                                        $value = "Other";
                                    }

                                    echo $value;
                                    ?></td>
                                <td class="edit-text" id="editGender"><a href="javascript:void(0);">Edit</a></td>
                            </tr>


                            <tr>
                                <td class="editLabel">About:</td>
                                <td  class="editDetails" id="editUserAbout"><?php echo $session->userinfo['comment']; ?></td>
                                <td  class="edit-text" id="editAbout"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



                </div>




                <div class = "tab-pane fade cover-edit" id = "contacts">
                    <div class=" cover-edit">
                        <table class="table table-hover">

                            <tr id="">
                                <td class="editLabel">Phone:</td>
                                <td class="editDetails" id="editUserPhone" ><?php echo $session->userinfo['phone']; ?></td>
                                <td class="edit-text" id="editPhone"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Email:</td>
                                <td class="editDetails" id="editUserEmail"><?php echo $session->userinfo['email']; ?></td>
                                <td class="edit-text" id="editEmail"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Address:</td>
                                <td class="editDetails" id="editUserAddress"><?php echo $session->userinfo['address']; ?></td>
                                <td class="edit-text" id="editAddress"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Loc./Reg:</td>
                                <td class="editDetails" id="editUserLocReg"><?php echo $database->getUserLoc($session->userinfo['emp_id']) . ", " . $database->getUserReg($session->userinfo['emp_id']); ?></td>
                                <td class="edit-text" id="editLocReg"><a href="javascript:void(0);">Edit</a></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class = "tab-pane fade cover-edit " id = "securitys">
                    <div class="cover-edit">
                        <table class="table table-hover">

                            <tr id="">
                                <td class="editLabel">Password:</td>
                                <td class="editDetails" id="editUserPass"><a href="javascript:void(0);" id="editPass">Change my Password</a></td>
                                <td class="edit-text" id="editPass"><a href="javascript:void(0);">Change</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Verify Account:</td>
                                <td class="editDetails" id="editUserVerify"><a href="javascript:void(0);" id="verifyAccount">Verify my Account</a></td>
                                <td class="edit-text" id="editVerify"><a href="javascript:void(0);">Verify</a></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <script type="text/javascript">


            //for the registration tabs
            $(function () {
                $('#myTab li:eq(0) a').tab('show');
            });

            $(document).ready(function () {

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
                                    maximizable: false,
                                    resizable: false,
                                    padding: false,
                                    modal: true,
                                    movable: false,
                                    transition: 'zoom',
                                    startMaximized: false
                                }
                            };
                        },
                        settings: {
                            selector: undefined
                        }
                    };
                });
    //for editing only the first and last name values
                $('#editName').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group">\n\
    <label class="sr-only">User Phone or Email</label>\n\
    <input type="text" class="form-control" name="editedFirstname" value="<?php echo $session->userinfo['first_name']; ?>" id="editedFirstName" placeholder="First Name"/>\n\
    </div>\n\
    <div class="form-group"><label class="sr-only">Surname</label>\n\
    <input type="text" name="editedSurname" class="form-control" value="<?php echo $session->userinfo['surname']; ?>" id="editedSurname" placeholder="Last Name"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedNameSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedNameSave').click(function () {
                        if ($('#editedFirstName').val() === "") {
                            alertify.error("First Name is empty");
                            $('#editedFirstName').focus();
                            return false;
                        }

                        var myData = "fname=" + $('#editedFirstName').val() + "&sname=" + $("#editedSurname").val() + "&nameButton=saveName";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                $("#editUserName").html(data);
                                alertify.genericDialog().close();
                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError);
                            }
                        });
                    });


                });

                //End of the first and last name change listener

    // Begining of date of birth editor for the system
                $('#editDOB').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group date">\n\
    <div class="row">\n\
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select  style="color:#727272;"id="editedDay"  name="days" >\n\
    <?php
    foreach ($arithmatics->get_days() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>\n\
    </select>\n\
    </div>\n\
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select style="color:#727272;" id="editedMonth" name="months" >\n\
    <?php
    foreach ($arithmatics->get_months() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>\n\
     </select>\n\
     </div>\n\
     <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select style="color:#727272;" id="editedYear" name="years" >\n\
    <?php
    foreach ($arithmatics->get_years() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thiskey . '</option>';
    }
    ?>\n\
     </select>\n\
     </div>\n\
     </div>\n\
     </div>\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedDOBSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedDOBSave').click(function () {


                        var myData = "day=" + $('#editedDay').val() + "&month=" + $("#editedMonth").val() + "&year=" + $("#editedYear").val() + "&DOBbutton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserDOB").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });


                // Begining of date of birth editor for the system
                $('#editGender').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group date">\n\
       <div class="form-group">\n\
      <select  class="form-control" id="editedGender" value="<?php echo $session->userinfo['gender'] ?>" name="form-gender" >\n\
              <option disabled selected>Gender</option>\n\
              <option value="M">Male</option>\n\
              <option value="F">Female</option>\n\
              <option value="O">Other</option>\n\
              </select>\n\
              </div>\n\
     </div>\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedGenderSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedGenderSave').click(function () {


                        var myData = "gender=" + $('#editedGender').val() + "&genderButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserGender").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });
                });
    //Ending of editing the gender area

                // Begining of date of birth editor for the system
                $('#editAbout').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
         <div class="form-group">\n\
       <label class="sr-only" for="form-comment">About yourself</label>\n\
                                                  <textarea name="form-comment"  placeholder="About yourself..." class="form-comment form-control" id="editedAbout"><?php echo $session->userinfo['comment'] ?></textarea>\n\
                                                          </div>\n\
     </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedAboutSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedAboutSave').click(function () {


                        var myData = "about=" + $('#editedAbout').val() + "&aboutButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserAbout").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });

                //End of of editing the about conetent     
                // Begining of date of birth editor for the system
                $('#editPhone').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Phone</label>\n\
    <input type="text" name="editedSurname" class="form-control" value="<?php echo $session->userinfo['phone']; ?>" id="editedPhone" placeholder="Enter Phone"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedPhoneSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedPhoneSave').click(function () {

                        var regPhone = /^([0-9])+$/;
                        var resultsPhone = regPhone.test($("#editedPhone").val());
                        if ((!resultsPhone) || ($("#editedPhone").val() === "") || ($("#editedPhone").val().length < 10) || ($("#editedPhone").val().length > 10)) {
                            alertify.alert("Check Input", "Invalid Phone Number", function () {
                                $("#editedPhone").css({'border-color': 'red', 'background-color': 'rgba(252, 248, 215, 0.95'});
                                $("#editedPhone").focus();

                            }).set({'pinnable': false, 'modal': true, 'closable': false, 'transition': 'zoom', 'movable': false});
                            return false;
                        }

                        var myData = "phone=" + $('#editedPhone').val() + "&phoneButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserPhone").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                //Phone number editing ends here
                
                    // Begining of email editor for the system
                $('#editEmail').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Email</label>\n\
    <input type="text" name="editedEmail" class="form-control" value="<?php echo $session->userinfo['email']; ?>" id="editedEmail" placeholder="Enter Email"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedEmailSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedEmailSave').click(function () {

                        var reg = /^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{1,})*\.([a-z]{2,}){1}$/;
            var resultsEmail = reg.test($("#editedEmail").val());
                        if (!resultsEmail) {
                            alertify.alert("Check Input", "Invalid Email Address", function () {
                                $("resultsEmail").css({'border-color': 'red', 'background-color': 'rgba(252, 248, 215, 0.95'});
                                $("resultsEmail").focus();

                            }).set({'pinnable': false, 'modal': true, 'closable': false, 'transition': 'zoom', 'movable': false});
                            return false;
                        }

                        var myData = "email=" + $('#editedEmail').val() + "&emailButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserEmail").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });


     // Begining of Address editor for the system
                $('#editAddress').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Address</label>\n\
    <input type="text" name="editedAddress" class="form-control" value="<?php echo $session->userinfo['address']; ?>" id="editedAddress" placeholder="Enter Address"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedAddressSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedAddressSave').click(function () {

                      

                        var myData = "address=" + $('#editedAddress').val() + "&addressButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserAddress").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });

   // Begining of Address editor for the system
                $('#editLocReg').click(function () {
                    
               

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
      <div class = "form-group">\n\<?php $database->getOptions("regions", "reg_name", 1);?></div>\n\
      <div class = "form-group">\n\
                                        <select name="location" id="locations" class="form-control">\n\
                                            </select>\n\
                                            </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedLocRegSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');
    
          $("#locations").prop('disabled', true);
          $("#editedLocRegSave").prop('disabled', true);
                    $("#region").change(function () {

            var myData = 'reg_id=' + $("#region").val();


            $.ajax({
                type: "POST", // HTTP method POST or GET
                url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                dataType: "html", // Data type, HTML, json etc.
                data: myData, //Form variables
                success: function (data) {
                    //on success, hide  element user wants to delete.


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
             $("#editedLocRegSave").prop('disabled', false);
        });

                    $('#editedLocRegSave').click(function () {


                        var myData = "region=" + $('#region').val() + "&location=" + $('#locations').val() + "&locregButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserLocReg").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                        //for editing only the first and last name values
                $('#editPass, #editUserPass').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group">\n\
    <label class="sr-only">Old Password</label>\n\
    <input type="password" class="form-control" name="editedOldPass" id="editedOldPass" placeholder="Old Password"/>\n\
    </div>\n\
    <div class="form-group"><label class="sr-only">New Password</label>\n\
    <input type="password" name="editedNewPass" class="form-control" id="editedNewPass" placeholder="New Password"/>\n\
    </div>\n\
     <div class="form-group"><label class="sr-only">Confirm Password</label>\n\
    <input type="password" name="editedConfirmPass" class="form-control" id="editedConfirmPass" placeholder="Confirm Password"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedChangePass"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your password for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedChangePass').click(function () {
                        if ($('#editedOldPass').val() === "") {
                            alertify.error("Old Password not entered");
                            $('#editedOldPass').focus();
                            return false;
                        }
                          if ($('#editedNewPass').val() === "") {
                            alertify.error("New Password not entered");
                            $('#editedNewPass').focus();
                            return false;
                        }
                          if ($('#editedConfirmPass').val() === "") {
                            alertify.error("Confirm Password not entered");
                            $('#editedConfirmPass').focus();
                            return false;
                        }
                        
                        if($('#editedConfirmPass').val() !== $('#editedNewPass').val()){
                            alertify.error("Password not Match");
                           
                            return false; 
                        }

                        var myData = "oldpass=" + $('#editedOldPass').val() + "&newpass=" + $("#editedNewPass").val() + "&passButton=savePass";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                              $("#alerti").append(data);
                                alertify.genericDialog().close();
                               
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                
                $('#editImage, #editImageLogo').click(function () {
                     alertify.genericDialog('<form id="loginForm"  method="post" action="process" enctype="multipart/form-data">\n\
    <fieldset class="image-upload">\n\
   <div class="editDetails" id="editUserImages"><img src="<?php echo $smallImage ?>" id="blah"><div id="editImageLogo"  class="camera-upload"><label for="inputfile"><i  class="fa fa-camera"></i></label></div></div>\n\
    <input type="file" name="inputfile" class="inputfile" value="<?php echo $form->value("inputfile"); ?>" onchange="readURL(this);" id="inputfile">\n\
   <button class="btn btn-group-lg btn-default" type="submit" name="updateimage" value="Save" id="editedImage"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
   <div class="editor-info">\n\
    Change Display Picture\n\
    </div></fieldset>\n\
    </form>');

                    

                });

            });
        </script>
        <?php
        
        include 'footer.php';
//$database->getEmployers();
    }   else if (($session->isEmployer()) && ($session->logged_in)) {
        require 'headerEmployer.php';
        ?>

        <div class="container">
            <ul id = "myTab" class = "nav nav-tabs">
                <li class = "active">
                    <a href = "#personal" id="person" data-toggle = "tab">Personal
                    </a>
                </li>

                <li><a href = "#contacts" id="contact" data-toggle = "tab">Contact</a></li>

                <li><a href = "#securitys" id="security" data-toggle = "tab">Security</a></li>
            </ul>
            <br>
            <div id = "myTabContent" class = "tab-content">
                <div class = "tab-pane fade in active cover-edit" id = "personal">
                    <div class=" cover-edit">
                        <table class="table table-hover">
 <tr>
                  <td class="editLabel"></td>             
                  <td class="editDetails" id="editUserImage"><img src="<?php echo $smallImage ?>"><div id="editImageLogo" class="camera-upload"><i class="fa fa-camera"></i></div></td>
                                <td class="edit-text" id="editImage"><a href="javascript:void(0);">Change</a></td>
                            </tr>
                            <tr id="">
                                <td class="editLabel">Name:</td>
                                <td class="editDetails" id="editUserName"><?php echo $session->userinfo['first_name'] . " " . $session->userinfo['surname']; ?></td>
                                <td class="edit-text" id="editName"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Birthday:</td>
                                <td class="editDetails" id="editUserDOB"><?php echo $session->userinfo['DOB']; ?></td>
                                <td class="edit-text" id="editDOB"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Gender:</td>
                                <td class="editDetails" id="editUserGender"><?php
                                    $value = $session->userinfo['gender'];
                                    if ($value == "M") {
                                        $value = "Male";
                                    } else if ($value == "F") {
                                        $value = "Female";
                                    } else {
                                        $value = "Other";
                                    }

                                    echo $value;
                                    ?></td>
                                <td class="edit-text" id="editGender"><a href="javascript:void(0);">Edit</a></td>
                            </tr>


                            <tr>
                                <td class="editLabel">About:</td>
                                <td  class="editDetails" id="editUserAbout"><?php echo $session->userinfo['comment']; ?></td>
                                <td  class="edit-text" id="editAbout"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



                </div>




                <div class = "tab-pane fade cover-edit" id = "contacts">
                    <div class=" cover-edit">
                        <table class="table table-hover">

                            <tr id="">
                                <td class="editLabel">Phone:</td>
                                <td class="editDetails" id="editUserPhone" ><?php echo $session->userinfo['phone']; ?></td>
                                <td class="edit-text" id="editPhone"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Email:</td>
                                <td class="editDetails" id="editUserEmail"><?php echo $session->userinfo['email']; ?></td>
                                <td class="edit-text" id="editEmail"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Address:</td>
                                <td class="editDetails" id="editUserAddress"><?php echo $session->userinfo['address']; ?></td>
                                <td class="edit-text" id="editAddress"><a href="javascript:void(0);">Edit</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Loc./Reg:</td>
                                <td class="editDetails" id="editUserLocReg"><?php echo $database->getUserLoc($session->userinfo['emp_id']) . ", " . $database->getUserReg($session->userinfo['emp_id']); ?></td>
                                <td class="edit-text" id="editLocReg"><a href="javascript:void(0);">Edit</a></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class = "tab-pane fade cover-edit " id = "securitys">
                    <div class="cover-edit">
                        <table class="table table-hover">

                            <tr id="">
                                <td class="editLabel">Password:</td>
                                <td class="editDetails" id="editUserPass"><a href="javascript:void(0);" id="editPass">Change my Password</a></td>
                                <td class="edit-text" id="editPass"><a href="javascript:void(0);">Change</a></td>
                            </tr>
                            <tr>
                                <td class="editLabel">Verify Account:</td>
                                <td class="editDetails" id="editUserVerify"><a href="javascript:void(0);" id="verifyAccount">Verify my Account</a></td>
                                <td class="edit-text" id="editVerify"><a href="javascript:void(0);">Verify</a></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <script type="text/javascript">


            //for the registration tabs
            $(function () {
                $('#myTab li:eq(0) a').tab('show');
            });

            $(document).ready(function () {

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
                                    maximizable: false,
                                    resizable: false,
                                    padding: false,
                                    modal: true,
                                    movable: false,
                                    transition: 'zoom',
                                    startMaximized: false
                                }
                            };
                        },
                        settings: {
                            selector: undefined
                        }
                    };
                });
    //for editing only the first and last name values
                $('#editName').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group">\n\
    <label class="sr-only">User Phone or Email</label>\n\
    <input type="text" class="form-control" name="editedFirstname" value="<?php echo $session->userinfo['first_name']; ?>" id="editedFirstName" placeholder="First Name"/>\n\
    </div>\n\
    <div class="form-group"><label class="sr-only">Surname</label>\n\
    <input type="text" name="editedSurname" class="form-control" value="<?php echo $session->userinfo['surname']; ?>" id="editedSurname" placeholder="Last Name"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedNameSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your name for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedNameSave').click(function () {
                        if ($('#editedFirstName').val() === "") {
                            alertify.error("First Name is empty");
                            $('#editedFirstName').focus();
                            return false;
                        }

                        var myData = "fname=" + $('#editedFirstName').val() + "&sname=" + $("#editedSurname").val() + "&nameButton=saveName";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                $("#editUserName").html(data);
                                alertify.genericDialog().close();
                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError);
                            }
                        });
                    });


                });

                //End of the first and last name change listener

    // Begining of date of birth editor for the system
                $('#editDOB').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group date">\n\
    <div class="row">\n\
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select  style="color:#727272;"id="editedDay"  name="days" >\n\
    <?php
    foreach ($arithmatics->get_days() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>\n\
    </select>\n\
    </div>\n\
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select style="color:#727272;" id="editedMonth" name="months" >\n\
    <?php
    foreach ($arithmatics->get_months() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thisValue . '</option>';
    }
    ?>\n\
     </select>\n\
     </div>\n\
     <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">\n\
    <select style="color:#727272;" id="editedYear" name="years" >\n\
    <?php
    foreach ($arithmatics->get_years() as $thiskey => $thisValue) {
        echo'<option value="' . $thiskey . '">' . $thiskey . '</option>';
    }
    ?>\n\
     </select>\n\
     </div>\n\
     </div>\n\
     </div>\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedDOBSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Date of Birth for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedDOBSave').click(function () {


                        var myData = "day=" + $('#editedDay').val() + "&month=" + $("#editedMonth").val() + "&year=" + $("#editedYear").val() + "&DOBbutton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserDOB").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });


                // Begining of date of birth editor for the system
                $('#editGender').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group date">\n\
       <div class="form-group">\n\
      <select  class="form-control" id="editedGender" value="<?php echo $session->userinfo['gender'] ?>" name="form-gender" >\n\
              <option disabled selected>Gender</option>\n\
              <option value="M">Male</option>\n\
              <option value="F">Female</option>\n\
              <option value="O">Other</option>\n\
              </select>\n\
              </div>\n\
     </div>\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedGenderSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Gender for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedGenderSave').click(function () {


                        var myData = "gender=" + $('#editedGender').val() + "&genderButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserGender").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });
                });
    //Ending of editing the gender area

                // Begining of date of birth editor for the system
                $('#editAbout').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
         <div class="form-group">\n\
       <label class="sr-only" for="form-comment">About yourself</label>\n\
                                                  <textarea name="form-comment"  placeholder="About yourself..." class="form-comment form-control" id="editedAbout"><?php echo $session->userinfo['comment'] ?></textarea>\n\
                                                          </div>\n\
     </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedAboutSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Profile Post for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedAboutSave').click(function () {


                        var myData = "about=" + $('#editedAbout').val() + "&aboutButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserAbout").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });

                //End of of editing the about conetent     
                // Begining of date of birth editor for the system
                $('#editPhone').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Phone</label>\n\
    <input type="text" name="editedSurname" class="form-control" value="<?php echo $session->userinfo['phone']; ?>" id="editedPhone" placeholder="Enter Phone"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedPhoneSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Phone Number for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedPhoneSave').click(function () {

                        var regPhone = /^([0-9])+$/;
                        var resultsPhone = regPhone.test($("#editedPhone").val());
                        if ((!resultsPhone) || ($("#editedPhone").val() === "") || ($("#editedPhone").val().length < 10) || ($("#editedPhone").val().length > 10)) {
                            alertify.alert("Check Input", "Invalid Phone Number", function () {
                                $("#editedPhone").css({'border-color': 'red', 'background-color': 'rgba(252, 248, 215, 0.95'});
                                $("#editedPhone").focus();

                            }).set({'pinnable': false, 'modal': true, 'closable': false, 'transition': 'zoom', 'movable': false});
                            return false;
                        }

                        var myData = "phone=" + $('#editedPhone').val() + "&phoneButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserPhone").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                //Phone number editing ends here
                
                    // Begining of email editor for the system
                $('#editEmail').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Email</label>\n\
    <input type="text" name="editedEmail" class="form-control" value="<?php echo $session->userinfo['email']; ?>" id="editedEmail" placeholder="Enter Email"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedEmailSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Email Address for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedEmailSave').click(function () {

                        var reg = /^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{1,})*\.([a-z]{2,}){1}$/;
            var resultsEmail = reg.test($("#editedEmail").val());
                        if (!resultsEmail) {
                            alertify.alert("Check Input", "Invalid Email Address", function () {
                                $("resultsEmail").css({'border-color': 'red', 'background-color': 'rgba(252, 248, 215, 0.95'});
                                $("resultsEmail").focus();

                            }).set({'pinnable': false, 'modal': true, 'closable': false, 'transition': 'zoom', 'movable': false});
                            return false;
                        }

                        var myData = "email=" + $('#editedEmail').val() + "&emailButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserEmail").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });


     // Begining of Address editor for the system
                $('#editAddress').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
    <label class="sr-only">Address</label>\n\
    <input type="text" name="editedAddress" class="form-control" value="<?php echo $session->userinfo['address']; ?>" id="editedAddress" placeholder="Enter Address"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedAddressSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your address for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedAddressSave').click(function () {

                      

                        var myData = "address=" + $('#editedAddress').val() + "&addressButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserAddress").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });

   // Begining of Address editor for the system
                $('#editLocReg').click(function () {
                    
               

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
           <div class="form-group">\n\
      <div class = "form-group">\n\<?php $database->getOptions("regions", "reg_name", 1);?></div>\n\
      <div class = "form-group">\n\
                                        <select name="location" id="locations" class="form-control">\n\
                                            </select>\n\
                                            </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedLocRegSave"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your Region and Location for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');
    
          $("#locations").prop('disabled', true);
          $("#editedLocRegSave").prop('disabled', true);
                    $("#region").change(function () {

            var myData = 'reg_id=' + $("#region").val();


            $.ajax({
                type: "POST", // HTTP method POST or GET
                url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                dataType: "html", // Data type, HTML, json etc.
                data: myData, //Form variables
                success: function (data) {
                    //on success, hide  element user wants to delete.


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
             $("#editedLocRegSave").prop('disabled', false);
        });

                    $('#editedLocRegSave').click(function () {


                        var myData = "region=" + $('#region').val() + "&location=" + $('#locations').val() + "&locregButton";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                                //on success, hide  element user wants to delete.


                                $("#editUserLocReg").html(data);

                                alertify.genericDialog().close();

                                alertify.notify("Updated Successfull", "success", 10, function () {
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {

                                //On error, we alert user
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                
                  //for editing only the first and last name values
                $('#editPass, #editUserPass').click(function () {

                    alertify.genericDialog('<form id="loginForm"  method="post">\n\
    <fieldset>\n\
    <div class="form-group">\n\
    <label class="sr-only">Old Password</label>\n\
    <input type="password" class="form-control" name="editedOldPass" id="editedOldPass" placeholder="Old Password"/>\n\
    </div>\n\
    <div class="form-group"><label class="sr-only">New Password</label>\n\
    <input type="password" name="editedNewPass" class="form-control" id="editedNewPass" placeholder="New Password"/>\n\
    </div>\n\
     <div class="form-group"><label class="sr-only">Confirm Password</label>\n\
    <input type="password" name="editedConfirmPass" class="form-control" id="editedConfirmPass" placeholder="Confirm Password"/>\n\
    </div>\n\
    <div class="form-group">\n\
    <button class="btn btn-group-lg btn-default" type="button" value="Save" id="editedChangePass"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
    </div>\n\
    <div class="editor-info">\n\
    Review your password for appropriate corrections then click on the save button\n\
    </div></fieldset>\n\
    </form>');

                    $('#editedChangePass').click(function () {
                        if ($('#editedOldPass').val() === "") {
                            alertify.error("Old Password not entered");
                            $('#editedOldPass').focus();
                            return false;
                        }
                          if ($('#editedNewPass').val() === "") {
                            alertify.error("New Password not entered");
                            $('#editedNewPass').focus();
                            return false;
                        }
                          if ($('#editedConfirmPass').val() === "") {
                            alertify.error("Confirm Password not entered");
                            $('#editedConfirmPass').focus();
                            return false;
                        }
                        
                        if($('#editedConfirmPass').val() !== $('#editedNewPass').val()){
                            alertify.error("Password not Match");
                           
                            return false; 
                        }

                        var myData = "oldpass=" + $('#editedOldPass').val() + "&newpass=" + $("#editedNewPass").val() + "&passButton=savePass";

                        $.ajax({
                            type: "POST", // HTTP method POST or GET
                            url: "includes/classes/ajaxCalls.php", //Where to make Ajax calls
                            dataType: "html", // Data type, HTML, json etc.
                            data: myData, //Form variables
                            success: function (data) {
                              $("#alerti").append(data);
                                alertify.genericDialog().close();
                               
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError);
                            }
                        });
                    });


                });
                
                
                
                $('#editImage, #editImageLogo').click(function () {
                     alertify.genericDialog('<form id="loginForm"  method="post" action="process" enctype="multipart/form-data">\n\
    <fieldset class="image-upload">\n\
   <div class="editDetails" id="editUserImages"><img src="<?php echo $smallImage ?>" id="blah"><div id="editImageLogo"  class="camera-upload"><label for="inputfile"><i  class="fa fa-camera"></i></label></div></div>\n\
    <input type="file" name="inputfile" class="inputfile" value="<?php echo $form->value("inputfile"); ?>" onchange="readURL(this);" id="inputfile">\n\
   <button class="btn btn-group-lg btn-default" type="submit" name="updateimage" value="Save" id="editedImage"><i class="fa fa-folder-o"></i>  SAVE</button>\n\
   <div class="editor-info">\n\
    Change Display Picture\n\
    </div></fieldset>\n\
    </form>');

                });

            });
        </script>
        <?php
        
        include 'footer.php';
//$database->getEmployers();
    } else {
        header("Location:index.php");
    }
    ?>
</div>

</div>
<script>
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    $(function () {
        $("[data-toggle = 'tooltip']").tooltip();
    });
</script>
</body>
</html>
