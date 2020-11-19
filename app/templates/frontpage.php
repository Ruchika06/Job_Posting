<?php include 'inc/header.php'; ?>

<div class="jumbotron">
<p class="lead">Subscribe to our mailing list to get semi-weekly updates of new posts in your inbox.</p>
<p><a class="btn btn-lg btn-success" href="#" role="button">Subscribe</a></p>
</div>

<div class="marketing">
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row" method="post">
      <div class="col-md-10">
        <input type="text" class="form-control" name="search" value="<?php echo $search; ?>" placeholder="Search for jobs...">
        <span class="help-block"><?php echo $search_err; ?></span>
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
                <td><?php echo date("d/m", strtotime($post->created_at)); ?></td>
                <td><?php echo $post->username; ?></td>
                <td><a href="postview.php?id=<?php echo $post->id ?>">View</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'?>