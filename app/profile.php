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
$is_admin = $user->isAdmin($_SESSION['userid']);
$username = $user->getUsername($_SESSION['userid']);
$template = new Template('templates/profilepage.php');
$template->title = "Profile";
$template->username = $username;
$template->is_admin = $is_admin;
$template->is_subscribed = $user->isSubscribed($_SESSION['userid']);
$template->posts=$post->getPostsByUser($_SESSION['userid']);
if($is_admin) {
	$template->pendingposts = $post->getPendingPosts();
}
echo $template;
?>

<!-- TODO: Add stuff to be shown for admin -->