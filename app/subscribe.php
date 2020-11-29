<?php include_once 'config/init.php'; ?>

<?php

// Initialize the session
session_start();

// Check if logged in
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

$user = new User;
if($user->subscribe($_SESSION['userid'])) {
    header("location: index.php");
    exit();
} else {
    echo "Something went wrong. Please try again later.";
}
?>