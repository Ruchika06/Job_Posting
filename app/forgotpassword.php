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
        $result = $user->getUserAllByEmail($email);
        $result = (array)$result;
        // foreach($result as $val){
        //     echo $val;
        // };
        // $email_ = array_column($result, 'email');
        // //echo $email_;
        // foreach($email_ as $val){
        //     echo $val;
        // };
        //echo sizeof($result);
        if(sizeof($result)>1){
            //$rows=mysqli_fetch_array($result);
            $pass  =  $result['password'];//FETCHING PASS
            //echo $pass;
            //echo "your pass is ::".($pass)."";
            $to = $result['email'];
            //echo "your email is ::".$email;
            //Details for send
            //ing E-mail
            $from = "Job Portal";
            $url = "Job Portal Website";
            $body  =  "Your Password Recovery
		    -----------------------------------------------
		    Url : $url;
		    email Details is : $to;
		    Here is your password  : $pass;
		    Sincerely,
		    Coding Cyber";
            $from = "sahilgarg2006.sg@gmail.com";
            $subject = "JobPortal Password recovered";
            $headers1 = "From: $from\n";
            $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers1 .= "X-Priority: 1\r\n";
            $headers1 .= "X-MSMail-Priority: High\r\n";
            $headers1 .= "X-Mailer: Just My Server\r\n";
            $sentmail = mail ( $to, $subject, $body, $headers1);
        }
        else {
            if ($_POST ['email'] != "") {
                echo '<span style="color: #ff0000;"> Not found your email in our database<br></span>';
            }
        }
        //If the message is sent successfully, display success message otherwise display an error message.
        if($sentmail==1)
        {
            echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
        }
        else
        {
            if($_POST['email']!="")
                echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
        }
    }
}


$template = new Template('templates/forgotpasspage.php');
$template->title = "Forgot Password";
$template->email = $email;
$template->email_err = $email_err;
echo $template;

?>