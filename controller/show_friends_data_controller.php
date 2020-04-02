<?php
	
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    date_default_timezone_set('Asia/Jakarta');
	include '../model/post/Database.php';
	$db = new DB();

	if(isset($_GET["u"]) && !empty(trim($_GET["u"]))){
        $username =  trim(stripslashes(htmlspecialchars($_GET['u']))); 

        $data = array(
			"where" => array(
				"creator_username" => $username
			),
			"order_by" => "created_at DESC"
		);     

    	$postFData = $db->getRows("post", $data);

    	$dataUser = array(
	    	"where" => array(
	    		"username" => $username
	    	),
	    	"return_type" => "single"
	    );

	    $dataUser = $db->getRows("user", $dataUser);

    } else{
        // header("location: ../view/index.php");
        echo("<script>location.href = '../view/index.php'</script>");
        exit();
    }

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