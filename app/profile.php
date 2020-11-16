<?php include_once 'config/init.php';?>

<?php
// Initialize the session
session_start();

if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

$post = new Post;
$template = new Template('templates/profilepage.php');
$template->title = "Profile";
$template->posts=$post->getPostsByUser($_SESSION['userid']);
echo $template;
?>
