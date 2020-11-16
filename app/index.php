<?php include_once 'config/init.php';?>


<?php
// Initialize the session
session_start();

$post = new Post;
$template = new Template('templates/frontpage.php');
$template->title = "Jobs";
$template->posts = $post->getPosts();
echo $template;
?>
