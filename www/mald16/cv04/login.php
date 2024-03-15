<?php
include "./components/head.php";
require "./utils.php";

if (!empty($_POST)) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $errors = [];
    $loginSuccess = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "E-mail address '$email' is not valid!");
    }

    $authValue = authenticate($email, $password);

    if ($authValue[0] == "error") {
        array_push($errors, $authValue[1]);
    } else if ($authValue[0] == "success") {
        $loginSuccess = true;
    }
}

?>
<h1 style="text-align: center;">Login</h1>
<br>
<div style="display: flex; justify-content: center">
    <a href="./registration.php" class="btn btn-outline-primary " style="margin-right: 10px;">Register</a><a href="./admin/users.php" class="btn btn-outline-primary">View all accounts</a>
</div>
<br>
<?php if (isset($loginSuccess) && $loginSuccess) : ?>
    <div class="alert alert-success">
        <strong>Login success</strong>
        <div>Welcome to your account!</div>
    </div>
    <br>
    <br>
    <div style="margin: 0 25%;">
        <strong>I have nothing really to show you after login, so here is a paragraph about grizzly bear:</strong>
        <p>The grizzly bear is a kind of brown bear. Many people in North America use the common name “grizzly bear” to refer to the smaller and lighter-colored bear that occurs in interior areas and the term “brown bear” to refer to the larger and typically darker-colored bear in coastal areas. However, most of these bears are now considered the same subspecies.

            In North America there are two subspecies of brown bear (Ursus arctos): the Kodiak bear, which occurs only on the islands of the Kodiak Archipelago, and the grizzly bear, which occurs everywhere else. Brown bears also occur in Russia, Europe, Scandinavia, and Asia.

            Grizzly bears are large and range in color from very light tan (almost white) to dark brown. They have a dished face, short, rounded ears, and a large shoulder hump. The hump is where a mass of muscles attach to the bear’s backbone and give the bear additional strength for digging. They have very long claws on their front feet that also give them extra ability to dig after food and to dig their dens.

            Grizzly bears weigh upward of 700 pounds (315 kilograms). The males are heavier than the females and can weigh 200 to 300 kilograms (about 400 to 600 pounds). A large female can weigh 110 to 160 kilograms (about 250 to 350 pounds) in the lower-48 States.</p>
    </div>
<?php endif ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" style='display:<?php echo isset($loginSuccess) && $loginSuccess ? "none" : "block" ?>; margin: 0 25%;'>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <strong>Following errors occured:</strong>
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <?php if (isset($_GET["email"]) && empty($_POST)) : ?>
        <div class="alert alert-success">
            <strong>Your registration was succesfull!</strong>
            <div>A confirmation e-mail was sent to <?php echo $_GET["email"] ?>.</div>
        </div>
    <?php endif ?>
    <div class="form-group mb-3">
        <label>Email <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="email" type="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : "" ?>" required>
        <div class="form-text">
            E.g. xname@vse.cz
        </div>
    </div>
    <div class="form-group mb-3">
        <label>Password <span style="color: #ff0000;">*</span></label>
        <input class="form-control" name="password" type="password" value="" required>
    </div>
    <button class="btn btn-primary mt-3" type="submit">Login</button>
</form>
<?php include "./components/foot.php" ?>