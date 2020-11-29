<?php include 'inc/header.php'?>
    <div class="wrapper" style="margin: 0 auto;">
        <h2>Update Your Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <?php
                    // Check if logged in
                    if(empty($_SESSION['userid'])) {
                        echo "<label>Secret code</label>";
                    } else {
                        echo "<label>Current Password</label>";
                    }
                ?>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($newpassword_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="newpassword" class="form-control">
                <span class="help-block"><?php echo $newpassword_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>    
<?php include 'inc/footer.php'?>