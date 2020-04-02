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
    <style rel="stylesheet" href="../assets/css/styles.css"></style>
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
</head>
<body>
    <div class="main-left-sidebar no-margin">
        <div class="user-data full-width" style="border-radius: 5px; overflow: hidden;">
            <div class="user-profile">
                <a href="profile.php?u=<?php echo $_SESSION['username'];?>">
                    <div class="username-dt w-100 h-100" <?php if(isset($miniProfile['cover_image']) && $miniProfile['cover_image'] != null && file_exists('../assets/images/user_photos/' . $miniProfile['cover_image']) ) { echo "style='background-image: url(../assets/images/user_photos/"; echo $miniProfile['cover_image'] . ") !important '" ;  } else { echo "style='background-image: url(../assets/images/cover.png" . ") !important'" ; }  ?>>
                        <div class="usr-pic profile-post">
                            <img class="w-100 h-100" src="../assets/images/<?php if(isset($miniProfile['photo_profile']) && $miniProfile['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $miniProfile['photo_profile'])) echo "user_photos/".$miniProfile['photo_profile']; else if($miniProfile['gender'] == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?>" alt="<?php echo $miniProfile['first_name'] . " " . $miniProfile['last_name']; ?>" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="user-specs px-4">
                        <h3><?php echo $miniProfile['first_name'] . " " . $miniProfile['last_name']; ?></h3>
                        <span><?php if($miniProfile['description']) echo $miniProfile['description']; else echo "Hi, I just used the <b>Say Helloo</b> application, nice to meet you."; ?></span>
                    </div>
                </a>
            </div>
            <ul class="user-fw-status">
                <li>
                    <h4 class="mt-2">Join SayHello Since</h4>
                    <span><?php echo time_elapsed_string($Profile['created_at']) ?></span>
                </li>
                <li class="row m-0 justify-content-center">
                    <a href="profile.php?u=<?php echo $_SESSION['username'];?>" class="text-primary" title="" style="text-decoration: none">View Profile</a>
                </li>
            </ul>
        </div>
        <div class="full-width" style="border-radius: 5px; overflow: hidden;">
            <li class="row m-3 justify-content-center">
                <a href="../view/logout.php" class="text-danger font-weight-bold" title="" style="text-decoration: none"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
        </div>
        <div class="suggestions full-width" style="border-radius: 5px; overflow: hidden;">
            <div class="sd-title">
                <h3>Suggestions</h3>
                <i class="la la-ellipsis-v"></i>
            </div>
            <div class="suggestions-list">
                <?php
                    if(!empty($Users)){
                        foreach($Users as $user){
                ?>
                            <div class="suggestion-usd">
                                <a href="profile.php?u=<?php echo $user['username'] ?>"><img src="../assets/images/<?php if(isset($user['photo_profile']) && $user['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $user['photo_profile'])) echo "user_photos/".$user['photo_profile']; else if(strtoupper($user['gender']) == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?> " width="35px" height="35px">
                                <div class="sgt-text" style="text-transform: capitalize;">
                                    <h4 class="m-0"><?php echo $user['first_name'] . " " . $user['last_name'] ?></h4>
                                    <span class="m-0"><?php echo $user['username'] ?></span>
                                </div></a>
                                <span><a href="profile.php?u=<?php echo $user['username'] ?>"><i class="fa fa-eye"></i></a></span>
                            </div>
                <?php
                        }
                    }else{
                ?>  
                    <div class="suggestion-usd my-0 py-0">
                        <p>There is no Suggestion for you</p>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>