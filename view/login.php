<?php
	include "../controller/login.php";

    if(!empty(isset($_SESSION['status']))){
        // header("location: index.php");
        echo("<script>location.href = '../view/index.php'</script>");
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Say Helloo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
    	<meta name="description" content="SayHelloo with your friends">
	    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
	    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	    <!-- Fontawesome -->
    	<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="../assets/fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="../assets/css/register.css">
		<link rel="stylesheet" href="../assets/css/animate.css">

	</head>
	<body>
		<div class="wrapper" id="wrapper_register">
			<div class="inner">
				<img src="../assets/images/sign-in-2.png" alt="" class="animated bounceInLeft image-1" id="r_image_1">
				<form class="animated flipInY" action="login.php" method="post">
					<h3>Log In?</h3>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-user"></span>
							<input type="text" class="form-control" placeholder="Username" id="uname" name="uname">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $uname_err;?></span>
					</div>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-lock"></span>
							<input type="password" class="form-control" placeholder="Password" id="pass" name="pass">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $pass_err;?></span>
					</div>
					<div class="form-holder">
						<div>
							<img class="mx-auto d-block" src="../controller/captcha.php" alt="Captcha" />
						</div>						
						<div style="width:100%; position: relative;">
							<span class="fa fa-lock"></span>
							<input type="text" class="form-control" placeholder="Captcha" id="capt" name="capt">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $capt_err;?></span>
					</div>
					<span style="color: #FF0000; position:static"><?php echo $login_err;?></span>
					<button type="submit" name="submit" value="Submit">
						<span>Log In</span>
					</button>
					
					<span class="float-right my-2"><b>Don't have an account? <a href="register.php" style="text-decoration: none">Register Now</b><a></span>
				</form>
				<img src="../assets/images/cherry-welcome.png" alt="" class="image-2 animated bounceInRight" id="r_image_2" style="z-index: 99;">
			</div>
			
		</div>
		
		 
		<!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>


    <!-- Alert Registration Sucessful -->
    <?php
        if(isset($_SESSION['success_register'])){
    ?>         
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script> 
                $(document).ready(function(){
					const Toast = Swal.mixin({
					    toast: true,
					    position: 'top-end',
					    showConfirmButton: false,
					    timer: 3000,
					    timerProgressBar: true,
					    onOpen: (toast) => {
					    	toast.addEventListener('mouseenter', Swal.stopTimer)
					    	toast.addEventListener('mouseleave', Swal.resumeTimer)
					    }
					})

					Toast.fire({
					    icon: 'success',
					    title: 'Registration Successful'
					})
                });   
            </script>
    <?php
        unset($_SESSION['success_register']);
        }
    ?>


    <!-- Alert Login Failed -->
    <?php
        if(isset($_SESSION['failed_login'])){
    ?>         
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script> 
                $(document).ready(function(){
					const Toast = Swal.mixin({
					    toast: true,
					    position: 'top-end',
					    showConfirmButton: false,
					    timer: 3000,
					    timerProgressBar: true,
					    onOpen: (toast) => {
					    	toast.addEventListener('mouseenter', Swal.stopTimer)
					    	toast.addEventListener('mouseleave', Swal.resumeTimer)
					    }
					})

					Toast.fire({
					    icon: 'error',
					    title: 'Login Failed'
					})
                });   
            </script>
    <?php
        unset($_SESSION['failed_login']);
        }
    ?>

	</body>
</html>