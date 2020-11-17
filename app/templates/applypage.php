<?php include_once 'inc/header.php'; ?>
<div class="col-md-12">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
        	<div class="mb-3">
				<h3><?php echo $post->title; ?></h3>
				<div class="text-muted">
					Posted by: <?php echo $post->creator; ?>
					<div style="float:right;"><?php echo strftime("%d/%m/%Y",strtotime($post->created_at)); ?></div>
				</div>
			</div>
			<div class="mb-3">
        	<p class="card-text"><?php echo nl2br($post->description); ?></p>
			</div>
			<?php
				if($apply_status=="OK") {
					echo "<p>Thank you for applying. Click <a href='mailto:".$post->contact."?subject=".$mail_subj."&body=".$mail_body."'>here</a> to send your application via mail.</p>";
				} else {
					echo "<p>".$apply_status."</p>";
				}
			?>
			<form action="postview.php" method="POST">
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="apply" value="Apply" class="btn btn-default">
					<a href="index.php" class="btn">Back</a>
				</div>
			</form>
		</div>
      </div>	
</div>
<?php include 'inc/footer.php'?>
