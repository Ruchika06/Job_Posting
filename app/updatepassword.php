<?php include_once 'config/init.php'; ?>

<?php
// Initialize the session
session_start();

$user = new User;

$username = $password = $newpassword = "";
$username_err = $password_err = $newpassword_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $newpassword = trim($_POST['newpassword']);

    // Check if username is empty
    if(empty($username)){
        $username_err = "Please enter username.";
    }
    
    // Check if password is empty
    if(empty($password)){
        $password_err = "Please enter your password/code.";
    }

    // Check if password is empty
    if(empty($newpassword)){
        $newpassword_err = "Please enter your new password.";
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err) && empty($newpassword_err)){
        
        $hashed_password = $user->getPasswordHashByUsername($username);
        
        if($hashed_password){                    
            if(password_verify($password, $hashed_password->password) || ($password == $hashed_password->password)){ 
                $data = array();
                $data['username'] = $username;
                $data['password'] = password_hash($newpassword, PASSWORD_DEFAULT);
                // Attempt to execute the prepared statement
                if($user->updateUserPassword($data)){
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            } else{
                $password_err = "The password or the code you entered was not valid.";
            }
        } else{
            $username_err = "No account found with that username.";
        }

    }
}

$template = new Template('templates/updatepasspage.php');
$template->title = "Login";
$template->username = $username;
$template->username_err = $username_err;
$template->password = $password;
$template->password_err = $password_err;
$template->newpassword = $newpassword;
$template->newpassword_err = $newpassword_err;
echo $template;
?>
