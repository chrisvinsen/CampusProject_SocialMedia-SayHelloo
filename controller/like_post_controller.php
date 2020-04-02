<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	include '../model/post/Database.php';
	$db = new DB();

	date_default_timezone_set('Asia/Jakarta');

	$messages = '';

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$post_id = trim(stripslashes(htmlspecialchars($_POST['p'])));
		$current_likes = trim(stripslashes(htmlspecialchars($_POST['l'])));

        if(!$current_likes){
            $current_likes = 0;
        }

		$liker = $_SESSION['username'];

		$likeData = array(
			"post_id" => $post_id,
            "username_liker" => $liker,
            "created_at" => date("Y-m-d H:i:s")
        );

    	$checkDuplicate = $db->getRows("post_likes",array('where'=>array('post_id'=> $post_id, 'username_liker' => $liker), 'return_type' => 'count'));

    	$updatePostLikes = array(
            "total_likes" => $current_likes + 1,
        );

		if($checkDuplicate == 0){
        	$insert = $db->insert("post_likes", $likeData);
        	$response = array(
        		"status" => true,
        		"post_id" => $post_id,
                "total_likes" => $current_likes + 1
        	);
            $condition = array("post_id" => $post_id);
            $update = $db->update("post", $updatePostLikes, $condition);
            
		}else{
			$response = array(
        		"status" => false,
        		"post_id" => $post_id,
                "total_likes" => $current_likes
        	);
		}
		echo json_encode($response, JSON_UNESCAPED_UNICODE);

        // header("Location: ../view/index.php");

	}

?>