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

<div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0"><?php echo $post->title; ?></h3>
          <div class="mb-1 text-muted"><?php echo strftime("%d/%m/%Y",strtotime($post->created_at)); ?></div>
          <p class="card-text mb-auto"><?php echo $post->description; ?><br>Contact: <?php echo $post->contact; ?></p>
          
        </div>
        <!-- APPlY FORM -->
			<form action="postview.php" method="POST">
				
				<input type="submit" name="apply" value="Apply" class="btn btn-default">
			</form>

        
      </div>	

<?php include 'inc/footer.php'?>
