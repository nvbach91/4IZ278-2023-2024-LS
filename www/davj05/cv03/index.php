<?php
$base_dir = "/cv03";
$view_dir = "./views/";
$components_dir = "./components/";
$pic = "";

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    if (isset($_POST["pic"])) {
        $pic = htmlspecialchars(trim($_POST["pic"]));
    } else {
        $pic = "";
    }
    $deck_name = htmlspecialchars(trim($_POST["deck_name"]));
    $deck_count = htmlspecialchars(trim($_POST["deck_count"]));
    $errors = [];

    // Regex pattern for Czech phone numbers
    $pattern = "/(\\+420|00420)?\\s?(\\d{3})\\s?(\\d{3})\\s?(\\d{3})/";

    if (! preg_match($pattern, $phone)) {
        array_push($errors, "Prosím zadejte platné telefonní číslo");
    }
    if (strlen($name) < 3) {
        array_push($errors, "Vase jmeno musi mit vice jak 3 znaky");
    }
    if (! filter_var($pic, FILTER_VALIDATE_URL)) {
        array_push($errors, "Použijte prosím platnou URL obrázku");
    }
    if (strlen($deck_name) < 3) {
        array_push($errors, "Váš název balíčku musí mít více než 3 znaky");
    }
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email není validní");
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
    <h1>Formlář</h1>
    <?php if (! empty($errors)): ?>
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
        <label>Pohlaví</label>
        <select class="form-select" name="gender">
            <option <?php echo isset($gender) && $gender == "female" ? "selected" : ""; ?> value="female">Žena</option>
            <option <?php echo isset($gender) && $gender == "male" ? "selected" : ""; ?> value="male">Muž</option>
        </select>
    </div>
    <div class="m-2 p-2">
        <label>Email</label>
        <input class="text" name="email" placeholder="" value="<?php echo isset($email) ? $email : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Telefon</label>
        <input class="text" name="phone" placeholder="+420 888 888 888" value="<?php echo isset($phone) ? $phone : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>URL Obrázku</label>
        <input class="text" name="pic" placeholder="" value="<?php echo isset($pic) ? $pic : "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Jméno balíčku</label>
        <input class="text" name="deck_name" placeholder="" value="<?php echo isset($deck_name) ? $deck_name: "" ?>">
    </div>
    <div class="m-2 p-2">
        <label>Velikost balíčku</label>
        <input class="text" name="deck_count" placeholder="" value="<?php echo isset($deck_count) ? $deck_count : "" ?>">
    </div>
    <button class="btn btn-success" type="submit">
        <p>Odeslat</p>
    </button>
</form>
               


        
    </div>
</body>


<?php require $view_dir . "foot.php"; ?>