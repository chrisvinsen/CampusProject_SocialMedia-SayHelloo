<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    date_default_timezone_set('Asia/Jakarta');
    include '../model/post/Database.php';
    $db = new DB();

// Check existence of id parameter before processing further
if(isset($_GET["username"]) && !empty(trim($_GET["username"]))){
    // Include config file
    require_once "../koneksi_data/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM user WHERE username = :username";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username);
        
        // Set parameters
        $param_username = trim($_GET["username"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                
                $username = $row["username"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $username = $row["username"];
                $birth_date=$row["birth_date"];
               
                $description = $row['description'];
                $gender = $row["gender"];
                $password = $row["password"];
                $created_at = $row["created_at"];
                $update_at = $row["updated_at"];
                $delete_at = $row["deleted_at"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: ../view/error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../view/error.php");
    exit();
}
?>