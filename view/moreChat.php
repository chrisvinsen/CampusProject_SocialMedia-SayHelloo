<?php
    include "../controller/show_post_controller.php";

    include "../controller/show_mini_profile_controller.php";
    include "../controller/suggestion_controller.php";

    if(!isset($_SESSION['username'])){
        echo("<script>location.href = '../view/login.php'</script>");
    }
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
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
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
            <div class="w3-col m7 animated fadeIn faster">
                <div class="w3-container w3-card w3-white w3-round w3-margin responsive-margin mt-0 pb-3">
                    <br>
                    <!-- Comments -->
                    <?php
                        include '../controller/comment.php';
                        $post_id = $_GET['post_id'];
                        $commenter = $_SESSION['username'];
                        $postData = array(
                            "where" => array(
                                "post_id" => $post_id
                            ),
                            "order_by" => "created_at DESC",
                            "return_type" => "single"
                        );
                        $postData = $db->getRows("post", $postData);
                        $dataUser = getUser($post_id);
                    ?>
                    <a href="profile.php?u=<?php echo $dataUser[0][1] ?>"><img class="w3-left w3-circle w3-margin-right" src="../assets/images/<?php if(isset($dataUser[0][10]) && $dataUser[0][10] != null && file_exists('../assets/images/user_photos/' . $dataUser[0][10])) echo "user_photos/".$dataUser[0][10]; else if($dataUser[0][0] == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?>" alt="<?php echo $first_name . " " . $last_name; ?>" width="60px" height="60px" style="object-fit: cover;"></a>
                    <span class="w3-right w3-opacity"><?php echo time_elapsed_string($postData['created_at']); ?></span>
                    <a href="profile.php?u=<?php echo $dataUser[0][1] ?>" style="text-decoration: none"><h4 class="mt-3"><?php echo $dataUser[0][7] . ' ' . $dataUser[0][8]; ?></h4></a>
                    <br>
                    <hr class="w3-clear">
                    <p class="mt-2"><?php echo $postData['content']; ?></p>
                    <?php 
                        if($postData["images"]){
                    ?>
                    <div class="w3-row-padding px-4" style="margin:0 -16px">
                        <img src="../assets/images/user_photos/<?php echo $postData['images'] ?>" style="object-fit: cover;" alt="Photo" class="w3-margin-bottom">
                    </div>
                    <?php
                        }
                    ?>
                    <form class="like_this_post">
                        <input type="hidden" name="p" value="<?php echo $postData['post_id'] ?>">
                        <input type="hidden" name="l" value="<?php echo $postData['total_likes'] ?>">
                        <button type="submit" class="w3-button w3-theme-d1 w3-margin-bottom mt-2 ml-2"><i class="fa fa-thumbs-up h-100"></i> <span id="like<?php echo $postData['post_id'] ?>"><?php if($postData["total_likes"]) echo $postData["total_likes"]; else echo 0; ?> </span></button> 
                        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom mt-2 dcr-none"><i class="fa fa-comment"></i>  <?php if($postData["total_comments"]) echo $postData["total_comments"]; else echo 0; ?></button> 
                    </form>

                    <div class="panel panel-default post py-3">
                    <div class="panel-body">
                    <?php
                        foreach(showComments($post_id) as $data){
                    ?>
                    <div class="row">
                        <div class="col-lg-1-5 col-md-2 col-sm-3 col-3" style="padding-bottom: 5px !important">
                            <a href="profile.php?u=<?php echo $data[2]?>" class="post-avatar thumbnail verticalhorizontal w-100 dcr-none">
                                <img src="../assets/images/<?php if(isset($data[7]) && $data[7] != null && file_exists('../assets/images/user_photos/' . $data[7])) echo "user_photos/".$data[7]; else if(strtoupper($data[8]) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php $data[9] + "'s Avatar" ?>" width="50px" height="50px" class="rounded-circle" style="object-fit: cover;">
                                <div class="text-center vw1"><small><?php echo $data[2]; ?></small></div>
                            </a>
                        </div>
                        <div class="col-lg-10-5 col-md-10 col-sm-9 col-9" style="padding-bottom: 5px !important">
                            <div class="bubble w-100">
                                <div class="pointer">
                                    <p class="m-0"><?php echo $data[3]; ?></p>
                                </div>
                                <div class="pointer-border"></div>
                            </div>
                        </div>
                    </div>
                    <?php                                
                        }
                    ?>

                    <!-- Add New Comments -->
                    <div class="row">
                        <div class="col-12">
                            <div class="comment-form">
                                <form class="form-inline row" method="POST">
                                    <?php echo '<input type = "hidden" name = "commenter" value = "' . $commenter . '">' ?>
                                    <div class="form-group col-lg-10 col-md-9 col-8 pr-0">
                                        <input type="text" class="form-control" placeholder="Enter comment" name = "comment">
                                    </div>
                                    <div class="form-group col-lg-2 col-md-3 col-4">
                                        <button type="submit" class="btn btn-primary w-100" name = "btnComment">Add</button>
                                    </div>
                                </form>
                                <?php addComment($post_id); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            

            <!-- Right bar -->
        <div class="animated fadeIn">
            <?php
                include "rightbar.php"
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

        })
    </script>

</body>
</html>