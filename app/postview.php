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
$user = new User;
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
	if(isset($_POST['approve'])) {
		if($post->approvePost($_SESSION['postid'])) {
			header("Location: profile.php");
			exit();
		} else {
			echo "Something went wrong. Please try again later.";
		}
	}
	if(isset($_POST['hide'])) {
		if($post->hidePost($_SESSION['postid'])) {
			header("Location: profile.php");
			exit();
		} else {
			echo "Something went wrong. Please try again later.";
		}
	}
	if(isset($_POST['comment'])) {
		if(!isset($_SESSION['userid'])) {
			$comment_err = "You must be logged in to comment."; 
		} else {
				if($comment->createComment($_SESSION['userid'],$_SESSION['postid'],$_POST['comm_message'])) {
					// Reload page
					header("location: postview.php?id=".$_SESSION['postid']);
				} else {
					$comment_err = "Some error ocurred.";
				}
		}
	}
	else if(isset($_POST['commdelete'])) {
		if($comment->deleteComment($_POST['comm_id'])) {
			header("Location: postview.php?id=".$_SESSION['postid']);
			exit();
		} else {
			echo "Something went wrong. Please try again later.";
		}	
	}
}

$template = new Template('templates/postviewpage.php');
$template->title = "View";
$template->is_admin = $user->isAdmin($_SESSION['userid']);
$template->is_approved = $post->isApproved($_SESSION['postid']);
$template->post = $post->getPost($_SESSION['postid']);
$template->comment_err = $comment_err;
$template->comments = $comment->getCommentsByPost($_SESSION['postid']);
$template->mail_subj = "Application: ".$template->post->title;
$template->mail_body = "Greetings,%0a<INSERT MSG HERE>%0aRegards,%0a".$_SESSION['username']."%0a";
echo $template;
?>

<!-- TODO: Format HTML for comments and buttons dashboard -->