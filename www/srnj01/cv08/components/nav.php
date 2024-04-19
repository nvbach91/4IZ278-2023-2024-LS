<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container d-flex">
    <a class="navbar-brand" href="index.php">Shop Name</a>
    <div class="ml-auto">
      <ul class="navbar-nav d-flex flex-row">
        <?php if (isset($_SESSION['username'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="user.php"><?php echo $_SESSION['username'] ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center h-100" href="logout.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" x2="9" y1="12" y2="12" />
              </svg>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center h-100" href="add.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php endif;
        ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center h-100" href="cart.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart">
              <circle cx="8" cy="21" r="1" />
              <circle cx="19" cy="21" r="1" />
              <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>