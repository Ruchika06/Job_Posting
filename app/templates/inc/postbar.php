<ul class="nav nav-pills">
	<?php 
		if($is_admin && !$is_approved) {
			echo "<li class='nav-item'> <form action='postview.php' class='col-md-6' method='post'><input type='submit' class='btn btn-primary' name='approve' value='Approve'></form> </li>";
		}
	?>
	<?php 
		if($post->user_id == $_SESSION['userid']) {
			echo "<li class='nav-item'> <form action='postedit.php' class='col-md-6' method='get'><input type='submit' class='btn btn-primary' value='Edit post'></form> </li>";
		}
	?>
	<li class='nav-item'>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class='col-md-6' method='post'>
		<input type='submit' class='btn btn-danger' name='hide' value='Delete post'>
	</form>
	</li>
</ul>
<br>