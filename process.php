<?php

include("includes/classes/session.php");

/**
 * Process.php
 * 
 * The Process class is meant to simplify the task of processing
 * user submitted forms, redirecting the user to the correct
 * pages if errors are found, or if form is successful, either
 * way. Also handles the logout procedure.

 */
class Process {
    /* Class constructor */

    function Process() {
        global $session;
        /* User submitted login form */
        if (isset($_POST['sublogin'])) {
            $this->procLogin();
        } else if (isset($_POST['submit-btn']) && isset($_POST['professionals'])) {
            $this->procEmployerRegister();
        } else if (isset($_POST['submit-btn']) && isset($_POST['professionRadio'])) {

            $this->procEmployeeRegister();
        }
        /* User submitted registration form */ else if (isset($_POST['master_subjoin'])) {
            $this->procMasterRegister();
        }

        /* User submitted registration form */ else if (isset($_POST['agent_subjoin'])) {
            $this->procAgentRegister();
        }

        /* User submitted forgot password form */ else if (isset($_POST['subforgot'])) {
            $this->procForgotPass();
        }
        /* User submitted edit account form */ else if (isset($_POST['subedit'])) {
            $this->procEditAccount();
        }else if(isset($_POST['updateimage'])){
            $this->updateImage();
        }
        /**
         * The only other reason user should be directed here
         * is if he wants to logout, which means user is
         * logged in currently.
         */ else if ($session->logged_in) {
            $this->procLogout();
        }
        /**
         * Should not get here, which means user is viewing this page
         * by mistake and therefore is redirected.
         */ else {
            header("Location: index.php");
        }
    }

    /**
     * procLogin - Processes the user submitted login form, if errors
     * are found, the user is redirected to correct the information,
     * if not, the user is effectively logged in to the system.
     */
    function procLogin() {
        global $session, $form, $sform;
        /* Login attempt */
        $retval = $session->login($_POST['pro-credentials'], $_POST['pro-password']);

        /* Login successful */
        if ($retval) {

            $_SESSION['success_array'] = $sform->getSuccessArray();

            header("Location: index");
        }
        /* Login failed */ else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: index");
        }
    }

    /**
     * procLogout - Simply attempts to log the user out of the system
     * given that there is no logout form to process.
     */
    function procLogout() {
        global $session;
        $retval = $session->logout();
        header("Location: index");
    }

    /**
     * procRegister - Processes the user submitted registration form,
     * if errors are found, the user is redirected to correct the
     * information, if not, the user is effectively registered with
     * the system and an email is (optionally) sent to the newly
     * created user.
     */
    function  updateImage(){
        global $session, $database, $form, $sform;
        $target_dir = "uploads/";
        $time = time();

        
        
        $images = $_FILES['inputfile']['name'];
        $uploadfile = $_FILES["inputfile"]["tmp_name"];

        $random = uniqid(rand());
                if ($images) {
            $filename = stripcslashes($_FILES['inputfile']['name']);
            $extension = $this->getExtention($filename);
            $extension = strtolower($extension);
            $field = "image";
            if (( $extension != "jpg") && ($extension != "png") && ($extension != "jpeg") && ($extension != "gif" )) {
                $form->setError($field, "<script>alertify.notify(\"Image format not allowed!!!\", \"error\", 5, function(){});</script>");

//set error
            } else {
                $size = filesize($_FILES["inputfile"]["tmp_name"]);
                if ($size > MAX_SIZE * 1024) {
                    $form->setError($field, "<script>alertify.notify(\"Image size too huge!!!\", \"error\", 5, function(){});</script>");

                    //set error message
                }
                if ($extension == "jpg" || $extension == "jpeg") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];

                    $src = imagecreatefromjpeg($uploadfile);
                } elseif ($extension == "png") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];
                    $src = imagecreatefrompng($uploadfile);
                } else {
                    $src = imagecreatefromgif($uploadfile);
                }

                list($width, $height) = getimagesize($uploadfile);

                $newwidth = 470;
                $newheight = ($height / $width) * $newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                $newwidth1 = 100;
                $newheight1 = ($height / $width) * $newwidth1;
                $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

                $filename = $target_dir . $random . $time . "." . $extension;
                $filename1 = $target_dir . "thumbs/" . $random . $time . "." . $extension;
            }
        }
        $imagetosave = $filename . "," . $filename1;


        if ($images == "") {
            $imagetosave = "uploads/avatar.png,uploads/thumbs/avatar.png";
        }
        
      
        
         $q = "UPDATE " . TBL_USERS_EMPLOYEE . " SET image ='$imagetosave' WHERE  emp_id =".$session->userinfo['emp_id']."";
         $results = mysqli_query($database->connection, $q);
          $field = "image";
         if($results){
             $sform->setSuccess($field, "<script>alertify.notify(\"Image Uploaded!!!\", \"success\", 5, function(){});</script>");

              imagejpeg($tmp, $filename, 100);
            imagejpeg($tmp1, $filename1, 100);
            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            $_SESSION['success_array'] = $sform->getSuccessArray();
            header("Location:" . $session->referrer); // . $session->referrer);
         }else{
              $form->setError($field, "<script>alertify.notify(\"Image not uploaded\", \"error\", 5, function(){});</script>");

              $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location:" . $session->referrer); 
         }
    }
            
    function procEmployeeRegister() {
        global $session, $form, $sform;
        $target_dir = "uploads/";
        $formFirstName = filter_input(INPUT_POST, "form-first-name", FILTER_SANITIZE_STRING);
        $formLastName = filter_input(INPUT_POST, "form-last-name", FILTER_SANITIZE_STRING);
        $formDay = filter_input(INPUT_POST, "days", FILTER_SANITIZE_STRING);
        $formMonth = filter_input(INPUT_POST, "months", FILTER_SANITIZE_STRING);
        $formYear = filter_input(INPUT_POST, "years", FILTER_SANITIZE_STRING);
        $formGender = filter_input(INPUT_POST, "form-gender", FILTER_SANITIZE_STRING);
        $formPassword = filter_input(INPUT_POST, "form-password", FILTER_SANITIZE_STRING);
        $formConfirmPassword = filter_input(INPUT_POST, "form-confirm-pass", FILTER_SANITIZE_STRING);
        $formAddress = filter_input(INPUT_POST, "form-address", FILTER_SANITIZE_STRING);
        $formRegId = filter_input(INPUT_POST, "region", FILTER_SANITIZE_NUMBER_INT);
        $formLocId = filter_input(INPUT_POST, "location", FILTER_SANITIZE_NUMBER_INT);
        $formPhone = filter_input(INPUT_POST, "form-phone", FILTER_SANITIZE_STRING);
        $formEmail = filter_input(INPUT_POST, "form-email", FILTER_SANITIZE_EMAIL);
        $formProfession = filter_input(INPUT_POST, "profession", FILTER_SANITIZE_STRING);
        $formComment = filter_input(INPUT_POST, "form-comment", FILTER_SANITIZE_STRING);
        $formDob = $formDay . "-" . $formMonth . "-" . $formYear;
        $time = time();


        $images = $_FILES['inputfile']['name'];
        $uploadfile = $_FILES["inputfile"]["tmp_name"];

        $random = uniqid(rand());
        if ($images) {
            $filename = stripcslashes($_FILES['inputfile']['name']);
            $extension = $this->getExtention($filename);
            $extension = strtolower($extension);
            $field = "image";
            if (( $extension != "jpg") && ($extension != "png") && ($extension != "jpeg") && ($extension != "gif" )) {
                $form->setError($field, "<script>alertify.notify(\"Image format not allowed!!!\", \"error\", 10, function(){});</script>");

//set error
            } else {
                $size = filesize($_FILES["inputfile"]["tmp_name"]);
                if ($size > MAX_SIZE * 1024) {
                    $form->setError($field, "<script>alertify.notify(\"Image size too huge!!!\", \"error\", 10, function(){});</script>");

                    //set error message
                }
                if ($extension == "jpg" || $extension == "jpeg") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];

                    $src = imagecreatefromjpeg($uploadfile);
                } elseif ($extension == "png") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];
                    $src = imagecreatefrompng($uploadfile);
                } else {
                    $src = imagecreatefromgif($uploadfile);
                }

                list($width, $height) = getimagesize($uploadfile);

                $newwidth = 470;
                $newheight = ($height / $width) * $newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                $newwidth1 = 100;
                $newheight1 = ($height / $width) * $newwidth1;
                $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

                $filename = $target_dir . $random . $time . "." . $extension;
                $filename1 = $target_dir . "thumbs/" . $random . $time . "." . $extension;
            }
        }
        $imagetosave = $filename . "," . $filename1;


        if ($images == "") {
            $imagetosave = "uploads/avatar.png,uploads/thumbs/avatar.png";
        }

        /* Registration attempt */
        $retval = $session->register($formFirstName, $formLastName, $formDob, $formPassword, $formConfirmPassword, $formAddress, $formRegId, $formLocId, $formPhone, $formEmail, $formProfession, $formComment, $imagetosave, $formGender);

        /* Registration Successful */
        if ($retval == 0) {
            imagejpeg($tmp, $filename, 100);
            imagejpeg($tmp1, $filename1, 100);
            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            $_SESSION['reguname'] = $_POST['form-phone'];
            $_SESSION['regsuccess'] = true;
            $_SESSION['success_array'] = $sform->getSuccessArray();
            header("Location: login.php"); // . $session->referrer);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: registration.php"); // . $session->referrer);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['form-phone'];
            $_SESSION['regsuccess'] = false;
            header("Location: registration.php"); // . $session->referrer);
        }
    }

    function getExtention($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    function procEmployerRegister() {
        global $session, $form, $sform;
        $target_dir = "uploads/";
        $formFirstName = filter_input(INPUT_POST, "form-first-name", FILTER_SANITIZE_STRING);
        $formLastName = filter_input(INPUT_POST, "form-last-name", FILTER_SANITIZE_STRING);
        $formDay = filter_input(INPUT_POST, "days", FILTER_SANITIZE_STRING);
        $formMonth = filter_input(INPUT_POST, "months", FILTER_SANITIZE_STRING);
        $formYear = filter_input(INPUT_POST, "years", FILTER_SANITIZE_STRING);
        $formGender = filter_input(INPUT_POST, "form-gender", FILTER_SANITIZE_STRING);
        $formPassword = filter_input(INPUT_POST, "form-password", FILTER_SANITIZE_STRING);
        $formConfirmPassword = filter_input(INPUT_POST, "form-confirm-pass", FILTER_SANITIZE_STRING);
        $formAddress = filter_input(INPUT_POST, "form-address", FILTER_SANITIZE_STRING);
        $formRegId = filter_input(INPUT_POST, "region", FILTER_SANITIZE_NUMBER_INT);
        $formLocId = filter_input(INPUT_POST, "location", FILTER_SANITIZE_NUMBER_INT);
        $formPhone = filter_input(INPUT_POST, "form-phone", FILTER_SANITIZE_STRING);
        $formEmail = filter_input(INPUT_POST, "form-email", FILTER_SANITIZE_EMAIL);
        $formCompany = filter_input(INPUT_POST, "form-company", FILTER_SANITIZE_STRING);
        $formComment = filter_input(INPUT_POST, "form-comment", FILTER_SANITIZE_STRING);
        $formDob = $formDay . "-" . $formMonth . "-" . $formYear;
        $checkbox = implode(',', $_POST['professionals']);
        $time = time();


        $images = $_FILES['inputfile']['name'];
        $uploadfile = $_FILES["inputfile"]["tmp_name"];


        $random = uniqid(rand());
        if ($images) {
            $filename = stripcslashes($_FILES['inputfile']['name']);
            $extension = $this->getExtention($filename);
            $extension = strtolower($extension);
            $field = "image";
            if (( $extension != "jpg") && ($extension != "png") && ($extension != "jpeg") && ($extension != "gif" )) {
                $form->setError($field, "<script>alertify.notify(\"Image format not allowed!!!\", \"error\", 10, function(){});</script>");
            } else {
                $size = filesize($_FILES["inputfile"]["tmp_name"]);
                if ($size > MAX_SIZE * 1024) {
                    $form->setError($field, "<script>alertify.notify(\"Image size too huge!!!\", \"error\", 10, function(){});</script>");

                    //set error message
                }
                if ($extension == "jpg" || $extension == "jpeg") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];

                    $src = imagecreatefromjpeg($uploadfile);
                } elseif ($extension == "png") {
                    $uploadfile = $_FILES["inputfile"]["tmp_name"];
                    $src = imagecreatefrompng($uploadfile);
                } else {
                    $src = imagecreatefromgif($uploadfile);
                }

                list($width, $height) = getimagesize($uploadfile);

                $newwidth = 470;
                $newheight = ($height / $width) * $newwidth;
                $tmp = imagecreatetruecolor($newwidth, $newheight);

                $newwidth1 = 100;
                $newheight1 = ($height / $width) * $newwidth1;
                $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

                $filename = $target_dir . $random . $time . "." . $extension;
                $filename1 = $target_dir . "thumbs/" . $random . $time . "." . $extension;
            }
        }
        $imagetosave = $filename . "," . $filename1;


        if ($images == "") {
            $imagetosave = "uploads/avatar.png,uploads/thumbs/avatar.png";
        }
        /* Registration attempt */
        $retval = $session->registerEmployer($formFirstName, $formLastName, $formDob, $formPassword, $formConfirmPassword, $formAddress, $formRegId, $formLocId, $formPhone, $formEmail, $checkbox, $formCompany, $formComment, $imagetosave, $formGender);

        /* Registration Successful */
        if ($retval == 0) {
            imagejpeg($tmp, $filename, 100);
            imagejpeg($tmp1, $filename1, 100);
            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            $_SESSION['reguname'] = $_POST['form-phone'];
            $_SESSION['regsuccess'] = true;
            $_SESSION['success_array'] = $sform->getSuccessArray();
            header("Location: login.php"); // . $session->referrer);
        }
        /* Error found with form */ else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: registration.php"); // . $session->referrer);
        }
        /* Registration attempt failed */ else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['form-phone'];
            $_SESSION['regsuccess'] = false;
            header("Location: registration.php"); // . $session->referrer);
        }
    }

//    function procMasterRegister() {
//        global $session, $form;
//        /* Convert username to all lowercase (by option) */
//        if (ALL_LOWERCASE) {
//            $_POST['user'] = strtolower($_POST['user']);
//        }
//        /* Registration attempt */
//        $retval = $session->SessionMasterRegister($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['fname'], $_POST['sname'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['city'], $_POST['region'], $_POST['country'], $_POST['comment']);
//
//        /* Registration Successful */
//        if ($retval == 0) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = true;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Error found with form */ else if ($retval == 1) {
//            $_SESSION['value_array'] = $_POST;
//            $_SESSION['error_array'] = $form->getErrorArray();
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Registration attempt failed */ else if ($retval == 2) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = false;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//    }
//
//    function procMemberRegister() {
//        global $session, $form;
//        /* Convert username to all lowercase (by option) */
//        if (ALL_LOWERCASE) {
//            $_POST['user'] = strtolower($_POST['user']);
//        }
//        /* Registration attempt */
//        $retval = $session->SessionMemberRegister($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['fname'], $_POST['sname'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['city'], $_POST['region'], $_POST['country'], $_POST['comment']);
//
//        /* Registration Successful */
//        if ($retval == 0) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = true;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Error found with form */ else if ($retval == 1) {
//            $_SESSION['value_array'] = $_POST;
//            $_SESSION['error_array'] = $form->getErrorArray();
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Registration attempt failed */ else if ($retval == 2) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = false;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//    }
//
//    function procAgentRegister() {
//         global $session, $form;
//        /* Convert username to all lowercase (by option) */
//        if (ALL_LOWERCASE) {
//            $_POST['user'] = strtolower($_POST['user']);
//        }
//        /* Registration attempt */
//        $retval = $session->SessionAgentRegister($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['fname'], $_POST['sname'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['city'], $_POST['region'], $_POST['country'], $_POST['comment']);
//
//        /* Registration Successful */
//        if ($retval == 0) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = true;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Error found with form */ else if ($retval == 1) {
//            $_SESSION['value_array'] = $_POST;
//            $_SESSION['error_array'] = $form->getErrorArray();
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//        /* Registration attempt failed */ else if ($retval == 2) {
//            $_SESSION['reguname'] = $_POST['user'];
//            $_SESSION['regsuccess'] = false;
//            header("Location: " . $session->referrer . '?' . $session->username);
//        }
//    }

    /**
     * procForgotPass - Validates the given username then if
     * everything is fine, a new password is generated and
     * emailed to the address the user gave on sign up.
     */
    function procForgotPass() {
        global $database, $session, $mailer, $form;
        /* Username error checking */
        $subuser = $_POST['user'];
        $field = "user";  //Use field name for username
        if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
            $form->setError($field, "* Username not entered<br>");
        } else {
            /* Make sure username is in database */
            $subuser = stripslashes($subuser);
            if (strlen($subuser) < 5 || strlen($subuser) > 30 ||
                    !preg_match("/^([0-9a-z])+$/", $subuser) ||
                    (!$database->usernameTaken($subuser))) {
                $form->setError($field, "* Username does not exist<br>");
            }
        }

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
        }
        /* Generate new password and email it to user */ else {
            /* Generate new password */
            $newpass = $session->generateRandStr(8);

            /* Get email of user */
            $usrinf = $database->getUserInfo($subuser);
            $email = $usrinf['email'];

            /* Attempt to send the email with new password */
            if ($mailer->sendNewPass($subuser, $email, $newpass)) {
                /* Email sent, update database */
                $database->updateUserField($subuser, "password", md5($newpass));
                $_SESSION['forgotpass'] = true;
            }
            /* Email failure, do not change password */ else {
                $_SESSION['forgotpass'] = false;
            }
        }

        header("Location: " . $session->referrer);
    }

    /**
     * procEditAccount - Attempts to edit the user's account
     * information, including the password, which must be verified
     * before a change is made.
     */
    function procEditAccount() {
        global $session, $form;
        /* Account edit attempt */
        $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email']);

        /* Account edit successful */
        if ($retval) {
            $_SESSION['useredit'] = true;
            header("Location: " . $session->referrer);
        }
        /* Error found with form */ else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: " . $session->referrer);
        }
    }

}

;

/* Initialize process */
$process = new Process;
?>
