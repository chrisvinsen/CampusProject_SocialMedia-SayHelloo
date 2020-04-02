<?php
	
	include '../model/post/Database.php';
	$db = new DB();

    date_default_timezone_set('Asia/Jakarta');

	if(isset($_GET['term'])){
		$return_arr = array();
		$searchTerm = trim(stripslashes(htmlspecialchars($_GET['term'])));	  

		$datas = array(
			"where" => array(
				"username" => $searchTerm,
				"first_name" => $searchTerm,
				"last_name" => $searchTerm
			)
			// "order_by" => "created_at DESC"
		);
	    $postData = $db->search("user", $datas);

		echo json_encode($postData);
	}
?>