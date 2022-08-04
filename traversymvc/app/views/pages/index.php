<?php require APPROOT . '/views/inc/header.php' ?>
<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description'];  ?></p>
    </div>

</div>

<?php

//to get the path from the config file i use the method define and i named APPROOT
//echo APPROOT;
?>
<?php require APPROOT. '/views/inc/footer.php'; ?>