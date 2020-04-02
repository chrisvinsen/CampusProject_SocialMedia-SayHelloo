<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
		include '../model/post/Database.php';
		$db = new DB();
	}
	$table = "post";

	date_default_timezone_set('Asia/Jakarta');

	$messages = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Get image name
		if(!empty($_FILES['images']['name']) || !empty($_POST['content'])){
			$image = $_FILES['images']['name'];

			$user = $_SESSION['username'];

			//Get Content
			$content = trim(stripslashes(htmlspecialchars($_POST['content'])));	  

			//Image file directory
			$target = "../assets/images/user_photos/".basename($image);

			$postData = array(
	            "creator_username" => $user,
	            "content" => $content,
	            "images" => $image,
	            "total_likes" => 0,
	            "total_comments" => 0,
	            "created_at" => date("Y-m-d H:i:s")
	        );

	        $insert = $db->insert($table, $postData);

	        if(!empty($image)){
	        	if (!move_uploaded_file($_FILES['images']['tmp_name'], $target)) {
			  		$messages = "Failed to upload image";
			  	}
	        }

	        $_SESSION['success_post'] = true;
	        unset($_SESSION['failed_post']);

	        if($_SESSION['created'] == 'profile')
	        	header("Location: ../view/profile.php?u=" . $_SESSION['username']);
	        else 
	        	header("Location: ../view/index.php");
		}else{
			$messages = "Can't post empty things";
			$_SESSION['failed_post'] = true;
	        unset($_SESSION['success_post']);
	        if($_SESSION['created'] == 'profile')
	        	header("Location: ../view/profile.php?u=" . $_SESSION['username']);
	        else 
	        	header("Location: ../view/index.php");
	        // header("Location: ../view/index.php");
            // echo("<script>location.href = '../view/index.php'</script>");
		}
	}

?>