<?php include './includes/head.php'; ?>
<?php require_once './db/database.php'; 
if (isset($_GET['message'])) {
    echo $_GET['message'];
}
?>
<main class="main">
    <h1>Main Page of LAB10</h1>
    <p>Don't have an account?</p>
    <a class="btn btn-primary" href="./registration.php">Registration</a>
    <p>Already have an account?</p>
    <a class="btn btn-primary" href="./login.php">Login</a>
</main>
<?php include './includes/foot.php'; ?>