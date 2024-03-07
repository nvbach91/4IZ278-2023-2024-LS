<!DOCTYPE html>
<html>

<head>
    <title>CV03</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <form class="form-signup d-grid gap-2 mx-auto my-4" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>"
        style="max-width: 500px;">

        <h1 class="h3 mb-3 font-weight-normal text-center">Registration</h1>



        <?php
          

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));

    
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar_url = htmlspecialchars(trim($_POST['avatar']));
    $pile_name = htmlspecialchars(trim($_POST['pile_name']));
    $card_count = htmlspecialchars(trim($_POST['card_count']));

    $errors =[];

    if ($name == '') {
        $errors[] = 'Name is required.';
    } else if (strlen($name) < 3) {
        $errors[] = 'Name is too short.';
    } else if (strlen($name) > 100) {
        $errors[] = 'Name is too long.';
    }

    if ($email == '') {
        $errors[] = 'Email is required.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email: ' . $email;
    }

    $phonePattern = '/^\+?(\d{1,3})?[-.\s]?(\d{3})[-.\s]?(\d{3})[-.\s]?(\d{3})$/';
    if ($phone == '') {
        $errors[] = 'Phone is required.';
    } else if (!preg_match($phonePattern, $phone)) {
        $errors[] = 'Invalid phone number: ' . $phone;
    }

    if ($avatar_url == '') {
        $errors[] = 'Picture is required.';
    } else if (!filter_var($avatar_url, FILTER_VALIDATE_URL)) {
        $errors[] = 'Invalid URL: ' . $avatar_url;
    }

    if (strlen($pile_name) > 100) {
        $errors[] = 'Pile name is too long.';
    }

    if ( $card_count < 0 && $card_count != '') {
        $errors[] = 'Negative count of cards:' . $card_count;
    }

if (!empty($errors)) {
    echo '<div class="alert alert-danger mt-5 gap-3">';
    foreach ($errors as $error) {
        echo '<div>'. $error . '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-success">Registration successful!</div>';
}
}

?>

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name :'' ?> ">
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select class="form-control" name="gender">
                <option value="male" <?php echo isset($gender) && $gender === 'male' ? 'selected' : '' ?>>Male</option>
                <option value="female" <?php echo isset($gender) && $gender === 'female' ? 'selected' : '' ?>>Female
                </option>
            </select>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email :'' ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone :'' ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar_url) ? $avatar_url :'' ?>"">
        </div>

        <?php 
        if (isset($avatar_url) && filter_var($avatar_url, FILTER_VALIDATE_URL)) {
            echo '<img class="img-fluid" style="max-width: 150px; max-height: 150px;" src="' . $avatar_url . '" alt="Avatar">';
        }
        
        ?>

        <div class=" form-group">
            <label>Pile name</label>
            <input class="form-control" name="pile_name" value="<?php echo isset($pile_name) ? $pile_name :'' ?>">
        </div>
        </div>
        <div class="form-group">
            <label>Card count</label>
            <input class="form-control" name="card_count" type="number"
                value="<?php echo isset($card_count) ? $card_count :'' ?>">
        </div>

        <button class="btn btn-primary mt-4" type="submit">Submit</button>
    </form>


</body>

</html>