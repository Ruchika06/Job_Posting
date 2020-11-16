<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo SITE_TITLE;?></title>
        <meta name="description" content="Job listing site for IIT Mandi">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                <ul class="nav nav-pills float-right">
                <?php
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                        // If logged in.
                        if($title=="Profile") {
                            // If profile page.
                            echo '<li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                            </li>';
                        } else {
                            // If home page, view post page or create post page.
                            echo '<li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                    }                      
                    else{
                        if($title=="Login"){
                            // If login page.
                            echo '<li class="nav-item">
                            <a class="nav-link active" href="register.php">Signup<span class="sr-only">(current)</span></a>
                            </li>';
                        } 
                        else {
                            // If signup page.
                            echo '<li class="nav-item">
                            <a class="nav-link active" href="login.php">Login<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                    }
                    
                ?>
                </ul>
                </nav>
                <a href="index.php" style="text-decoration: none;"><h3 class="text-muted"><?php echo SITE_TITLE;?></h3></a>
            </div>
