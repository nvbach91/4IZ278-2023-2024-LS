<header>
    <nav class="navbar bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php if (isset($_SESSION['iduser'])) {
                                                echo 'u';
                                            } else {
                                                echo '/~kouv13/sem/';
                                            } ?>">MOJE HALA</a>
            <div class="d-flex" role="search">
                <?php if (!isset($_SESSION['admin']) && isset($_SESSION['iduser'])) { ?>
                    <div class="button-container me-2">
                        <a href="u/profile/" class="circle-button"><?php echo $_SESSION['name'][0]; ?></a>
                    </div>
                <?php } else if (isset($_SESSION['admin'])) { ?>
                    <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#new-sport">+ Přidat nový sport</button>
                    <a href="admin/newField.php" class="btn btn-success me-2">+ Přidat novou halu</a>
                <?php }
                if (isset($_SESSION['iduser'])) { ?>
                    <a href="logout/" class="btn btn-warning">Odhlásit se</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>
<?php if (isset($_SESSION['admin'])) {
    include BASE_PATH . '/includes/newSport.php';
}
