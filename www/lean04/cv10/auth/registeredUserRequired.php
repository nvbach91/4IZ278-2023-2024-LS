<?php

if (empty($_COOKIE['user_id'])) {
    echo 'You are not allowed to access this page.';
    exit();
}
