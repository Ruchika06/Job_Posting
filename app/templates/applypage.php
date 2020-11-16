<?php 


if(isset($_POST['apply']))
{
if(!isset($_SESSION['userid'])) {
	echo '<script>alert("You must be logged in to apply")</script>'; 
	
}
else
{
	
	if(sizeof($db->checkpost($_SESSION['userid'],$post->id))>=1)
	{
		echo '<script>alert("You have already applied for the job")</script>'; 
	}
	else
	{
		try {
	if($db->applypost($_SESSION['userid'],$post->id))
	{
		echo 'Successfully applied';
		header("Location: index.php");
	}
} catch (PDOException $e) {
	echo $e->getMessage();
	
}
	
	}
}
}


?>

<?php include_once 'inc/header.php'; ?>
<div class="container center grey-text">
		
			<h4><?php echo $post->title; ?></h4>
			<p>Created by <?php echo $post->user_id; ?></p>
			<p><?php echo strftime("%d/%m/%Y",strtotime($post->created_at)); ?></p>
			<h5>Description:</h5>
			<p><?php echo $post->description; ?></p>

			<!-- APPlY FORM -->
			<form action="postview.php" method="POST">
				
				<input type="submit" name="apply" value="Apply" class="btn btn-default">
			</form>

		
	</div>

<?php include 'inc/footer.php'?>