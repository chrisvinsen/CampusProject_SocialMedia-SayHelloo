<?php 
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    unset($_SESSION['status']);
    unset($_SESSION['username']);
    session_destroy();
    header("location: ../view/login.php");
?>