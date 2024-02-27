
<?php
function createCardFront(Person $person) {
    return <<<HTML
    <div class="card-side card-front">
        <div class="spacer"></div>
        <img class="logo" src="$person->image_url">
        <div class="front-side-bottom-part">
            <p class="text-bold-xl">{$person->getFullName()}</p>
            <p class="text-normal-l">{$person->position}</p>
        </div>
</div>
HTML;
}
?>