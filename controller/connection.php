<?php
    if(!defined('DB_SERVER')){
        define('DB_SERVER', 'localhost');
    }
    if(!defined('DB_USERNAME')){
        define('DB_USERNAME', 'root');
    }
    if(!defined('DB_PASSWORD')){
        define('DB_PASSWORD', '');
    }
    if(!defined('DB_NAME')){
        define('DB_NAME', '');
    }

    // if(!defined('DB_SERVER')){
    //     define('DB_SERVER', 'localhost');
    // }
    // if(!defined('DB_USERNAME')){
    //     define('DB_USERNAME', 'id12788801_admin_sayhelloo');
    // }
    // if(!defined('DB_PASSWORD')){
    //     define('DB_PASSWORD', 'password_sayhelloo');
    // }
    // if(!defined('DB_NAME')){
    //     define('DB_NAME', 'id12788801_sayhelloo');
    // }
    
    date_default_timezone_set('Asia/Jakarta');

    function getStatus($username, $username_connection){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        $query = "SELECT * FROM connection WHERE username = '$username' AND username_connection = '$username_connection'";
        $result = $conn->query($query);
        $data = array();
        if (is_array($result) || is_object($result))
        {
            foreach($result as $row){
                $temp = array();
                array_push($temp, $row['status']);
                array_push($data, $temp);
            }
        }
        $result = null;
        $conn = null;
        return $data;
    }

    function connect($username, $username_connection){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        if(isset($_POST['btnConnect'])){
            echo '<script>console.log("' . $username . '");</script>';
            echo '<script>console.log("' . $username_connection . '");</script>';
            $query = "INSERT INTO connection (username, username_connection, status) VALUES ('$username', '$username_connection', 'pending')";
            $result = $conn->query($query);
            if($result) echo '<script>console.log("' . $username . '");</script>';
            else echo '<script>console.log("Failed");</script>';
            $result = null;
            $conn = null;
            echo '<script> location.replace("../view/profile.php?u=' . $username_connection . '"); </script>';
        }
    }

    function unconnect($username, $username_connection){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        if(isset($_POST['btnUnconnect'])){
            $query = "DELETE FROM connection WHERE username = '$username' AND username_connection = '$username_connection'";
            $result = $conn->query($query);
            $query = "UPDATE user SET connection = (connection - 1) WHERE username = '$username'";
            $result = $conn->query($query);
            $result = null;
            $conn = null;
            echo '<script> location.replace("../view/profile.php?u=' . $username_connection . '"); </script>';
        }
    }

    function showRequest($username){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        $query = "SELECT * FROM connection AS c JOIN user AS u ON (c.username_connection = '$username' AND c.username = u.username AND c.status = 'pending')";
        $result = $conn->query($query);
        $data = array();
        if (is_array($result) || is_object($result))
        {
            foreach($result as $row){
                $temp = array();
                array_push($temp, $row['username']);
                array_push($temp, $row['first_name']);
                array_push($temp, $row['last_name']);
                array_push($temp, $row['gender']);
                array_push($temp, $row['photo_profile']);
                array_push($data, $temp);
            }
        }
        $result = null;
        $conn = null;
        return $data;
    }

    function accept($username){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        if(isset($_POST['btnAccept'])){
            $username_connection = $_SESSION['username'];
            echo '<script>console.log("' . $username_connection . '");</script>';
            $query = "UPDATE connection SET status = 'accepted' WHERE username = '$username' AND username_connection = '$username_connection'";
            $result = $conn->query($query);
            $query = "UPDATE user SET connection = (connection + 1) WHERE username = '$username'";
            $result = $conn->query($query);
            $query = "UPDATE user SET connection = (connection + 1) WHERE username = '$username_connection'";
            $result = $conn->query($query);
            $result = null;
            $conn = null;
            echo '<script> location.replace("../view/index.php"); </script>';
        }
    }
    
    function decline($username){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        if(isset($_POST['btnDecline'])){
            $username_connection = $_SESSION['username'];
            $query = "DELETE FROM connection WHERE username = '$username' AND username_connection = '$username_connection'";
            $result = $conn->query($query);
            $result = null;
            $conn = null;
            echo '<script> location.replace("../view/index.php"); </script>';
        }
    }

    $conn = null;
?>