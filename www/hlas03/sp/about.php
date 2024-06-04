<?php require __DIR__ . '/include/header.php'; ?>

<main class="container">
    <div class="row">
        <?php require __DIR__ . '/components/CategoryDisplay.php'; ?>
        <div class="col-lg-9 mt-5">
            <h1>O nás</h1>
            <p>Vítejte v našem obchodě! Jsme firma, která se specializuje na prodej sportovního vybavení. Naším cílem je poskytovat kvalitní produkty za přijatelné ceny a výjimečný zákaznický servis.</p>

            <h1>Kontakt</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Oddělení</th>
                        <th>Email</th>
                        <th>Telefon</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Zákaznický servis</td>
                        <td>zakaznicky.servis@nasobchod.cz</td>
                        <td>+420 123 456 789</td>
                    </tr>
                    <tr>
                        <td>Technická podpora</td>
                        <td>podpora@nasobchod.cz</td>
                        <td>+420 555 666 777</td>
                    </tr>
                    <tr>
                        <td>Reklamace</td>
                        <td>reklamace@nasobchod.cz</td>
                        <td>+420 444 555 666</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require __DIR__ . '/include/footer.php'; ?>
