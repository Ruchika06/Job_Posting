<?php include_once 'config/init.php'; ?>

<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}


$user = new User;

$file = 'updatepassword.php';
$msg = "";
$email = $username = "";
$username_err = $email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST['email']);
    //$username = trim($_POST['username']);
    //echo $email;
    // Validate email
    if(empty($email)){
        $email_err = "Please enter an E-mail address.";
    } else{
        $sentmail=0;
        $result = $user->getPasswordHashByEmail($email);
        $url = DOMAIN."updatepassword.php";
        if($result){
            $code  =  $result->password;
            $to = $email;
            $body  =  
"
Password Recovery
-----------------
Here is your secret code : $code
Use it here: $url

Sincerely,
Admin
";
            $from = "jobportal@iitmandi.ac.in";
            $subject = "Job Lister - IIT Mandi Password Recovery";
            $headers = "From: $from\n";
            $sentmail = mail ( $to, $subject, $body, $headers);
        }
        else {
            if ($_POST ['email'] != "") {
                $msg = '<span style="color: #ff0000;"> Not found your email in our database<br></span>';
            }
        }
        //If the message is sent successfully, display success message otherwise display an error message.
        if($sentmail==1)
        {
            $msg = "<span>Your Password Hash Has Been Sent To Your Email Address.</span>";
        }
        else
        {
            if($_POST['email']!="")
                $msg = "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
        }
    }
}


$template = new Template('templates/forgotpasspage.php');
$template->title = "Forgot Password";
$template->email = $email;
$template->email_err = $email_err;
$template->msg = $msg;
echo $template;

?>
