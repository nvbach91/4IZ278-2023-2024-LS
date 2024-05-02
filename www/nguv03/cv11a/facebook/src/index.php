<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \JanuSoftware\Facebook\Facebook;

$fb = new Facebook([
  'app_id' => '...',
  'app_secret' => '...',
  'default_graph_version' => 'v15.0',
  //'default_access_token' => '{access-token}', // optional
]);


?>