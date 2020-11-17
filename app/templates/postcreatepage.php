<?php include 'inc/header.php'?>
    <div class="wrapper" style="margin: 0 auto;">
        <h2>Create Post</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($post_title_err)) ? 'has-error' : ''; ?>">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post_title; ?>">
                <span class="help-block"><?php echo $post_title_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea rows = "7" style="resize: none;" class="form-control" name = "desc" value="<?php echo $desc; ?>"></textarea>
                <span class="help-block"><?php echo $desc_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                <label>Contact(E-mail)</label>
                <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
                <span class="help-block"><?php echo $contact_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create">
                <a href="profile.php" class="btn">Cancel</a>
            </div>
        </form>
    </div>
<?php include 'inc/footer.php'?>