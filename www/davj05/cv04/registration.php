<?php
require __DIR__ . "/functions.php";
$view_dir = "./views/";

// Define the path to the users database file
define("USERS_DB", __DIR__ . "/users.db");

// Check if the form is submitted
if (!empty($_POST)) {
    // Get the form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    $errors = [];

    // Validate form data
    if (empty($name) || empty($email) || empty($password1) || empty($password2)) {
        array_push($errors, "Nejsou vyplněna všechna pole");
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Neplatný email");
    } 
    if ($password1 != $password2) {
        array_push($errors, "Zadejte stejné heslo");
    }
    
    // Register new user if there are no errors
    if (empty($errors)) {
        $message = register_new_user($name, $email, $password1);
    }

    // All good
    if (count($errors) == 0) {
        $successMessage = "Děkuji za registraci";
    }
}

?>

<?php require $view_dir . "head.php"; ?>

<body>
    <div class="container mx-auto md:px-20 py-10">
        
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <h1>Registrace</h1>
    <?php if (!empty($errors)): ?>
        <?php foreach($errors as $error): ?>
            <div role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <p><?php echo $error;?></p>
            </div> 
        <?php endforeach;?>       
    <?php endif;?>
    <div class="m-2 p-2">
        <label>Jméno</label>
        <input class="text" name="name" placeholder="Jméno" value="<?php echo isset($name) ? $name : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Email</label>
        <input class="text" name="email" placeholder="" value="<?php echo isset($email) ? $email : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Heslo</label>
        <input class="text" name="password1" placeholder="" value="<?php echo isset($password1) ? $password1 : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Znovu heslo</label>
        <input class="text" name="password2" placeholder="" value="<?php echo isset($password2) ? $password2 : "" ?>">
    </div>
    <button class="btn btn-success" type="submit">
        <p>Odeslat</p>
    </button>
</form>
               


        
    </div>
</body>

<?php require $view_dir . "foot.php"; ?>