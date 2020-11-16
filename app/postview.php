<?php include_once 'config/init.php';?>
<?php
// Initialize the session
session_start();
$db = new Post;
if(isset($_GET['id']))
{

$_SESSION['post_id']=$_GET['id'];
}

$post=$db->getPost($_SESSION['post_id']);

		
$template = new Template('templates/applypage.php');
$template->title = "Apply";
$template->post=$post;
$template->db=$db;


echo $template;
?>
