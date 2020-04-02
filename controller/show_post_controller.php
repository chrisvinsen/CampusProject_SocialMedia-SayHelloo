<?php
	
    session_start();
    date_default_timezone_set('Asia/Jakarta');
	include '../model/post/Database.php';
	$db = new DB();

	$user = $_SESSION['username'];

	$messages = '';

	$data = array(
		"join" => array(
			"table" => "user",
			"creator_username" => "username"
		),
		"order_by" => "created_at DESC"
	);
	$postData = $db->getRows("post", $data);

	$dataUser = array(
    	"where" => array(
    		"username" => $user
    	),
    	"return_type" => "single"
    );
	$dataUser = $db->getRows("user", $dataUser);


    function getUser($post_id){
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($conn === false) die("ERROR: Could not connect to database!" . mysqli_connect_error());
        $query = "SELECT * FROM post AS p JOIN user AS u ON (p.creator_username = u.username AND p.post_id = '$post_id')";
        $result = $conn->query($query);
        $data = array();
        foreach($result as $row){
            $temp = array();
			array_push($temp, $row['post_id']);
            array_push($temp, $row['creator_username']);
            array_push($temp, $row['content']);
            array_push($temp, $row['images']);
            array_push($temp, $row['total_likes']);
            array_push($temp, $row['total_comments']);
            array_push($temp, $row['created_at']);
            array_push($temp, $row['first_name']);
            array_push($temp, $row['last_name']);
			array_push($temp, $row['gender']);
			array_push($temp, $row['photo_profile']);
            array_push($data, $temp);
        }
        $result = null;
        $conn = null;
        return $data;
    }

    // echo json_encode($postData);

    // $postData = $db->getRows($table, $data);
    function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	function getUserData($username){
		$db = new DB();
		$condition = array(
			"where" => array(
				"username" => $username
			),
			"return_type" => "single"
		);
		$data_user = $db->getRows("user", $condition);
		return $data_user;

	}

?>