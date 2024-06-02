<?php


//BASE_URL has to be changed to reflect your enviroment setup
define("BASE_URL", "/chav07-sp/src");

//ITEMS_PER_PAGE is meant for pagination
define("ITEMS_PER_PAGE", 20);

//APP_ID is facebook's app id for OAUTH2
define("APP_ID", 0);
//APP_SECRET is facebook's app secret for OAUTH2
define("APP_SECRET", "{secret}");

//APP_REDIRECT has to be changed to reflect your enviroment setup. Change the http://localhost to your domain (e.g. http://example.com )
define("APP_REDIRECT", "http://localhost". BASE_URL. "/authentication/oauth.php");
//GRAPH_API_VERSION is current facebooks Graph api version
define("GRAPH_API_VERSION","v20.0");



?>