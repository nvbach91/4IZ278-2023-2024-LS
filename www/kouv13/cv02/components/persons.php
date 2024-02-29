<?php 
$koubek = new Person('logo.png', 'Vojtěch', 'Koubek', 'Grafický designer', 'Huleba Praha', '+420 777 666 555', 'koubek@hulebapraha.cz', 'www.hulebapraha.cz', false, 'Ke Hrádku', 6, 14200, 'Praha', new DateTime('2003-01-01'));
$kloubecek = new Person('https://cool-stickers.cz/wp-content/uploads/2019/10/mercedes_1.jpg', 'Adam', 'Kloubeček', 'Strojní technik', 'Mercedes Benz', '+420 755 656 555', 'adam-kloubecek@benz.com', 'www.benz.com', false, 'Pod Chodovem', 142, 14100, 'Praha', new DateTime('1987-04-01'));
$sedlacek = new Person('https://a.allegroimg.com/s512/11e796/d6bd010b416f857ec721f1001b69/Logo-znak-BMW-na-zed-darek-pritele-gadget', 'Kryštof', 'Sedláček', 'Automechanik', 'BMW Premium Cars', '+420 606 666 555', 'krsedl@bmwpremium.cz', 'www.bmwpremium.cz', true, 'U Dubu', 12, 13300, 'Praha', new DateTime('2001-03-03'));
$persons = [];
array_push($persons, $koubek);
array_push($persons, $kloubecek);
array_push($persons, $sedlacek);