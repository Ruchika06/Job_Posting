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
<!-- Comment box section to post comment -->
<!-- <div>
<form action="postview.php" method="post">
<div>
<textarea name="comments" id="comments" style="font-family:sans-serif;font-size:1.2em;" placeholder="Post your comments here...">
</textarea>
</div>
<input type="submit" value="Submit">
</form>
</div> -->

<!-- begin wwww.htmlcommentbox.com -->
 <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Widget</a> is loading comments...</div>
 <link rel="stylesheet" type="text/css" href="https://www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
 <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="https://www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&mod=%241%24wq1rdBcg%24fd1HH%2FXB6Re9RnYkU9ZTG."+"&opts=16862&num=10&ts=1606148282892");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
<!-- end www.htmlcommentbox.com -->

<?php include 'inc/footer.php'?>
