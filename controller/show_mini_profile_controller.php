<?php
    date_default_timezone_set('Asia/Jakarta');
    $user = $_SESSION['username'];

	$iProfile = array(
		"where" => array(
			"username" => $user
		),
		"return_type" => "single"
	);

    $Profile = $db->getRows("user", $iProfile);

    $miniProfile = array(
    	"first_name" => $Profile['first_name'],
    	"last_name" => $Profile['last_name'],
    	"description" => $Profile['description'],
    	"gender" => strtoupper($Profile['gender']),
		"photo_profile" => $Profile['photo_profile'],
		"cover_image" => $Profile['cover_image'],
		"connection" => $Profile['connection']
    );

    $firstName = $Profile['first_name'];
    $photoProfile = $Profile['photo_profile'];

?>