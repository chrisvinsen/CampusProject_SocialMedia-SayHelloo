<?php

    date_default_timezone_set('Asia/Jakarta');
	include '../model/post/Database.php';
	$db = new DB();

	session_start();
	if(!empty($_FILES['image']['name'])){
		$image = $_FILES['image']['name'];

		$user = $_SESSION['username'];

		//Image file directory
		$target = "../assets/images/user_photos/".basename($image);

		$postData = array(
            "photo_profile" => $image,
        );

        $condition = array('username' => $user);

        $update = $db->update('user', $postData, $condition);

        if(!empty($image)){
        	if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		  		$messages = "Failed to upload image";
		  	}
        }

        //Create A Post
		$content = $user . " just updated the profile photo!";	  

		$postData = array(
            "creator_username" => $user,
            "content" => $content,
            "images" => $image,
            "created_at" => date("Y-m-d H:i:s")
        );

        $insert = $db->insert("post", $postData);

	}else{
		$messages = "Can't post empty things";
        // header("Location: ../view/index.php");
        echo("<script>location.href = '../view/index.php'</script>");
	}


	if(!empty($_FILES['coverImg']['name'])){
		$image = $_FILES['coverImg']['name'];

		$user = $_SESSION['username'];

		//Image file directory
		$target = "../assets/images/user_photos/".basename($image);

		$postData = array(
            "cover_image" => $image,
        );

        $condition = array('username' => $user);

        $update = $db->update('user', $postData, $condition);

        if(!empty($image)){
        	if (!move_uploaded_file($_FILES['coverImg']['tmp_name'], $target)) {
		  		$messages = "Failed to upload image";
		  	}
        }

        //Create A Post
		$content = $user . " just updated the cover photo!";	  

		$postData = array(
            "creator_username" => $user,
            "content" => $content,
            "images" => $image,
            "created_at" => date("Y-m-d H:i:s")
        );

        $insert = $db->insert("post", $postData);

	}else{
		$messages = "Can't post empty things";
        // header("Location: ../view/index.php");
        echo("<script>location.href = '../view/index.php'</script>");
	}


?>