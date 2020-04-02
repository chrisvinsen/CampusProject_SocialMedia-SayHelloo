<?php
date_default_timezone_set('Asia/Jakarta');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../model/post/Database.php';
$db = new DB();

$first_name = $birth_date = $gender = $password = $old_password = '';
$first_name_err = $birth_date_err = $gender_err = $photo_profile_err = $password_err = $cpassword_err = $old_password_err ='';
 
// Processing form data when form is submitted
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $user = $_SESSION['username'];

    $profile = array(
        "where" => array(
            "username" => $user
        ),
        "return_type" => "single"
    );
    $user_profile = $db->getRows("user", $profile);
    

    // Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if(empty($input_first_name)){
        $first_name_err = "Please enter your first name.";
    } else{
        $first_name = $input_first_name;
    }

    // Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if(empty($input_last_name)){
        $last_name = '';
    } else{
        $last_name = $input_last_name;
    }

      // validate birth_date
    $input_birth_date = trim($_POST["birth_date"]);
    if(empty($input_birth_date)){
        $birth_date_err = "Please enter your birth date.";
    } else{
        $birth_date = $input_birth_date;
    }
    // validate gender
    if(!isset($_POST['gender'])){
        $gender_err = "Please choose your gender.";     
    } else{
        $gender = trim($_POST["gender"]);
    }

    // Validate Password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "";     
    }else if(strlen($input_password) < 8){
        $password_err = "Password must be at least 8 character.";
    }else{
        $password = $input_password;
    }

    // Validate Re-type Password
    $input_cpassword = trim($_POST["cpassword"]);
    if(empty($input_cpassword) && empty($input_password)){
        $cpassword_err = "";     
    }else if(strcmp($input_cpassword,$input_password) != 0){ 
        $cpassword_err = "Please enter a match password";
    }else if(strlen($input_cpassword) < 8){
        $cpassword_err = "Password must be at least 8 character.";
    }else if($input_cpassword != $password){
        $cpassword_err = "Password doesn't match.";
    }

    //Validate Confirmation Password
    $input_old_password = trim($_POST["old_password"]);
    if(empty($input_old_password)){
        $old_password_err = "Confirmation password must be filled. Please enter your current password";
    }else if(md5($input_old_password . $user_profile['created_at']) != $user_profile['password']){
        $old_password_err = "Confirmation password wrong. Please enter your current password";
    }else{
        $old_password_err = '';
    }

    //Final
    if(empty($first_name_err) && empty($birth_date_err) && empty($gender_err) && empty($password_err) && empty($cpassword_err) && empty($old_password_err)){

        $photo_profile = $_FILES['photo_profile']['name'];

        //Get Description
        $description = trim(stripslashes(htmlspecialchars($_POST['description'])));	  

        //Image file directory
        $target = "../assets/images/user_photos/".basename($photo_profile);

        $timestamp = date("Y-m-d H:i:s");

        $condition = array('username' => $user);

        if(!empty($password)){
            $userData = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'birth_date' => $birth_date,
                'gender' => $gender,
                'description' => $description,
                'password' => md5($password.$timestamp),
                'created_at' => $timestamp
            );
        }else{
            $userData = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'birth_date' => $birth_date,
                'gender' => $gender,
                'description' => $description,
            );
        }

        if(!empty($photo_profile)){
            $userPProfile = array(
                'photo_profile' => $photo_profile,
                'updated_at' => $timestamp
            );

            $update_photo_profile = $db->update('user', $userPProfile, $condition);

            if (!move_uploaded_file($_FILES['photo_profile']['tmp_name'], $target)) {
                $photo_profile_err = "Failed to upload image";
            }

            //Create A Post
            $content = $user . " just updated the profile photo!";      
            $postData = array(
                "creator_username" => $user,
                "content" => $content,
                "images" => $photo_profile,
                "created_at" => date("Y-m-d H:i:s")
            );
            $insert = $db->insert("post", $postData);
        }

        $update = $db->update('user', $userData, $condition);


        // header("Location: ../view/showProfile.php?username=" . $user);
        echo '<script> location.href="../view/showProfile.php?username=' . $user . '"; </script>';
        // echo("<script>location.href = '../view/login.php'</script>");
    }else{
        $messages = "Can't post empty things";
        // header("Location: ../view/err.php");
    }
 
}


?>