<?php include_once 'config/init.php';?>


<?php
// Initialize the session
session_start();

// Check if logged in
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

// Make sure no postid is stored in session
unset($_SESSION['postid']);

$search=$search_err="";
$results="";

$post = new Post;
$user = new User;
$template = new Template('templates/frontpage.php');
$template->title = "Jobs";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['search'])) {
        $search = trim($_GET['search']);

        // Check if searchbox is empty
        if(empty($search)){
            $search_err = "Please enter a keyword.";
        }

        // Search
        if(empty($search_err)){
            $results = $post->searchPosts($search);
            if(sizeof($results)==0){                    
                $search_err = "No posts match the given keywords.";
            }
        }
    }
}

if($results=="" || sizeof($results)==0) {
    $template->posts = $post->getPosts();
} else {
    $template->posts = $results;
}

$template->search = $search;
$template->search_err = $search_err;
$template->is_subscribed = $user->isSubscribed($_SESSION['userid']);
echo $template;
?>

<!-- TODO: Make subscribe button functional, View posts by month -->