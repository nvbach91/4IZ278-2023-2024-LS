<body>
    <main class="container">
        <?php if (count($errors) > 0) { ?>
            <section class="bg-danger m-5 p-3 rounded-3">
                <?php foreach ($errors as $error): ?>
                    <p>
                        <?php echo $error; ?>
                    </p>
                <?php endforeach; ?>
            </section>
        <?php } ?>
        <?php if (!empty($_GET["email"])) { ?>
            <section class="bg-success m-5 p-3 rounded-3">
                <p>Díky za registraci!</p>
            </section>
        <?php } ?>
        <?php if (empty($errors) && isset($auth)) { ?>
            <section class="bg-success m-5 p-3 rounded-3">
                <p>Úspěšné přihlášení.</p>
            </section>
        <?php } ?>
        <section class="row p-5 justify-content-around">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row">
                <div class="col-12 mb-3">
                    <h1>Přihlášení</h1>
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Heslo</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Přihlásit</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>