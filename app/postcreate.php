<?php include_once 'config/init.php'; ?>

<?php
// Initialize the session
session_start();

// Check if logged in
if(empty($_SESSION['userid'])) {
	header("Location: login.php");
	exit();
}

$post = new Post;
$user = new User;
$post_title = $desc = $contact = "";
$post_title_err = $desc_err = $contact_err = "";

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
        if($post->createPost($data)){
            $to = SELF_MAIL;
            $body  =  $desc;
            $mail_subj = "Application: ".$post_title;
            $mail_body = "Greetings,".PHP_EOL."<INSERT MSG HERE>".PHP_EOL."Regards,".PHP_EOL."Your name";
            $body .= PHP_EOL."<p><a href='mailto:".$contact."?subject=".$mail_subj."&body=".$mail_body."'>Click here</a> to send an application via mail.</p>";
            $from = "jobportal@iitmandi.ac.in";
            $subject = "Job Lister: ".$post_title;
            $subs = $user->getSubscribers();
            $headers = "BCC: ";
            foreach($subs as $sub) {
                $headers.=$sub->email.",";
            }
            $headers.=SELF_MAIL.";".PHP_EOL;
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

$template = new Template('templates/postcreatepage.php');
$template->title = "PostCreate";
$template->post_title = $post_title;
$template->post_title_err = $post_title_err;
$template->desc = $desc;
$template->desc_err = $desc_err;
$template->contact = $contact;
$template->contact_err = $contact_err;
echo $template;
?>
