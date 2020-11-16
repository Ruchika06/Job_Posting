<?php include 'inc/header.php'; ?>

    <div class="container">

      
      <!-- All Job Posts that we applied to. -->

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Applied Jobs</h2>
            <table class="table table-striped">
              <thead>
                <th>Job Name</th>
                <th>Job Description</th>
                <th>Applied At</th>
                <th>Status</th>
              </thead>
              <tbody>
                <?php
                //Sql Query for showing all applied job posts. 
               		
                	

                  $postsres = $post->getappliedPosts($_SESSION["userid"]);
                  //print_r($postsres);

                  //If user applied to job then display that post information.
                  	foreach($postsres as $post)
                    {                     
                      
                     ?>
                      <tr>
                        <td><?php echo $post->title; ?></td>
                        <td><?php echo $post->description; ?></td>
                        <td><?php echo $post->status; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($post->applied_at)); ?></td>                                              
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
<?php include 'inc/footer.php'; ?>