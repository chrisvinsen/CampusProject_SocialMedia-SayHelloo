<?php
	include "../controller/register.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
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
				<img src="../assets/images/sign-up-3.png" alt="" class="image-1 animated bounceInLeft" id="r_image_1">
				<form action="register.php" method="post" class="animated flipInY my-3">
					<h3>New Account?</h3>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-user"></span>
							<input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $fname; ?>">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $fname_err;?></span>
					</div>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-user"></span>
							<input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $lname; ?>">
						</div>
						<div style="display: block; margin-top: 5px; margin-bottom: 10px; color: #FF0000;"><?php echo $lname_err;?></div>
					</div>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-user"></span>
							<input type="text" name="uname" class="form-control" placeholder="Username" value="<?php echo $uname; ?>">
						</div>
						<span style="color: #FF0000; position:static;"><?php echo $uname_err;?></span>
					</div>
					<p>Birth Date</p>
					<div class="form-holder <?php echo (!empty($bdate_err)) ? 'has-error' : ''; ?>">
						<div style="width:100%; position: relative;">
							<span class="fa fa-calendar"></span>
							<input type="date" name="bdate" class="form-control" placeholder="DD/MM/YYYY" value="<?php echo $bdate; ?>">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $bdate_err;?></span>
					</div>
					<div class="row px-5 form-holder">
						<div style="width:100%; position: relative;" class="row px-5 form-holder">
							<div class="custom-control custom-radio custom-control-inline m-0 col-6">
							<input type="radio" class="custom-control-input" id="male" name="gender" value="M">
							<label class="custom-control-label" for="male">Male</label>
							</div>
							
							<div class="custom-control custom-radio custom-control-inline m-0 col-6">
							<input type="radio" class="custom-control-input" id="female" name="gender" value="F">
							<label class="custom-control-label" for="female">Female</label>
							</div>
						</div>
						<div style="color: #FF0000; position:static"><?php echo $gender_err;?></div>
					</div>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-lock"></span>
							<input type="password" name="pass" class="form-control" placeholder="Password">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $pass_err;?></span>
					</div>
					<div class="form-holder">
						<div style="width:100%; position: relative;">
							<span class="fa fa-lock"></span>
							<input type="password" name="cpass" class="form-control" placeholder="Confirm Password">
						</div>
						<span style="color: #FF0000; position:static"><?php echo $cpass_err;?></span>
					</div>
					<button type="submit" name="submit" value="Submit">
						<span>Register</span>
					</button>
					<span class="float-left my-2"><b>Already have an account? <a href="login.php" style="text-decoration: none">Log in now</b><a></span>
				</form>
				<img src="../assets/images/cherry-waiting.png" alt="" class="image-2" id="r_image_2">
			</div>
			
		</div>
		
		 
		<!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>

    <!-- Alert Registration Failed -->
    <?php
        if(isset($_SESSION['failed_register'])){
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
					    title: 'Registration Failed'
					})
                });   
            </script>
    <?php
        unset($_SESSION['failed_register']);
        }
    ?>

	</body>
</html>