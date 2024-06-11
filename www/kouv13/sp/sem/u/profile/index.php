<?php
require_once __DIR__ . '../../../config.php';
include BASE_PATH . '/includes/auth.php';
require_once BASE_PATH . '/includes/head.php';
$parts = explode(" ", $_SESSION['name']);
$name = $parts[0];
?>
<title>Profil | MOJE HALA</title>
</head>

<body>

    <?php include BASE_PATH . '/includes/header.php'; ?>


    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <div class="col-12 border-bottom mb-5">
                    <h1>Vítej zpět, <?php echo $name; ?>.</h1>
                    <p>Email, na který ti budeme posílat veškeré info: <strong><?php echo $_SESSION['email']; ?></strong>.</p>
                </div>
                <div class="col-12 border-bottom mb-5">
                    <h2>Kontakt na nás</h2>
                    <p>Telefon: <a href="tel:+420777777521">+420 777 777 521</a></p>
                    <p>Email: <a href="mailto:info@mojehala.cz">info@mojehala.cz</a></p>
                </div>
                <div class="col mb-5">
                    <h2>Změna hesla</h2>
                    <form action="u/profile/changePassword.php" method="post" class="w-50">
                        <?php
                        require_once BASE_PATH . '/includes/logs.php';
                        ?>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control focus-ring focus-ring-success" id="old-psw" placeholder="Původní heslo" name="old-password" required>
                            <label for="floatingPassword">Původní heslo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control focus-ring focus-ring-success" id="floatingPassword" placeholder="Nové heslo" name="new-password" required>
                            <label for="floatingPassword">Nové heslo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control focus-ring focus-ring-success" id="floatingPassword" placeholder="Nové heslo znovu" name="again-password" required>
                            <label for="floatingPassword">Nové heslo znovu</label>
                        </div>
                        <button type="submit" class="btn btn-success" name="submit">Změna hesla</button>
                </div>
            </div>
        </div>

        <?php
        include BASE_PATH . '/includes/footer.php';
        ?>