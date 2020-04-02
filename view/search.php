<?php
    include "../controller/show_post_controller.php";
    include "../controller/create_post_controller.php";
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
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container w3-padding">
                                <h2 class="w3-opacity mt-3"><b>Search Result</b></h2>
                                <!-- <form method="POST" action="index.php" enctype="multipart/form-data" > -->
                                    <!-- <textarea name="content" class="form-control mb-3" placeholder="What's on your mind?"></textarea> -->
                                    <!-- <input type="file" name="images" accept="image/x-png,image/gif,image/jpeg" class="dropify form-control text-center"/> -->
                                    <!-- <p class="text-danger"><?php echo $messages; ?></p> -->
                                    <!-- <button type="submit" class="w3-button w3-theme mt-4 mb-2 float-right"><i class="fa fa-pencil"></i>  Post</button>  -->
                                <!-- </form> -->
                                <?php
                                    $i = 0;
                                    foreach($data as $row){
                                        echo '<p>' . $row[$i]['first_name'] . ' ' . $row[$i]['last_name'] . '</p>';
                                        $i++;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                        
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