<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
    header('Location: /~kouv13/sem/admin');
    exit();
}
if (isset($_SESSION['iduser'])) {
    header('Location: /~kouv13/sem/u');
    exit();
}
require_once __DIR__ . '../../config.php';
require_once BASE_PATH . '/includes/head.php'; ?>
<title>Registrace</title>
</head>

<body>
    <?php include BASE_PATH . '/includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="row justify-content-center vh-100 align-items-center">
                <div class="col-12 col-md-8 col-lg-6 rounded-2 p-2">
                    <form action="signup/addUser.php" method="post">
                        <?php require_once BASE_PATH . '/includes/logs.php'; ?>
                        <h2 class=" mb-3">Pojďmě tě zaregistrovat!</h2>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control focus-ring focus-ring-success" id="floatingInput"
                                placeholder="Pepa Novák" name="name"
                                value="<?php if (isset($_SESSION['form-name'])) {
                                    echo $_SESSION['form-name'];
                                } ?>">
                            <label for="floatingInput">Jméno</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control focus-ring focus-ring-success" id="floatingInput"
                                placeholder="name@example.com" name="email"
                                value="<?php if (isset($_SESSION['form-email'])) {
                                    echo $_SESSION['form-email'];
                                } ?>">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control focus-ring focus-ring-success"
                                id="floatingPassword" placeholder="Password" name="password">
                            <label for="floatingPassword">Heslo</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Registrovat se</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>