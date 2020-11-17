<?php include 'inc/header.php'; ?>
    
<div class="jumbotron">
<p class="lead">Create a post today!</p>
<p><a class="btn btn-lg btn-success" href="postcreate.php" role="button">Create</a></p>
</div>

<div class="container">
  <!-- All Job Posts created by the user -->
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <h2 class="text-center">Jobs Created</h2>
        <table class="table table-striped">
          <thead>
            <th>Title</th>
            <th>Date</th>
            <th>Details</th>
          </thead>
          <tbody>
            <?php foreach($posts as $post) { ?>
                  <tr>
                    <td><?php echo $post->title; ?></td>
                    <td><?php echo date("d/m/y", strtotime($post->created_at)); ?></td>
                    <td><a href="postview.php?id=<?php echo $post->id ?>">View</a></td>
                  </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>