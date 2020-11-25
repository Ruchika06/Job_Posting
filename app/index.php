<?php include_once 'config/init.php';?>


<?php
// Initialize the session
session_start();

// Check if logged in
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

$search=$search_err="";
$results="";

$post = new Post;
$template = new Template('templates/frontpage.php');
$template->title = "Jobs";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $search = trim($_POST['search']);

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

if($results=="" || sizeof($results)==0) {
    $template->posts = $post->getPosts();
} else {
    $template->posts = $results;
}

$template->search = $search;
$template->search_err = $search_err;
#echo "Hello";
echo $template;
?>
