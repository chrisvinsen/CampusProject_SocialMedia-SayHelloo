<?php 
    session_start();
    require_once "../koneksi_data/config.php";

    date_default_timezone_set('Asia/Jakarta');

    // Define variables and initialize with empty values
    $uname = $fname = $lname = $bdate = $gender = $pass = $cpass = "";
    $uname_err = $fname_err = $lname_err = $bdate_err = $gender_err = $pass_err = $cpass_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Validate First Name
        $input_fname = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['fname'])))));
        if(empty($input_fname)){
            $fname_err = "Please enter a first name.";
        } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $fname_err = "Please enter a valid first name.";
        } else{
            $fname = $input_fname;
        }

        // Validate Last Name
        $input_lname = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['lname'])))));
        if(empty($input_lname)){
            $lname_err = '';
        } else if(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $lname_err = "Please enter a valid last name.";
        } else{
            $lname = $input_lname;
        }

        // Validate Username
        $input_uname = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['uname'])))));
        $sql1 = "SELECT * FROM user WHERE username= :uname";
        $stmt = $pdo->prepare($sql1);
        
        $stmt->bindParam(":uname",$input_uname);
        $stmt->execute();

        $cek = $stmt->fetch(PDO :: FETCH_ASSOC);

        if(empty($input_uname)){
            $uname_err = "Please enter a username.";
        }elseif($cek === FALSE){
            $uname = $input_uname;
        }else{
            $uname_err = "Username has been used.";
        }

        // Validate birthdate
        $input_bdate = trim($_POST["bdate"]);
        if(empty($input_bdate)){
            $bdate_err = "Please enter a birth date.";     
        } else{
            $bdate = $input_bdate;
        }

        // Validate Gender
        //$input_gender = trim($_POST["gender"]);
        if(!isset($_POST['gender'])){
            $gender_err = "Please choose a gender.";     
        } else{
            $gender = trim($_POST["gender"]);
        }

        // Validate Password
        $input_pass = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['pass'])))));
        if(empty($input_pass)){
            $pass_err = "Please enter a password.";     
        }elseif(strlen($input_pass) < 8){
            $pass_err = "Password must be at least 8 character.";
        }

        // Validate Confirm Password
        $input_cpass = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['cpass'])))));
        $timestamp = date("Y-m-d H:i:s");
        if(empty($input_cpass)){
            $cpass_err = "Please enter a confirmation password.";     
        }elseif($input_cpass != $input_pass){ 
            $cpass_err = "Please enter a match password";
        }elseif(strlen($input_cpass) < 8){
            $cpass_err = "Password must be at least 8 character.";
        }else{
            $pass = md5($input_cpass . $timestamp);
        }   
        
        if(empty($fname_err) && empty($lname_err) && empty($uname_err) && empty($bdate_err) && empty($gender_err) && empty($pass_err) && empty($cpass_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO user (username, first_name, last_name, birth_date, gender, password, connection, created_at, updated_at) VALUES (:uname, :fname, :lname, :bdate, :gender, :pass, 0, :timestamp, :timestamp)";
     
            if($stmt = $pdo->prepare($sql)){    
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":uname", $param_uname);
                $stmt->bindParam(":fname", $param_fname);
                $stmt->bindParam(":lname", $param_lname);
                $stmt->bindParam(":bdate", $param_bdate);
                $stmt->bindParam(":gender", $param_gender);
                $stmt->bindParam(":pass", $param_pass);
                $stmt->bindParam(":timestamp", $param_timestamp);
                
                // Set parameters
                $param_uname = $uname;
                $param_fname = $fname;
                $param_lname = $lname;
                $param_bdate = $bdate;
                $param_gender = $gender;
                $param_pass = $pass;
                $param_timestamp = $timestamp;
                
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Records created successfully. Redirect to landing page
                    // header("location: ../view/login.php");
                    $_SESSION['success_register'] = true;
                    echo("<script>location.href = '../view/login.php'</script>");
                    exit();
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            unset($stmt);
        }else{
            $_SESSION['failed_register'] = true;
        }

        unset($pdo);        
        
    }

?>