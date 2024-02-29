<?php 

function createCardBack(Person $person) {

    return <<<HTML
        <div class="card-side card-back">
            <div class="back-col-1">
                <img class="backside-image" src="$person->image_url" alt="logo">
                <p class="text-bold-m">{$person->getFullName()}</p>
                <p class="text-normal-sm">{$person->position}</p>
                <p class="text-normal-sm">Age {$person->getCurrentAge()}</p>
            </div>

            <div class="back-col-2">
                <div class="info-item">
                    <img class="icon" src="images/map-pin-outline.svg">
                    <div class="text-normal-sm">
                        {$person->address->addressToString()}
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/phone-outline.svg">
                    <div class="text-normal-sm">
                        {$person->telephone}
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/envelope-outline.svg">
                    <div class="text-normal-sm">
                        {$person->email}
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/globe-outline.svg">
                    <div class="text-normal-sm">
                        {$person->website}
                    </div>
                </div>
                <div class="info-item">
                <div class="info-item">
                    <div class="text-normal-sm">
                        {$person->isLookingForJobToString()}
                    </div>
                </div>
                </div>
            </div>
    </div>
HTML;
}
?>