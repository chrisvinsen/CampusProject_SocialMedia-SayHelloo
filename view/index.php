<?php
    include "../controller/show_post_controller.php";
    include "../controller/create_post_controller.php";

    include "../controller/show_mini_profile_controller.php";
    include "../controller/suggestion_controller.php";

    if(empty(isset($_SESSION['status']))){
        echo("<script>location.href = '../view/login.php'</script>");
    };
    $_SESSION['created'] = "index";
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
    <div class="w3-top">
        <!-- Header -->
        <?php
            include "header.php";
        ?>
    </div>

    <div class="w3-container w3-content" id="main_content" style="max-width:1400px;margin-top:80px">
        <div class="w3-row">
            <div class="w3-col m3 animated slideInLeft">
                <!-- Left bar -->
                <?php
                    include "leftbar.php";
                ?>
            </div>
            <div class="w3-col m7">
                <div class="w3-row-padding ">
                    <div class="w3-col m12 animated fadeInDown">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <form method="POST" action="index.php" enctype="multipart/form-data" >
                                    <h2 class="w3-opacity mt-3"><b>Create Post</b></h2>
                                    <textarea name="content" class="form-control mb-3" placeholder="What's on your mind?"></textarea>
                                    <input type="file" name="images" accept="image/x-png,image/gif,image/jpeg" class="dropify form-control text-center"/>
                                    <p class="text-danger"><?php echo $messages; ?></p>
                                    <button type="submit" class="w3-button w3-theme mt-4 mb-2 float-right"><i class="fa fa-pencil"></i>  Post</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if(!empty($postData)){

                        foreach($postData as $post){ ?>

                            <div class="w3-container w3-card w3-white w3-round w3-margin">
                                <br>
                                <?php 
                                    $profile_img = getUserData($post['creator_username'])['photo_profile'];
                                    $gender = getUserData($post['creator_username'])['gender'];
                                ?>
                                <a href="profile.php?u=<?php echo $post[1];?>"><img src="../assets/images/<?php if(isset($profile_img) && $profile_img != null && file_exists('../assets/images/user_photos/' . $profile_img)) echo "user_photos/" . $profile_img; else if(strtoupper($gender) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php echo getUserData($post['creator_username'])['first_name']  + "'s Avatar" ?>" class="w3-left w3-circle w3-margin-right" width="60px" height="60px" style="object-fit: cover;"></a>
                                <span class="w3-right w3-opacity"><?php echo time_elapsed_string($post['created_at']); ?></span>
                                <a href="profile.php?u=<?php echo $post[1];?>" class="text-primary" title="" style="text-decoration: none"><h4 class="mt-3" style="text-transform: capitalize; "><?php echo getUserData($post['creator_username'])['first_name'] . " " . getUserData($post['creator_username'])['last_name']; ?></h4></a>
                                <br>
                                <p class="mt-2"><?php echo $post["content"] ?></p>
                                <hr class="w3-clear">
                                <?php 
                                    if($post["images"]){
                                ?>
                                    <div class="w3-row-padding px-4" style="margin:0 -16px">
                                        <img src="../assets/images/user_photos/<?php echo $post["images"] ?>" style="width:100%" alt="Photo" class="w3-margin-bottom">
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
                        <div class="w3-container w3-card w3-white w3-round w3-margin">
                            <h4 class="text-center">There is no activity in your account.</h4>
                            <h4 class="text-center mt-0 mb-3">Create a post to share your activities with others.</h4>
                        </div>
                        <?php
                    }
                ?>
                        
            </div>
            

            <!-- Right bar -->
            <div class="animated fadeIn">
                <?php
                    include "rightbar.php";
                ?>
            </div>
        </div>
    </div>
    <br>
    <!-- Footer -->
    <?php
        include "footer.php";
    ?>

    <script src="../assets/js/dropify.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
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
            new WOW().init();
        })
    </script>

    <!-- Alert Login Sucessful -->
    <?php
        if(isset($_SESSION['success_login'])){
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
                        title: 'Login Successful'
                    })
                });   
            </script>
    <?php
        unset($_SESSION['success_login']);
        }
    ?>

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