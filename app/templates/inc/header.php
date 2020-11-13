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
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        echo '<li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                        </li>';                    
                    } else {
                        if($title=="Login"){
                            echo '<li class="nav-item">
                            <a class="nav-link active" href="register.php">Signup<span class="sr-only">(current)</span></a>
                            </li>';
                        } else {
                            echo '<li class="nav-item">
                            <a class="nav-link active" href="login.php">Login<span class="sr-only">(current)</span></a>
                            </li>';
                        }
                    }
                ?>
                </ul>
                </nav>
                <h3 class="text-muted"><?php echo SITE_TITLE;?></h3>
            </div>
