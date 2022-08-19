
<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class='fas fa-angle-double-left'></i>Back </a>
<br>
<!--the data['post'] is a array and it has all the data from the database -->
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondray text-dark p-2 mb-3">
    written by <?php echo $data['user']->name;?> on <?php echo $data['post']->created_at;?>
</div>
<p><?php echo $data['post']->body; ?></p>
<?php if ($data['post']->users_id == $_SESSION['user_id']) :?>
    <hr>
    <div class="container text-center">
    <div class="row">
        <div class="col col-md-3">
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id ?>" class="btn btn-dark bm-3">Edit </a>
        </div>
            <div class="col col-md-6"></div>
        <div class="col col-md-3">
            <form  action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST" class ="pull-right">
            <input type="submit" value="Delete" class="btn btn-danger">
            </form>
         </div>
    </div>
    </div>
    <?php endif;?>
<?php require APPROOT . '/views/inc/footer.php' ?>
