<?php

    date_default_timezone_set('Asia/Jakarta');
    
    $user = $_SESSION['username'];

	$dataU = array(
		"where not" => array(
			"username" => $user
		),
		"order_by" => "created_at DESC",
		"start" => "0",
		"limit" => "5"
	);

    $Users = $db->getRows("user", $dataU);

?>