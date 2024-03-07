<?php
$errors = array();

if(!empty($_POST)){
    //mame data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $deckName = htmlspecialchars(trim($_POST["deckName"]));
    $cardCount= htmlspecialchars(trim($_POST["cardCount"]));
    

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "Email must be in user@example.com format!";
    }
    if(!filter_var($avatar, FILTER_VALIDATE_URL) ) {
        $errors["avatar"] = "Avatar must be a valid url!";
    }
    if(strlen($name) < 3 ){
        $errors["name"] = "Name must have at least 3 characters!";
    }
    if(!preg_match("/^(\\+\\d{2,3})?( ?\\d{3}){3}$/", $phone)){
        $errors["phone"] = "Phone must be in format +420 777 777 777!";
    }
    if(strlen($deckName) < 3 ){
        $errors["deckName"] = "Deck name must have at least 3 characters!";
    }
    if(!(is_numeric($cardCount) && (int)$cardCount == $cardCount && $cardCount > 0) ){
        $errors["cardCount"] = "You must have at least 1 card!";
    }
    if($gender == ""){
        $errors["gender"] = "You must pick a gender!";
    }


    if(count($errors) == 0 ){
        $successMessage = "Thank you for your registration.";
    }
}

?>



<h1>Card Game Tournament</h1>
<h2>Registration form</h2>

<?php if(isset($successMessage)): ?>
    <div class="form-success radius-md">
        <p><?php echo $successMessage; ?></p>
    </div>
<?php endif; ?>
<?php  if(!empty($errors)): ?>
    <div class="form-errors radius-md">
        <?php foreach($errors as $error => $message): ?>
            <p class="form-error"><?php echo $message; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form class="form-signup" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <!-- <div class="alert alert-danger">Show alert only after submission and change alert type accordingly</div> -->
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" class="form-control radius-sm  <?php echo array_key_exists("name", $errors)? "input-invalid":""?>"
         name="name" value="<?php echo isset($name) ? $name : "" ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control radius-sm  <?php echo array_key_exists("email", $errors)? "input-invalid":""?>"
         name="email" value="<?php echo isset($email) ? $email : "" ?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input id="phone" class="form-control radius-sm  <?php echo array_key_exists("phone", $errors)? "input-invalid":""?>"
         name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-control radius-sm  <?php echo array_key_exists("gender", $errors)? "input-invalid":""?>">
            <option <?php echo isset($gender) && $gender == "" ? "selected" : "" ?> value="">None</option>
            <option <?php echo isset($gender) && $gender == "F" ?  "selected" : "" ?> value="F">Female</option>
            <option <?php echo isset($gender) && $gender == "M" ? "selected" : "" ?> value="M">Male</option>
        </select>
    </div>
    <div class="form-group">
        <label for="deckName">Deck Name</label>
        <input id="deckName" class="form-control radius-sm  <?php echo array_key_exists("deckName", $errors)? "input-invalid":""?>"
         name="deckName" value="<?php echo isset($deckName) ? $deckName : "" ?>">
    </div>
    <div class="form-group">
        <label for="cardCount">Card Count</label>
        <input id="cardCount" class="form-control radius-sm  <?php echo array_key_exists("cardCount", $errors)? "input-invalid":""?>"
         name="cardCount" value="<?php echo isset($cardCount) ? $cardCount : "" ?>">
    </div>
    <div class="form-group">
        <label for="avatar">Avatar URL</label>
        <?php if(isset($avatar) && !array_key_exists("avatar", $errors)): ?>
            <img class="avatar-img" alt="avatar" src="<?php echo $avatar; ?>"/>
        <?php endif; ?>
        <input id="avatar" class="form-control radius-sm <?php echo array_key_exists("avatar", $errors)? "input-invalid":""?>"
            name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>">
    </div>
    <div class="submit-wrapper">
        <button class="btn-primary radius-md" type="submit">Submit</button>
    </div>
</form>
