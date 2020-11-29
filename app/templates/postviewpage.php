<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/postbar.php'; ?>
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
			<div class="">
        		<p class="card-text"><?php echo nl2br($post->description); ?></p>
				<?php echo "<p><a href='mailto:".$post->contact."?subject=".$mail_subj."&body=".$mail_body."'>Click here</a> to send an application via mail.</p>" ?>
			</div>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<td>Comments</td>
				</thead>
				<tbody>
					<?php foreach($comments as $comment) { ?>
						<tr>
							<td><?php echo $comment->username; ?></td>
							<td><?php echo strftime("%d %b %H:%M",strtotime($comment->created_at)); ?></td>
							<td><?php echo $comment->message; ?></td>
							<?php if($is_admin || $post->user_id == $_SESSION['userid']) echo "<td><form action='postview.php' method='post'><input type='hidden' name='comm_id' value=".$comment->id."><input type='submit' class='btn' name='commdelete' value='Delete'></form></td>"?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="mu-2 mb-4">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row" method="post">
		<div class="col-md-9">
			<input type="text" name="comm_message" class="form-control" placeholder="Post a comment...">
			<span class="help-block"><?php echo $comment_err; ?></span>
		</div>
		<div class="col-md-2">
			<input type="submit" class="btn btn-primary" name="comment" value="Post comment">
		</div>
	</form>
</div>
<?php include 'inc/footer.php'?>
