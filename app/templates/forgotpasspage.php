<?php include 'inc/header.php'?>

<div class="wrapper" style="margin: 0 auto;">
        <h2>Trouble Logging In?</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>E-Mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send Login Link">
            </div>
            <p>Back to Login<a href="login.php">Click here</a>.</p>
        </form>
</div>    

<?php include 'inc/footer.php'?>