<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/head.php'; ?>
<title>Nová hala</title>
</head>

<body>
    <?php require_once BASE_PATH . '/includes/header.php'; ?>
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center mt-5">
                <div class="col-12 col-md-8 col-lg-6 rounded-2 p-2">
                    <form action="admin/addNewField.php" method="post" enctype="multipart/form-data">
                        <?php require_once BASE_PATH . '/includes/logs.php'; ?>
                        <h2 class=" mb-3">Nová hala?</h2>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="Pepa Novák" name="name">
                            <label for="floatingInput">Jméno</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control focus-ring focus-ring-success" placeholder="Popisek" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                            <label for="floatingTextarea2">Popisek</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="kapacita" name="capacity">
                            <label for="floatingInput">Kapacita</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="cena" name="price">
                            <label for="floatingInput">Cena</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Obrázek</label>
                            <input type="file" class="form-control focus-ring focus-ring-success" id="inputGroupFile01" accept="image/*" name="image">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Přidat</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>