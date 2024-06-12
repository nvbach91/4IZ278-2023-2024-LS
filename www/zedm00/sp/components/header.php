<?php

session_start();
$advertizerId = isset($_SESSION['advertizer_id']) ? $_SESSION['advertizer_id'] : null;
$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;

if ( isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en" class="h-100 d-flex flex-grow-1">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>BeCultureal</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">

</head>

<body class="h-100 d-flex flex-grow-1 flex-column">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark  <?php echo $advertizerId ? 'bg-primary' : 'bg-dark'; ?>">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $advertizerId ? 'admin_index.php' : 'index.php'; ?>">BeCultureal</a>
            <div class="d-flex align-items-center text-white">
                <p class="mb-0 fst-italic ">Přihlášen jako: <?php echo $_SESSION['name'] ?></p>
                <a class="btn text-white" href="?logout=true">Odhlásit se</a></li>
            </div>


    </div>
</nav>

