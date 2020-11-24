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

$email = $username = $password = $confirm_password = "";
$email_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate email
    if(empty($email)){
        $email_err = "Please enter an E-mail address.";
    } else{
        if(sizeof($user->getUserByEmail($email))>=1){
            $email_err = "This E-mail is already registered.";
        }
    }

    // Validate username
    if(empty($username)){
        $username_err = "Please enter a username.";
    } else{
        if($user->getUserByUsername($username)){
            $username_err = "This username is already taken.";
        }
    }

    // Validate password
    if(empty($password)){
        $password_err = "Please enter a password.";     
    } else {
        if(strlen($password) < 8){
            $password_err = "Password must have atleast 8 characters.";
        }
    }
    
    // Validate confirm password
    if(empty($confirm_password)){
        $confirm_password_err = "Please confirm password.";     
    } else{
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){ 
        
        $data = array();
        $data['email'] = $email;
        $data['username'] = $username;
        $data['password'] = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        
        // Attempt to execute the prepared statement
        if($user->createUser($data)){
            header("location: login.php");
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
}

$template = new Template('templates/registerpage.php');
$template->title = "Register";
$template->email = $email;
$template->email_err = $email_err;
$template->username = $username;
$template->username_err = $username_err;
$template->password = $password;
$template->password_err = $password_err;
$template->confirm_password = $confirm_password;
$template->confirm_password_err = $confirm_password_err;
echo $template;
?>
