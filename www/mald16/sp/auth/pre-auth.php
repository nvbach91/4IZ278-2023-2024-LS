<?php

require 'config.php';

$url = "https://accounts.google.com/o/oauth2/auth";

// build the HTTP GET query
$params = array(
    "response_type" => "code",
    "client_id" => $oauth2_client_id,
    "redirect_uri" => $oauth2_redirect,
    "scope" => "https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile",
    "access_type" => "offline",
    "prompt" => "consent"
);

$request_to = $url . '?' . http_build_query($params);
