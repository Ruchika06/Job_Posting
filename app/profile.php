<?php include_once 'config/init.php';?>

<?php
// Initialize the session
session_start();
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}
$post = new Post;
$user = new User;
$template = new Template('templates/profilepage.php');
$template->title = "Profile";


echo $template;
?>
