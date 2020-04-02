<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'sayhelloo');
    // define('DB_SERVER', 'localhost');
    // define('DB_USERNAME', 'id12788801_admin_sayhelloo');
    // define('DB_PASSWORD', 'password_sayhelloo');
    // define('DB_NAME', 'id12788801_sayhelloo');

    date_default_timezone_set('Asia/Jakarta');

    function showComments($post_id){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        $query = "SELECT * FROM post_comments AS pc JOIN user AS u ON (pc.commenter = u.username AND pc.post_id = '$post_id')";
        $result = $conn->query($query);
        $data = array();
        foreach($result as $row){
            $temp = array();
            array_push($temp, $row['no']);
            array_push($temp, $row['post_id']);
            array_push($temp, $row['commenter']);
            array_push($temp, $row['comment']);
            array_push($temp, $row['created_at']);
            array_push($temp, $row['updated_at']);
            array_push($temp, $row['deleted_at']);
            array_push($temp, $row['photo_profile']);
            array_push($temp, $row['gender']);
            array_push($temp, $row['first_name']);
            array_push($temp, $row['last_name']);
            array_push($data, $temp);
        }
        $result = null;
        $conn = null;
        return $data;
    }

    function addComment($post_id){
        if(isset($_POST['btnComment'])){
            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
            $commenter = $_SESSION['username'];
            $comment = $_POST['comment'];
            $created_at = date("Y-m-d H:i:s");
            if($comment == ''){
                echo "<script>alert('Harap ketikkan comment Anda!);</script>";
                return;
            }
            $query = "INSERT INTO post_comments (post_id, commenter, comment, created_at) VALUES ('$post_id', '$commenter', '$comment', '$created_at')";
            $result = $conn->query($query);
            $query = "UPDATE post SET total_comments = (total_comments + 1) WHERE post_id = '$post_id'";
            $result = $conn->query($query);
            $result = null;
            $conn = null;
            echo '<script> location.replace("../view/moreChat.php?post_id=' . $post_id . '"); </script>';
            // header("location: ../view/moreChat.php");
        }
    }

    $conn = null;
?>