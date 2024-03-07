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
        <?php } else if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                <section class="bg-success m-5 p-3 rounded-3">
                    <p>Díky za registraci!</p>
                </section>
        <?php } ?>
        <section class="row p-5 justify-content-around">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row">
                <div class="col-12 mb-3">
                    <h1>Formulář pro turnaj v karetní hře</h1>
                </div>
                <div class="mb-3 col-6">
                    <label for="full-name" class="form-label">Celé jméno</label>
                    <input class="form-control" id="full-name" name="full-name" value="<?php if (isset($fullName)) {
                        echo $fullName;
                    } ?>">
                </div>
                <div class="col-6">
                    <label for="sex" class="form-label">Pohlaví</label>
                    <select class="form-select mb-3" aria-label="Large select example" name="sex" id="sex">
                        <option value="man" <?php if (isset($sex) && $sex == 'man') {
                            echo 'selected';
                        } ?>>Muž</option>
                        <option value="woman" <?php if (isset($sex) && $sex == 'woman') {
                            echo 'selected';
                        } ?>>Žena</option>
                        <option value="other" <?php if (isset($sex) && $sex == 'other') {
                            echo 'selected';
                        } ?>>Jiné</option>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="telefon" class="form-label">Telefon</label>
                    <input class="form-control" id="phone" name="phone" value="<?php if (isset($phone)) {
                        echo $phone;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="image" class="form-label">URL profilovky</label>
                    <input class="form-control" id="image" name="image" value="<?php if (isset($imageURL)) {
                        echo $imageURL;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="deck" class="form-label">Název balíku karet</label>
                    <input class="form-control" id="deck" name="deck" value="<?php if (isset($deck)) {
                        echo $deck;
                    } ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="cards-number" class="form-label">Počet karet v balíku</label>
                    <input class="form-control" id="cards-number" name="cards-number" value="<?php if (isset($cardsNumber)) {
                        echo $cardsNumber;
                    } ?>">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Odeslat</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>