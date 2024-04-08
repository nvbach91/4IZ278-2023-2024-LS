<?php

if (!empty($_POST['name'])) {
    setcookie("name", $_POST['name'], time() + 3600);
    header('Location: index.php');
    exit();
}
?>
<?php require './incl/header.php'; ?>
   <?php include './incl/navbar.php'; ?>
   <main class="container">
      <h1>Login</h1>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <br>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './incl/footer.php'; ?>