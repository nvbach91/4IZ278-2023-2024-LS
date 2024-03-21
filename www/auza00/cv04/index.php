<?php 

require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

if (!empty($_POST)){ //pokud máme data
    $name = htmlspecialchars(trim($_POST['name'])); //trim oseká slovo (kvůli mezerám)
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deckName = htmlspecialchars(trim($_POST['deckName']));
    $cardNumber = htmlspecialchars(trim($_POST['cardNumber']));
    $password = htmlspecialchars(trim($_POST['password']));
    $gender = $_POST['gender'];

    $errors = [];
    // validace emailu user.name@domain.realm
    if(strlen($name)<3){
        array_push($errors, "$name must have at least 3 characters!");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "$email is not valid!");
    }
    if(!preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)){
        array_push($errors, "$phone is not a valid phone number. e.g. +420 024 420 024");
    }
    if(checkUserExists('./users.txt', $email)){
        array_push($errors, 'This email is already used.');
    }
    if(!filter_var($avatar, FILTER_VALIDATE_URL)){
        array_push($errors, "$avatar is not valid!");
    }
    if(strlen($deckName)<3){
        array_push($errors, "$deckName must have at least 3 characters!");
    }
    if(!is_numeric($cardNumber)){
        array_push($errors, "$cardNumber must be a number");
    }
    if(floor(floatval($cardNumber)) != floatval($cardNumber)){
        array_push($errors, "$cardNumber must be a whole number");
    }
    if($cardNumber < 0){
        array_push($errors, "$cardNumber cannot be a negative value");
    }

    /*if(count($errors)==0){
        $successMessage = 'Cute kittens';
        mail('auza00@vse.cz',
            'Registration successful',
            '<h1>https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley</h1>',
            [
                'MIME-Version: 1.0',
                'Content-Type: text/html',
                'From: auza00@vse.cz',
                'X-Mailer: PHP/' . phpversion(),
            ],
        );
    }*/
    $userRecord = implode(';', [
        $name,
        $email,
        $password,
        $phone,
        $avatar,
        $gender
    ]);
    appendFileContent('./users.txt', $userRecord);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <?php if(isset($successMessage)): ?>
        <h2><?php echo $successMessage; ?></h2>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
        <?php foreach($errors as $error): ?>
            <p class="form-error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($avatar)): ?>
        <img style='max-height: 150px;' src='<?php echo $avatar; ?>'/>
    <?php endif; ?>
    <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="alert alert-danger">Show alert only after submission and change alert type accordingly</div>
    <div class="form-group">
        <label>Jméno</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>"> <!--podmínka pokud je nastavena proměnná $name, vypiíše $name, jinak prázdný string-->
    </div>                                                                                      
    <div class="form-group">
        <label>E-mail</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>PASSWORD</label>
        <input type="password" class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
    </div>
    <div class="form-group">
        <label>Telefon</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
    </div>
    <!--<div class="form-group">
        <label>Profilový obrázek (URL)</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
    </div>-->
    <div class="form-group">
        <label>Název balíku</label>
        <input class="form-control" name="deckName" value="<?php echo isset($deckName) ? $deckName : '' ?>">
    </div>
    <div class="form-group">
        <label>Počet karet v balíku</label>
        <input class="form-control" name="cardNumber" value="<?php echo isset($cardNumber) ? $cardNumber : '' ?>">
    </div>
    <div class="form-group">
        <label>Pohlaví</label>
        <select name="gender">
            <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value=""></option>
            <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : 'F'; ?> value="F">F</option>
            <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : 'M'; ?> value="M">M</option>
        </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</body>
</html>