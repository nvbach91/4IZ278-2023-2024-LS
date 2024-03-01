<?php

function birthdayToAge(DateTime $born) {
    return $born->diff(new DateTime())->format("%Y");
}