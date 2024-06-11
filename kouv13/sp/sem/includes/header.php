<header>
    <nav class="navbar bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand" href="u">MOJE HALA</a>
            <div class="d-flex" role="search">
                <?php if (!isset($_SESSION['admin'])) { ?>
                    <div class="button-container me-2">
                        <a href="u/profile/" class="circle-button"><?php echo $_SESSION['name'][0]; ?></a>
                    </div>
                <?php } else { ?>
                    <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#new-sport">+ Přidat nový sport</button>
                    <a href="admin/newField.php" class="btn btn-success me-2">+ Přidat novou halu</a>
                <?php } ?>
                <a href="logout/" class="btn btn-warning">Odhlásit se</a>
            </div>
        </div>
    </nav>
</header>
<?php if (isset($_SESSION['admin'])) {
    include BASE_PATH . '/includes/newSport.php';
}
