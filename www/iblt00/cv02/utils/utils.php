<?php

function getAge($dob)
{
    $today = date("Y-m-d");

    $age = date_diff(date_create($dob), date_create($today));
    echo $age->format('%y');
}
