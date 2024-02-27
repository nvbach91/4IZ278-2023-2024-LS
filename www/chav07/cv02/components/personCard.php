<?php 

function createPersonCard(Person $person){
    $cardFront = createCardFront($person);
    $cardBack = createCardBack($person);
    return <<<HTML
    <div class="card">
        {$cardFront}
        {$cardBack}
    </div>
HTML;
}    
?>