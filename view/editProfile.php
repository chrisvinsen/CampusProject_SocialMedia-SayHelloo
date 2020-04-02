<?php 
    include "../controller/updateProfile.php";

    include "../controller/show_mini_profile_controller.php";
    include "../controller/suggestion_controller.php";

    if($_GET['username'] != $_SESSION['username']){
        echo("<script>location.href = 'index.php'</script>");
    }
    if(!isset($_SESSION['username'])){
        echo("<script>location.href = '../view/login.php'</script>");
    }
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <meta name="description" content="SayHelloo with your friends">
        <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
        <title>Say Helloo</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">

        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body style = "margin-top: 20px">
        <div class="container">
            <div class="row flex-lg-nowrap">
                <div class="col-12 col-lg-auto mb-3" style="width: 200px;"></div>
                <div class="col">
                    <div class="row">
                        <form class="form" action="editProfile.php?username=<?php echo $_SESSION['username'] ?>" method="post" enctype="multipart/form-data">
                            <div class="col mb-3">
                                <div class="card">
                                    <div class="card-body shadow-box">
                                        <div class="e-profile">
                                            <div class="row">
                                                <div class="col-12 col-sm-auto mb-3">
                                                    <img class="rounded-circle mx-auto d-block animated bounceInRight" src="../assets/images/<?php if(isset($Profile['photo_profile']) && $Profile['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $Profile['photo_profile'])) echo "user_photos/".$Profile['photo_profile']; else if($Profile['gender'] == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?>" alt="<?php echo $first_name . " " . $last_name; ?>" width="140px" height="140px" style="object-fit: cover;">
                                                </div>
                                                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3 animated bounceInLeft">
                                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $Profile['first_name'] . " " . $Profile['last_name']   ?></</h4>
                                                        <p class="mb-0"><?php echo $Profile['username']?></p>
                                                        <div class="mt-2">
                                                            <button class="btn" type="">
                                                            <i class="fa fa-fw fa-camera"></i>
                                                            <span>Change Photo Profile</span>
                                                            <input type="file" name="photo_profile" accept="image/x-png,image/gif,image/jpeg" class="dropify form-control text-center"/>
                                                            </button>
                                                            <small class="help-block text-danger"><?php echo $photo_profile_err;?></small>
                                                        </div>
                                                    </div>
                                                    <div class="text-center text-sm-right">
                                                        <small>Join SayHelloo on</small>
                                                        <div class="text-muted"><small><?php echo $Profile['created_at']?></small></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content pt-3">
                                                <div class="tab-pane active">
                                                    <div class="row animated zoomIn fast">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Username</label>
                                                                        <input class="form-control" type="text" name="username" disabled value="<?php echo $Profile['username']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                                                                        <label>First Name</label>
                                                                        <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; else echo $Profile['first_name']; ?>">
                                                                        <small class="help-block text-danger"><?php echo $first_name_err;?></small>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; else echo $Profile['last_name']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <textarea class="form-control" rows="5" name="description"><?php if(isset($_POST['description'])) echo $_POST['description']; else if($Profile['description']) echo $Profile['description']; else echo "Hi, I just used the Say Helloo application, nice to meet you."; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class = "row">
                                                                <div class = "col mb-3">
                                                                    <div class = "form-group">
                                                                        <label>Birth date</label>
                                                                        <input class="form-control" type="date" name="birth_date" value="<?php if(isset($_POST['birth_date'])) echo $_POST['birth_date']; else echo $Profile['birth_date']; ?>">
                                                                        <small class="help-block text-danger"><?php echo $birth_date_err;?></small>
                                                                    </div>
                                                                </div>
                                                                <div class = "col mb-3">
                                                                    <div class = "form-group">
                                                                        <label>Gender</label>
                                                                        <div class = "row" style = "padding-left: 15px">
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="male" name="gender" class="custom-control-input" value="M" <?php if($Profile['gender'] == "M"){echo "CHECKED";}?>/>
                                                                                <label class="custom-control-label" for="male">Male</label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                                <input type="radio" id="female" name="gender" class="custom-control-input" value="F" <?php if($Profile['gender'] == "F"){echo "CHECKED";}?>>
                                                                                <label class="custom-control-label" for="female">Female</label>
                                                                            </div>
                                                                        </div>
                                                                        <small class="help-block text-danger"><?php echo $gender_err;?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="mb-2">Click <a id="change-pass" class="font-weight-bold" style="cursor: pointer">Here</a> to change password</div>
                                                                    <div id="toogle-change-password">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label>New Password</label>
                                                                                    <input class="form-control" type="password" name="password" placeholder="New Password" >
                                                                                    <small class="help-block text-danger"><?php echo $password_err;?></small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="form-group">
                                                                                    <label>Re-type new Password</label>
                                                                                    <input class="form-control" type="password" name="cpassword" placeholder="Confirmation Password" >
                                                                                    <small class="help-block text-danger"><?php echo $cpassword_err;?></small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="font-weight-bold">Please Enter Your Password to Save Changes</span></label>
                                                                        <input class="form-control" type="password" name="old_password" placeholder="Confirmation Password" >
                                                                        <small class="help-block text-danger"><?php echo $old_password_err;?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col justify-content-start">
                                                            <input class="btn btn-primary animated bounceInRight" type="submit" id="btnSubmit" value="Save Changes"></input>
                                                            <a href = "showProfile.php?username=<?php echo $_GET['username'];?>"><button class="btn btn-danger animated bounceInLeft" type="button">Cancel</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="../assets/js/dropify.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/script.js"></script>

        <script>
            $(document).ready(function(){
                $("#toogle-change-password").hide();
                $("#change-pass").on('click', function(){
                    $("#toogle-change-password").toggle();
                })
            })
        </script>

    </body>
</html>