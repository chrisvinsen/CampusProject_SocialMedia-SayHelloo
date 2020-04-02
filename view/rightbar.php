<!DOCTYPE html>
<html>
<head>
    <title>Say Helloo   </title>
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
    <link rel="stylesheet" href="../assets/css/styles.css">

    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
</head>
<body>
    <div class="w3-col m2">
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
                <img src="../assets/images/logo.png" alt="Forest" style="width:100%;">
                <p class="mb-4"><strong>Knowing is not enough; we must apply. Willing is not enough; we must do. </strong></p>
            </div>

        </div>
        <br>
        <?php
            include "../controller/connection.php";
            foreach(showRequest($_SESSION['username']) as $dataUser){
        ?>
            <div class="w3-card w3-round w3-white w3-center">
                <div class="w3-container">
                    <p class="mt-2">Friend Request</p>
                    <img class="mx-auto d-block" src="../assets/images/<?php if($dataUser[4]) echo "user_photos/".$dataUser[4]; else if(strtoupper($dataUser[3]) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " alt="<?php $dataUser[1] + "'s Avatar" ?>" style="width:50%;">
                    <span style="font-size: 2vw;"><?php echo $dataUser[1] . " " . $dataUser[2] ?></span>
                    <div class="w3-row w3-opacity">
                        <form method = "POST">
                            <div class="w3-half">
                                <button class="w3-button w3-block w3-green w3-section" title="Accept" type = "submit" name = "btnAccept"><i class="fa fa-check"></i></button>
                            </div>
                            <?php accept($dataUser[0]) ?>
                        </form>
                        <form method = "POST">
                            <div class="w3-half">
                                <button class="w3-button w3-block w3-red w3-section" title="Decline" type = "submit" name = "btnDecline"><i class="fa fa-remove"></i></button>
                            </div>
                            <?php decline($dataUser[0]) ?>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        <?php
            }
        ?>
    </div>
</body>
</html>