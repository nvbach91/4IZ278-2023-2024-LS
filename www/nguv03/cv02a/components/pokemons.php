<?php
require './classes/Pokemon.php';

$pikachu = new Pokemon(
    'Pikachu',
    'https://www.postavy.cz/foto/pikachu-foto.jpg',
    'electric',
);
$bulbasaur = new Pokemon(
    'Bulbasaur',
    'https://www.postavy.cz/foto/bulbasaur-foto.jpg',
    'grass',
);
$charmander = new Pokemon(
    'Charmander',
    'https://www.postavy.cz/foto/charmander-foto.jpg',
    'fire',
);
$pokemons = [];
array_push($pokemons, $pikachu);
array_push($pokemons, $bulbasaur);
array_push($pokemons, $charmander);
?>
<ul>
    <?php foreach ($pokemons as $pokemon) : ?>
        <li>
            <div><?php echo $pokemon->name; ?></div>
            <div>
                <img src="<?php echo $pokemon->image; ?>" alt="<?php echo $pokemon->name; ?>">
            </div>
            <div><?php echo $pokemon->type; ?></div>
        </li>
    <?php endforeach; ?>
</ul>