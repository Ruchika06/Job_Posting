<?php include_once 'config/init.php';?>

<?php
// Initialize the session
session_start();

// Check if user is logged in
// If not direct him to login page
//Makes the job inaccessible to outsiders 
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

$post = new Post;
$comment = new Comment;

$post_obj = "";
if($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['id']))
	{
		$_SESSION['postid'] = $_GET['id'];
	}
}

$comment_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!isset($_SESSION['userid'])) {
		$comment_err = "You must be logged in to comment."; 
	} else {
			if($comment->createComment($_SESSION['userid'],$_SESSION['postid'],$_POST['comment'])) {
				// Reload page
				header("location: postview.php?id=".$_SESSION['postid']);
			} else {
				$comment_err = "Some error ocurred.";
			}
	}
}

$template = new Template('templates/postviewpage.php');
$template->title = "View";
$template->post = $post->getPost($_SESSION['postid']);
$template->comment_err = $comment_err;
$template->comments = $comment->getCommentsByPost($_SESSION['postid']);
$template->mail_subj = "Application: ".$template->post->title;
$template->mail_body = "Greetings,%0a<INSERT MSG HERE>%0aRegards,%0a".$_SESSION['username']."%0a";
echo $template;
?>
