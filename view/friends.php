<?php
    include "../controller/show_friends_data_controller.php";

    include "../controller/show_mini_profile_controller.php";
    include "../controller/suggestion_controller.php";
?>

<?php 
    if(!isset($_SESSION['status'])){
        // header("location: login.php");
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
            <div class="w3-col m3">
                <!-- Left bar -->
                <?php
                    include "leftbar.php";
                ?>
            </div>
            <div class="w3-col m7">
                <?php
                    if(!empty($postFData)){

                        foreach($postFData as $post){ ?>

                            <div class="w3-container w3-card w3-white w3-round w3-margin">
                                <br>
                                <img src="../assets/images/<?php if($dataUser['photo_profile']) echo "user_photos/".$dataUser['photo_profile']; else if(strtoupper($dataUser['gender']) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php $dataUser['firstname'] + "'s Avatar" ?>" class="w3-left w3-circle w3-margin-right" style="width:60px">
                                <span class="w3-right w3-opacity"><?php echo time_elapsed_string($post['created_at']); ?></span>
                                <h4 class="mt-3"><?php echo getUserData($post['creator_username'])['first_name'] . " " . getUserData($post['creator_username'])['last_name']; ?></h4>
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
                                    <button type="submit" class="w3-button w3-theme-d1 w3-margin-bottom mt-2"><i class="fa fa-thumbs-up h-100"></i>  <?php echo $post["total_likes"] ?></button> 
                                    <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom mt-2 dcr-none" onclick="location.href='<?php echo 'moreChat.php?post_id=' . $post['post_id'] ?>'"><i class="fa fa-comment"></i>  <?php echo $post["total_comments"] ?></button> 
                                </form>
                                <a class="w3-button w3-theme-d2 w3-margin-bottom mt-2 float-right dcr-none" href="moreChat.php?post_id=<?php echo $post['post_id'] ?>"> Show More...</a>
                                
                            </div>

                            <?php
                        }
                    }else{
                        ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin">
                            <h4 class="text-center">There is no activity in this account.</h4>
                        </div>
                        <?php
                    }
                ?>
                        
            </div>
            

            <!-- Right bar -->
            <?php
                include "rightbar.php";
            ?>
        </div>
    </div>
    <br>
    <!-- Footer -->
    <?php
        include "footer.php";
    ?>


    <script src="../assets/js/dropify.min.js"></script>
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
                        if(JSON.parse(response.toLowerCase())){
                            window.location.reload(true);
                        }
                    }
                });

            });

            // setInterval(function()
            // { 
            //     $.ajax({
            //         type:"post",
            //         url:"../controller/show_post_controller.php",
            //         success:function(data)
            //         {
            //             console.log("OK");
            //         }
            //     });
            // }, 10000); 
        })
    </script>

</body>
</html>