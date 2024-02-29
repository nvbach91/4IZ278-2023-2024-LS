
<?php include './includes/head.php'; //import statické části html souboru ?>
<main>
    <h1>Business Cards in PHP</h1>
    <div class="cards">
        <?php require './components/persons.php'; //když import části, která obsahuje PHP, musíme použít require místo include ?>
    </div>
</main>

<?php include './includes/foot.php'; //import statické části html souboru ?>