<nav class="navbar navbar-expand-lg bg-light mb-3">
  <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>">
        <?php echo SITENAME; ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo URLROOT; ?>"><i class='fas fa-home'></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About US</a>
          </li>

        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <?php if(isset($_SESSION['user_id'])) : ?>
          <li class="nav-item">
              <a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name']; ?></a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class='fas fa-sign-out-alt'></i> Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register"><i class='fas fa-user-alt'></i> Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login"><i class='fas fa-sign-in-alt'></i> Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
</nav>