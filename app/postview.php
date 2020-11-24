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

$post_obj = "";
if($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['id']))
	{
		$_SESSION['postid'] = $_GET['id'];
	}
}

$apply_status = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!isset($_SESSION['userid'])) {
		$apply_status = "You must be logged in to apply."; 
	} else {
        if(sizeof($post->checkIfApplied($_SESSION['userid'],$_SESSION['postid']))>=1) {
			$apply_status = "You have already applied for this post.";
		} else {
			if($post->applyForPost($_SESSION['userid'],$_SESSION['postid'])) {
				$apply_status = "OK";
			} else {
				$apply_status = "Some error ocurred.";
			}
		}
	}
}

$template = new Template('templates/applypage.php');
$template->title = "Apply";
$template->apply_status = $apply_status;
$template->post = $post->getPost($_SESSION['postid']);
$template->mail_subj = "Application: ".$template->post->title;
$template->mail_body = "Greetings,%0a<INSERT MSG HERE>%0aRegards,%0a".$_SESSION['username']."%0a";
echo $template;
?>
