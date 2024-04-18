<?php include __DIR__ . "/inc/head.php";

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    setcookie("name", $name, time() + 3600);
    header('Location: ' . "index.php");
}



?>
<main style="height: 100vh;">
    <div style="width: 60%; margin: 50px auto;">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Jméno</label>
                <input type="text" class="form-control" name="name" placeholder="John Doe">

            </div>

            <button type="submit" class="btn btn-primary">Přihlásit se</button>
        </form>
    </div>
</main>
<?php include __DIR__ . "/inc/foot.php" ?>