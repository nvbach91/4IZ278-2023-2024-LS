<?php

function redirectToUrl($baseUrl, $params = [])
{
    $queryString = http_build_query($params);

    $redirectUrl = $baseUrl . '?' . $queryString;

    header('Location: ' . $redirectUrl);
    exit();
}
