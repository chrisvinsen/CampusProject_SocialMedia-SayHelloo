<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Say Helloo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SayHelloo with your friends">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
        html, body {
          height: 100%;
          margin: 0;
          line-height: 27px;
        }

        .full-height {
          height: 100%;
        }
    </style>
</head>
<body>
    <header class="fixed-top">
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="index.php" title=""><img src="../assets/images/logo_say_hello3.png" alt="SayHelloo" ></a>
                </div>
                <div class="search-bar">
                    <form method="get" action="profile.php">
                        <input type="text" id="search_friends" name="u" placeholder="Search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <nav>
                    <ul class="m-0">
                        <li>
                            <a href="index.php" title="" class="text-light" style="text-decoration: none;">
                                <span><img src="../assets/images/icon1.png" alt=""></span>Home
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- <div class="menu-btn">
                    <a href="#" title=""><i class="fa fa-bars"></i></a>
                </div> -->
                <div class="user-account">
                    <div class="user-info">
                        <a href="profile.php?u=<?php echo $_SESSION['username'];?>" class="mt-0" style="text-decoration: none;">
                            <img src="../assets/images/<?php if(isset($miniProfile['photo_profile']) && $miniProfile['photo_profile'] != null && file_exists('../assets/images/user_photos/' . $miniProfile['photo_profile'])) echo "user_photos/".$miniProfile['photo_profile']; else if($miniProfile['gender'] == "F") echo "avatar_female.png"; else echo "avatar_male.png"; ?>" width="30px" height="30px">
                            <span class="text-light m-0" style="text-decoration: none; text-transform: capitalize;"><?php echo $_SESSION['username']; ?></span>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </header>  
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
     
    <script>
        $(document).ready(function(){
            $("#search_friends").autocomplete({
                source: "../controller/search_friends.php",
                minLength: 1,
                maxResults: 10
            });
        })
    </script>
</body>
</html>