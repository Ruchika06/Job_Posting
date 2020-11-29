<?php include_once 'config/init.php'; ?>

<?php
// Initialize the session
session_start();

// Check if logged in
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

// Check is postid is a session var
if(empty($_SESSION['postid'])) {
	header("Location: index.php");
	exit();
}

$post = new Post;
$post_title = $desc = $contact = "";
$post_title_err = $desc_err = $contact_err = "";

// Opening post edit form
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $postdata = $post->getPost($_SESSION['postid']);
    $post_title = $postdata->title;
    $desc = $postdata->description;
    $contact =  $postdata->contact;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $post_title = trim($_POST['title']);
    $desc = trim($_POST['desc']);
    $contact = trim($_POST['contact']); 

    // Check if title is empty
    if(empty($post_title)){
        $post_title_err = "Please enter a title.";
    }
    
    // Check if desc is empty
    if(empty($desc)){
        $desc_err = "Please enter a job description.";
    }
    
    // Check if desc is empty
    if(empty($contact)){
        $contact_err = "Please enter contact details.";
    }

    // Check input errors before inserting in database
    if(empty($post_title_err) && empty($desc_err) && empty($contact_err)){ 
        
        $data = array();
        $data['user_id'] = $_SESSION['userid'];
        $data['title'] = $post_title;
        $data['description'] = $desc;
        $data['contact'] = $contact;
        
        // Attempt to execute the prepared statement
        if($post->updatePost($_SESSION['postid'],$data)){
            $to = SELF_MAIL;
            $subject = "Edit Approval: ".$post_title;
            $body = DOMAIN."postview.php?=".$_SESSION['postid'];
            $headers = "";
            $headers .= "MIME-Version: 1.0".PHP_EOL;
            $headers .= "Content-Type: text/html; charset=ISO-8859-1".PHP_EOL;
            $sentmail = mail ( $to, $subject, $body, $headers);

            header("location: profile.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }

}

$template = new Template('templates/posteditpage.php');
$template->title = "PostCreate";
$template->post_title = $post_title;
$template->post_title_err = $post_title_err;
$template->desc = $desc;
$template->desc_err = $desc_err;
$template->contact = $contact;
$template->contact_err = $contact_err;
echo $template;
?>
