<?php 
    require_once "../controller/show-data-profile.php";

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
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-body shadow-box">
                                    <div class="e-profile">
                                        <div class="row">
                                            <div class="col-12 col-sm-auto mb-3">
                                                <div class="mx-auto" style="width: 140px;">
                                                    <img class="rounded-circle mx-auto d-block animated bounceInRight" src="../assets/images/<?php if(isset($row['photo_profile']) && $row['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $row['photo_profile'])) echo "user_photos/".$row['photo_profile']; else if($row['gender'] == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?>" alt="<?php echo $first_name . " " . $last_name; ?>" width="140px" height="140px" style="object-fit: cover;">
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3 animated bounceInLeft">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $row["first_name"]; echo " ".$row["last_name"]?></h4>
                                                    <p class="mb-0"><?php echo $row["username"]?></p>
                                                    <div class="mt-2">
                                                        <a href = "editProfile.php?username=<?php echo $_SESSION['username'];?>">
                                                            <button class="btn btn-primary" type="button">
                                                            <!-- <i class="fa fa-fw fa-camera"></i> -->
                                                            <span>Edit Profile</span>
                                                            </button>
                                                        </a>
                                                        <a href = "index.php">
                                                            <button class="btn btn-primary" type="button">
                                                            <!-- <i class="fa fa-fw fa-camera"></i> -->
                                                            <span>Home</span>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="text-center text-sm-right">
                                                    <span class="badge badge-secondary">Registered on</span>
                                                    <div class="text-muted"><small><?php echo $row["created_at"]?></small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <!-- <li class="nav-item"><a href="" class="active nav-link">Settings</a></li> -->
                                        </ul>
                                        <div class="tab-content pt-3">
                                            <div class="tab-pane active">
                                                <form class="form" novalidate="">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class = "col-3 offset-3">
                                                                    <div class = "form-group float-right animated bounceInLeft faster">
                                                                        <label><h5>Name</h5></label>
                                                                    </div>
                                                                </div>
                                                                <div class = "col">
                                                                    <div class = "form-group animated bounceInRight faster">
                                                                        <p><?php echo $row["first_name"]; echo " ".$row["last_name"]?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class = "col-3 offset-3">
                                                                    <div class = "form-group float-right animated bounceInLeft faster">
                                                                        <label><h5>Username</h5></label>
                                                                    </div>
                                                                </div>
                                                                <div class = "col">
                                                                    <div class = "form-group animated bounceInRight faster">
                                                                        <p><?php echo $row["username"]?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class = "col-3 offset-3">
                                                                    <div class = "form-group float-right animated bounceInLeft fast">
                                                                        <label><h5>Description</h5></label>
                                                                    </div>
                                                                </div>
                                                                <div class = "col">
                                                                    <div class = "form-group animated bounceInRight fast">
                                                                        <p><?php if($row['description']) echo $row['description']; else echo "Hi, I just used the <b>Say Helloo</b> application, nice to meet you."; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class = "col-3 offset-3">
                                                                    <div class = "form-group float-right animated bounceInLeft slow">
                                                                        <label><h5>Birthdate</h5></label>
                                                                    </div>
                                                                </div>
                                                                <div class = "col">
                                                                    <div class = "form-group animated bounceInRight slow">
                                                                        <p><?php echo $row["birth_date"]?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class = "col-3 offset-3">
                                                                    <div class = "form-group float-right animated bounceInLeft slower">
                                                                        <label><h5>Gender</h5></label>
                                                                    </div>
                                                                </div>
                                                                <div class = "col">
                                                                    <div class = "form-group animated bounceInRight slower">
                                                                        <p><?php if($row["gender"] == "F") echo "Female"; else echo "Male"; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <img src="../assets/images/sign-up-3.png" alt="" class="image-1 rounded mx-auto d-block animated fadeInDown" id="r_image_1" width = "309" height = "456">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>