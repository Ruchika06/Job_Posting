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
            <h2 class="text-center">Jobs Dashboard</h2>
            <table class="table table-striped">
              <thead>
                <th>Job Name</th>
                <th>Created At</th>
                <th>Created By</th>
                <th>View </th>
              </thead>
              <tbody>
                <?php
                //Sql Query for showing all applied job posts. 
                    
                    

               	
                  //print_r($postsres);

                  //If user applied to job then display that post information.
                    foreach($posts as $post)
                    {                     
                      
                     ?>
                      <tr>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($post->created_at)); ?></td>
                        <td><?php echo $post->username; ?></td>
                        <td><a class="btn btn-default" href="postview.php?id=<?php echo $post->id ?>">More Info</a></td>                                              
                      </tr>
                     <?php
                    }
                  
                  
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

<?php include 'inc/footer.php'?>