<?php require APPROOT . '/views/inc/header.php' ?>
   <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class='fas fa-angle-double-left'></i>Back </a>
    <div class="card card-body bg-light mt-5">
        <h2> Add New Blog</h2>
        <p> creat a post wth this Form</p>
        <form action="<?php echo URLROOT; ?>/posts/add" method="post">
            <div class="form-group">
                <label for="email">Titel: <sub>*</sub></label>
                <input type="text" name="title" id="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"> <?php echo $data['title_error'];?></span>
            </div>
            <div class="form-group mb-3">
                <label for="body">Body: <sub>*</sub></label>
                <textarea type="text" name="body" id="body" class="form-control form-control-lg <?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback"> <?php echo $data['body_error'];?></span>
            </div>
            
            <input type="submit" class="btn btn-success" value="sumbit">
        </form>
    </div>   
<?php require APPROOT. '/views/inc/footer.php'; ?>