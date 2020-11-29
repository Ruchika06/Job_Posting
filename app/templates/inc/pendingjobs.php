<div class="container">
  <!-- All Jobs requiring approval by admin-->
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <h2 class="text-center">Pending for approval</h2>
        <table class="table table-striped">
          <thead>
            <th>Title</th>
            <th>Date</th>
            <th>Details</th>
          </thead>
          <tbody>
            <?php foreach($pendingposts as $post) { ?>
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
