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
        <section class="row p-5 justify-content-around">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row">
                <div class="col-12 mb-3">
                    <h1>Registrace</h1>
                </div>
                <div class="mb-3 col-6">
                    <label for="full-name" class="form-label">Celé jméno</label>
                    <input class="form-control" id="full-name" name="full-name" value="<?php if (isset($fullName)) {
                        echo $fullName;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Heslo</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Heslo znovu</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Registrovat</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>