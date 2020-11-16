<?php include 'inc/header.php'; ?>
<div class="jumbotron">
<p class="lead">Subscribe to our mailing list to get semi-weekly updates of new posts in your inbox.</p>
<p><a class="btn btn-lg btn-success" href="#" role="button">Subscribe</a></p>
</div>
    <?php foreach ($posts as $post): ?>
        <div class="row marketing">
            <div class="col-md-9">
                <h4><?php echo $post->title; ?></h4>
            </div>
            <div class="col-md-3" style="text-align: right">
                <p><?php echo strftime("%d/%m/%Y",strtotime($post->created_at)); ?></p>
            </div>
            <div class="col-sm-10">
                <p><?php echo $post->username ?></p>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-default" href="postview.php?id=<?php echo $post->id ?>">View</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>
</div>
<?php include 'inc/footer.php'?>