<?php
    //mulai session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    date_default_timezone_set('Asia/Jakarta');
    
    require_once "../koneksi_data/config.php";
    $login_err = $uname_err = $pass_err = $capt_err = "";
    $uname = $pass = $login = $capt = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $input_uname = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['uname'])))));
        if(empty($input_uname)){
            $uname_err = "Please enter a username.";
        }else{
            $uname = $input_uname;
        }
        
        $input_pass = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['pass'])))));
        if(empty($input_pass)){
            $pass_err = "Please enter a password.";     
        }else{
            $pass = $input_pass;
        }

        $input_capt = trim(stripslashes(htmlentities(strip_tags(htmlspecialchars($_POST['capt'])))));
        $input_scapt = $_SESSION["code"];
        if(empty($input_capt)){
            $capt_err = "Please enter the captcha code";
        }elseif($input_capt != $input_scapt){
            $capt_err = "Wrong Captha input";
        }

        if(empty($pass_err) && empty($uname_err) && empty($capt_err)){         
            
                       
            // Prepare an select statement untuk cari salt
            $sql = "SELECT created_at from user WHERE username= :uname";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":uname",$uname);
            $stmt->execute();
            $salt = $stmt->fetch(PDO :: FETCH_COLUMN);
            
            $pass = md5($pass. $salt);
            
            //cari data di database
            $sql = "SELECT * FROM user WHERE username = :uname AND password= :pass";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(":uname",$uname);
            $stmt->bindParam(":pass",$pass);
            $stmt->execute();
            
            $cek = $stmt->fetch(PDO :: FETCH_ASSOC);

            if($cek === FALSE){	
                $login_err = "Username or Password Wrong.";	
            }
            else{
                $_SESSION['status'] = "login";
                $_SESSION['username'] = $uname;
                $_SESSION['success_login'] = true;
                // header("location: ../view/index.php");
                echo("<script>location.href = '../view/index.php'</script>");
                exit();
            }
        }else{
            $_SESSION['failed_login'] = true;   
        }
    }
?>