<?php
require_once 'Person.php';
require_once 'utils.php';
require_once 'header.php';

$people = [
    new Person("./images/airbnb-cleaning-min.png", "Samuel", "Lorenc", "2000-10-02", "Web Developer", "Magu s.r.o.", "Kódová", "123", "45", "Praha", "+420 728 980 270", false, "lorencsam@seznam.cz", "www.magu.co", false),
    new Person("./images/ic_launcher.png", "Jiří", "Novák", "1984-05-16", "Grafický designer", "Stractly s.r.o.", "Umělecká", "30", "7", "Brno", "+420 605 123 456", true, "jiri.novak@design.cz", "www.tasker.cz", true),
    new Person("./images/checkmark2.png", "Eva", "Svobodová", "1992-11-24", "Marketingová specialistka", "Inovace s.r.o.", "Inovační", "12", "32", "Ostrava", "+420 702 987 654", false, "eva.svobodova@inovace.com", "www.inovace.com", false),
];

?>

<main>
    <?php foreach ($people as $person): ?>
        <section class="section1">
            <div class="card">
                <div class="div1">
                    <img src="<?php echo $person->avatar; ?>" alt="Avatar">
                </div>
                <div class="div2">
                    <h1><?php echo $person->getFullName(); ?></h1>
                    <p>Věk: <?php echo getAge($person->birthDate); ?></p> <!-- Použití funkce getAge z utils.php -->
                    <p>Povolání: <?php echo $person->jobTitle; ?></p>
                    <h2><?php echo $person->companyName; ?></h2>
                    <p>Adresa: <?php echo $person->getAddress(); ?></p>
                    <p>Telefon: <?php echo $person->phone; ?></p>
                    <p>Email: <a href="mailto:<?php echo $person->email; ?>"><?php echo $person->email; ?></a></p>
                    <p>Webové stránky: <a href="http://<?php echo $person->website; ?>" target="_blank"><?php echo $person->website; ?></a></p>
                    <p>Hledám práci: <?php echo $person->isLookingForJob ? "Ano" : "Ne"; ?></p>
                    <p>Ženatý/Vdaná? <?php echo $person->isMarried ? "Ano" : "Ne"; ?></p>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</main>

<?php
require_once 'footer.php';
?>
