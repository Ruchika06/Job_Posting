<?php include 'inc/header.php'; ?>

<div class="jumbotron">
<p class="lead">Subscribe to our mailing list to get semi-weekly updates of new posts in your inbox.</p>
<p><a class="btn btn-lg btn-success" href="#" role="button">Subscribe</a></p>
</div>

<div class="container">
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