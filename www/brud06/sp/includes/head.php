<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>My Browser Game</title>
</head>


<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Home</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <?php if (isset($_COOKIE['name'])) : ?>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>