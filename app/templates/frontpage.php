<?php include 'inc/header.php'; ?>

<?php
if(!$is_subscribed) {
  require_once 'inc/subscribebutton.php';
}
?>

<div class="marketing">
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row" method="get">
      <div class="col-md-10">
        <input type="text" class="form-control" name="search" value="<?php echo $search; ?>" placeholder="Search for jobs... ( eg- 'web dev' , '10/2019' , 'Dr.' )">
        <span class="help-block text-danger"><?php echo $search_err; ?></span>
      </div>
      <div class="col-md-2"> 
        <input type="submit" class="btn btn-primary" value="Search">
      </div>
    </form>
  </div>
</div>

  <!-- All Job Posts that are available -->
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <th>Title</th>
            <th>Date</th>
            <th>Creator</th>
            <th>Details</th>
          </thead>
          <tbody>
            <?php foreach($posts as $post) { ?>
              <tr>
                <td><?php echo $post->title; ?></td>
                <td><?php echo date("d/m/y", strtotime($post->created_at)); ?></td>
                <td><?php echo $post->username; ?></td>
                <td><a href="postview.php?id=<?php echo $post->id ?>">View</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<?php include 'inc/footer.php'?>