<?php
$businessCards = [];

$me = new Person(
    "https://i.pinimg.com/564x/e1/8c/b9/e18cb99f18e3501431afc256ce31735b.jpg",
    "Martin",
    "Všeborec",
    2000,
    "Ředitel zeměkoule",
    "OpenAI",
    "Broadway Street",
    33,
    10,
    "New York",
    "+1 722 92999",
    "martin.vseborec@gmail.com",
    "martin.vseborec.cz",
    false
);

$linus = new Person(
    "https://cdn.britannica.com/99/124299-050-4B4D509F/Linus-Torvalds-2012.jpg",
    "Linus",
    "Torvalds",
    1969,
    "Creator of Linux and Git",
    "Freelancer",
    "Nuomi",
    32,
    1,
    "Helsinki",
    "+32 232 29 233",
    "linus@linux.com",
    "linux.com",
    false
);

$jack = new Person(
    "https://static.tvtropes.org/pmwiki/pub/images/sparrow_jack.jpg",
    "Jack",
    "Sparrow",
    1720,
    "Captain",
    "The Ocean",
    "St. Martin",
    1,
    2,
    "Karibik",
    "+1 233 422 22",
    "black.pearl.for.life@gmail.com",
    "sparrow.com",
    true
);

array_push($businessCards, $me);
array_push($businessCards, $linus);
array_push($businessCards, $jack);
?>

<?php foreach ($businessCards as $singleBusinessCard) : ?>
    <div class="business-card">
        <div class="upper-container">
            <img class="avatar" src="<?php echo $singleBusinessCard->avatar; ?>">
            <div>
                <div class="name-and-age">
                    <?php echo $singleBusinessCard->getFullName() . " (" . $singleBusinessCard->getAge() . " let)"; ?>
                </div>
                <div><?php echo $singleBusinessCard->job; ?>, <span style="color: blue"><?php echo $singleBusinessCard->company; ?></span></div>
                <div class="location"><?php echo $singleBusinessCard->getFullAddress(); ?></div>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between">
            <strong>📞 <?php echo $singleBusinessCard->phone; ?></strong>
            <strong>💌 <?php echo $singleBusinessCard->email; ?></strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 60px">
            <div>🛜 <?php echo $singleBusinessCard->web; ?></div>
            <div>
                <?php echo $singleBusinessCard->available(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>