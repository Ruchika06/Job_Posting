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

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if username is empty
    if(empty($username)){
        $username_err = "Please enter username.";
    }
    
    // Check if password is empty
    if(empty($password)){
        $password_err = "Please enter your password.";
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        
        $hashed_password = $user->getPasswordHashByUsername($username);
        
        if($hashed_password){                    
            if(password_verify($password, $hashed_password->password)){ 
                session_start();       
                // Store data in session variables
                $userid=$user->getUserByUsername($username)->id;
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;   
                $_SESSION["userid"]=$userid;                
                // Redirect user to welcome page
                header("location: index.php");
            } else{
                $password_err = "The password you entered was not valid.";
            }
        } else{
            $username_err = "No account found with that username.";
        }

    }
}

$template = new Template('templates/loginpage.php');
$template->title = "Login";
$template->username = $username;
$template->username_err = $username_err;
$template->password = $password;
$template->password_err = $password_err;
echo $template;
?>
