<?php

setcookie("name", "", time() - 3600, "/");
header("Location: /www/lacp06/cv10/index.php");
