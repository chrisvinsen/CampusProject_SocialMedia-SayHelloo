<?php
    include "../controller/show_friends_data_controller.php";
    include "../controller/create_post_controller.php";
    include "../controller/connection.php";

    include "../controller/show_mini_profile_controller.php";
    include "../controller/suggestion_controller.php";

    if(!isset($_SESSION['username'])){
        echo("<script>location.href = '../view/login.php'</script>");
    }
    $_SESSION['created'] = "profile";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Say Helloo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SayHelloo with your friends">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/w3.css">
    <link rel="stylesheet" href="../assets/css/theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">  

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="../assets/css/dropify.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/animate.css">

    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        html, body {
          height: 100%;
          margin: 0;
        }

        .full-height {
          height: 100%;
        }
    </style>
</head>
<body class="w3-theme-l5">
    <div class="wrapper full-height" id="main_content2" style="margin-top: 55px;">
        <!-- Header -->
        <?php
            include "header.php";
        ?>

        <?php 
            if(isset($dataUser['username'])){
                ?>
                <!-- Background -->
                <section class="cover-sec">
                    <img class="portrait" src="../assets/images/<?php if(isset($dataUser['cover_image']) && $dataUser['cover_image'] != null && file_exists('../assets/images/user_photos/' . $dataUser['cover_image'])) echo "user_photos/".$dataUser['cover_image']; else echo "cover.png"; ?> " alt="">
                    <?php
                        if($_GET['u'] == $_SESSION['username']){
                            ?>
                            <div class="add-pic-box">
                                <div class="container">
                                    <div class="row no-gutters">
                                        <div class="col-lg-12 col-sm-12">  
                                            <form enctype="multipart/form-data" method="post" action="../controller/updateProfileImg.php">
                                                <input type="file" id="updateCoverImg" name="updateCoverImg" accept="image/x-png,image/gif,image/jpeg">
                                                <label for="updateCoverImg">Change Image</label>  
                                            </form>            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </section>

                <main>
                    <div class="main-section">
                        <div class="container">
                            <div class="main-section-data">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="main-left-sidebar animated slideInLeft">
                                            <div class="user_profile" style="border-radius: 5px;">
                                                <div class="user-pro-img">
                                                    <img src="../assets/images/<?php if(isset($dataUser['photo_profile']) && $dataUser['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $dataUser['photo_profile'])) echo "user_photos/".$dataUser['photo_profile']; else if(strtoupper($dataUser['gender']) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php $dataUser['firstname'] + "'s Avatar" ?>" width="180px" height="180px">
                                                    <?php
                                                        if($_GET['u'] == $_SESSION['username']){
                                                            ?>
                                                            <form enctype="multipart/form-data" method="post" action="../controller/updateProfileImg.php">
                                                                <div class="add-dp">
                                                                    <input type="file" id="updateProfileImg" name="updateProfileImg" accept="image/x-png,image/gif,image/jpeg">
                                                                    <label for="updateProfileImg"><i class="fa fa-camera"></i></label>                                           
                                                                </div>
                                                            </form>
                                                        <?php
                                                        }
                                                    ?>
                                                            
                                                </div>
                                                <div class="user-pro_status">
                                                    <h2 class="mb-3 px-3"style="font-size: 22px;"><?php echo $dataUser['first_name'] . " " . $dataUser['last_name']; ?></h2>
                                                    <p class="px-3"><?php if($dataUser['description']) echo $dataUser['description']; else echo "Hi, I just used the <b>Say Helloo</b> application, nice to meet you."; ?></p>
                                                    <ul class="flw-hr mt-3">
                                                        <!-- <?php
                                                            if($_GET['u'] != $_SESSION['username']){
                                                                $status = getStatus($_SESSION['username'], $_GET['u']);
                                                                if(count($status) == 0) $status = getStatus($_GET['u'], $_SESSION['username']);
                                                                if(@$status[0][0] == "accepted"){
                                                                    echo
                                                                    '<br>
                                                                    <form method = "POST">
                                                                        <button type = "submit" name = "btnUnconnect" style = "border: none">
                                                                            <li>
                                                                                <a href = "" title class="flww">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Connected
                                                                                </a>
                                                                            </li>
                                                                        </button>
                                                                    </form>';
                                                                    unconnect($_SESSION['username'], $_GET['u']);
                                                                    unconnect($_GET['u'], $_SESSION['username']);
                                                                }
                                                                else if(@$status[0][0] == 'pending') {
                                                                    echo
                                                                    '<br>
                                                                    <li>
                                                                        <a href="" title class="flww">
                                                                            <i class="fa fa-plus"></i>
                                                                            Pending
                                                                        </a>
                                                                    </li>';
                                                                }
                                                                else{
                                                                    echo
                                                                    '<br>
                                                                    <form method = "POST">
                                                                        <li>
                                                                            <button type = "submit" name = "btnConnect" style = "border: none">
                                                                                <a href = "" title class="flww">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Connect
                                                                                </a>
                                                                            </button>
                                                                        </li>
                                                                    </form>';
                                                                    connect($_SESSION['username'], $_GET['u']);
                                                                }
                                                            }
                                                        ?> -->
                                                    </ul>
                                                    <ul class="user-fw-status">
                                                        <li>
                                                            <!-- <h4 class="mt-2">Connections</h4>
                                                            <span><?php echo $dataUser['connection']; ?></span> -->
                                                            <h4 class="mt-2">Join SayHello Since</h4>
                                                            <span><?php echo time_elapsed_string($dataUser['created_at']) ?></span>
                                                        </li>
                                                        <?php
                                                        if($_GET['u'] == $_SESSION['username']){
                                                            ?>
                                                            <li class="row m-0 justify-content-center">
                                                            <a href=" showProfile.php?username=<?php echo $_SESSION['username'];?>" class="text-primary" title="" style="text-decoration: none">My Account</a>
                                                        </li>
                                                        <li class="row m-0 justify-content-center">
                                                            <a href=" index.php" class="text-danger" title="" style="text-decoration: none">Back</a>
                                                        </li>
                                                        <?php
                                                        }
                                                    ?>  
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 order-3 order-lg-2">
                                        <div class="main-ws-sec">
                                            <div class="w3-row-padding">
                                                <div>
                                                    <div class="posts-section">
                                                        <?php
                                                            if($_GET['u'] == $_SESSION['username']){
                                                                ?>
                                                                <div class="w3-card w3-round w3-white mb-3 animated fadeInDown">
                                                                    <div class="w3-container w3-padding">
                                                                        <form method="POST" action="../controller/create_post_controller.php" enctype="multipart/form-data" >
                                                                            <h2 class="w3-opacity mt-3 mb-3" style="font-size: 24px"><b>Create Post</b></h2>
                                                                            <textarea name="content" class="form-control mb-3" placeholder="What's on your mind?"></textarea>
                                                                            <input type="file" name="images" accept="image/x-png,image/gif,image/jpeg" class="dropify form-control text-center"/>
                                                                            <p class="text-danger"><?php echo $messages; ?></p>
                                                                            <button type="submit" class="w3-button w3-theme mt-4 mb-2 float-right"><i class="fa fa-pencil"></i>  Post</button> 
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                        ?>
                                                                
                                                        <?php
                                                            if(!empty($postFData)){

                                                                foreach($postFData as $post){ ?>

                                                                    <div class="w3-container w3-card w3-white w3-round mb-3">
                                                                        <br>
                                                                        <img src="../assets/images/<?php if(isset($dataUser['photo_profile']) && $dataUser['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $dataUser['photo_profile'])) echo "user_photos/".$dataUser['photo_profile']; else if(strtoupper($dataUser['gender']) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php $dataUser['firstname'] + "'s Avatar" ?>" class="w3-left w3-circle w3-margin-right" width="60px" height="60px" style="object-fit: cover;">
                                                                        <span class="w3-right w3-opacity"><?php echo time_elapsed_string($post['created_at']); ?></span>
                                                                        <h4 class="mt-3"><?php echo getUserData($post['creator_username'])['first_name'] . " " . getUserData($post['creator_username'])['last_name']; ?></h4>
                                                                        <br>
                                                                        <p class="mt-2"><?php echo $post["content"] ?></p>
                                                                        <hr class="w3-clear">
                                                                        <?php 
                                                                            if($post["images"]){
                                                                        ?>
                                                                            <div class="w3-row-padding px-4" style="margin:0 -16px">
                                                                                <img src="../assets/images/user_photos/<?php echo $post["images"] ?>" style="width:100%" alt="<?php echo $post['creator_username']?>'s post " class="w3-margin-bottom">
                                                                            </div>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                        <form class="like_this_post">
                                                                            <input type="hidden" name="p" value="<?php echo $post['post_id'] ?>">
                                                                            <input type="hidden" name="l" value="<?php echo $post['total_likes'] ?>">
                                                                            <button type="submit" class="w3-button w3-theme-d1 w3-margin-bottom mt-2 ml-2"><i class="fa fa-thumbs-up h-100"></i> <span id="like<?php echo $post['post_id'] ?>"><?php if($post["total_likes"]) echo $post["total_likes"]; else echo 0; ?> </span></button> 

                                                                            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom mt-2 dcr-none" onclick="location.href='<?php echo 'moreChat.php?post_id=' . $post['post_id']; ?>'"><i class="fa fa-comment"></i>  <?php if($post["total_comments"]) echo $post["total_comments"]; else echo 0; ?></button> 
                                                                        </form>
                                                                        <?php echo '<a class="w3-button w3-theme-d2 w3-margin-bottom mt-2 float-right dcr-none" href="moreChat.php?post_id=' . $post['post_id'] . '"> Show More...</a>'; ?>
                                                                    </div>

                                                                    <?php
                                                                }
                                                            }else{
                                                                ?>
                                                                <div class="w3-container w3-card w3-white w3-round">
                                                                    <h2 class="text-center mt-4">There is no activity in your account.</h2>
                                                                    <h2 class="text-center mt-0 mb-4">Create a post to share your activities with others.</h2>
                                                                </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 order-2 animated slideInRight">
                                        <div>
                                            <div class="user-profile-ov">
                                                <h3 class="m-0" style="font-size: 30px">Profile Details</h3>
                                            </div>
                                            <div class="user-profile-ov st2">
                                                <h4>Full Name <a href="#" title=""></a></h4>
                                                <p><?php echo $dataUser['first_name'] . " " . $dataUser['last_name'] ?></p>
                                                <h4>Username <a href="#" title=""></a></h4>
                                                <p><?php echo $dataUser['username']; ?></p>
                                                <h4>Description <a href="#" title=""></a></h4>
                                                <p><?php if($dataUser['description']) echo $dataUser['description']; else echo "Hi, I just used the <b>Say Helloo</b> application, nice to meet you."; ?></p>
                                                <h4>Gender <a href="#" title=""></a></h4>
                                                <p><?php if($dataUser["gender"] == "F") echo "Female"; else echo "Male"; ?></p>
                                                <h4>Birth Date <a href="#" title=""></a></h4>
                                                <p><?php echo $dataUser['birth_date']; ?></p>
                                                <h4>Join on Say Helloo Apps Since <a href="#" title=""></a></h4>
                                                <p><?php echo time_elapsed_string($dataUser['created_at']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php    
            }else{ 
                ?>
                <div class="container my-5">
                    <div class="w3-card w3-round w3-white my-5">
                        <div class="w3-container w3-padding text-center">
                            <h2 class="w3-opacity my-5" style="font-size: 40px;"><b>Results not found for username "<?php echo $_GET['u']; ?>"</b></h2>
                        </div>
                    </div>
                </div>

            <?php
            }
        ?>

        <!-- Footer -->
        <?php
            include "footer.php";
        ?>
                
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../assets/js/dropify.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        // Accordion
        function myFunction(id) {
          var x = document.getElementById(id);
          if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
          } else { 
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className = 
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
          }
        }
        
    </script>
    <script>
        $(document).ready(function(){
            new WOW().init();

            $('.dropify').dropify();

            $('.like_this_post').on('submit', function (e) {

                e.preventDefault();

                $.ajax({
                    type: 'post',
                    url: '../controller/like_post_controller.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        if(JSON.parse(response.toLowerCase())['status']){
                            var resp = JSON.parse(response);
                            var temp_id = "#like" + resp['post_id'];
                            $(temp_id).text(resp['total_likes']);
                            // window.location.reload(true);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Successfully liked this post'
                            })
                        }else{
                            // alert("Already liked this post");
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'info',
                                title: 'Already liked this post'
                            })
                        }
                    }
                });

            });

        })
    </script>
    <script>
        $(document).ready(function(){
            formdata = new FormData();      
            jQuery("#updateProfileImg").on("change", function() {
                var file = this.files[0];
                if (formdata) {
                    formdata.append("image", file);
                    jQuery.ajax({
                        url: "../controller/updateImages.php",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success:function(){
                            location.reload();
                        }
                    });
                }                       
            }); 

            formdata2 = new FormData();      
            jQuery("#updateCoverImg").on("change", function() {
                var file = this.files[0];
                if (formdata2) {
                    formdata2.append("coverImg", file);
                    jQuery.ajax({
                        url: "../controller/updateImages.php",
                        type: "POST",
                        data: formdata2,
                        processData: false,
                        contentType: false,
                        success:function(){
                            location.reload();
                        }
                    });
                }                       
            }); 
        });
    </script>

    <!-- Alert Success Post -->
    <?php
        if(isset($_SESSION['success_post'])){
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
                        title: 'Post successfully created'
                    })
                });   
            </script>
    <?php
        unset($_SESSION['success_post']);
        }
    ?>


    <!-- Alert Failed Post -->
    <?php
        if(isset($_SESSION['failed_post'])){
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
                        title: 'Failed to post'
                    })
                });   
            </script>
    <?php
        unset($_SESSION['failed_post']);
        }
    ?>

</body>
</html>