<?php
include "../components/head.php";
require "../utils.php";
?>
<style>
    .users-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;

    }

    .users-wrapper>div {
        display: flex;
        flex-direction: column;
        padding: 13px;
        border: 1px solid gray;
        width: min-content;
        border-radius: 10px;
        margin: 10px;
        cursor: pointer;
    }

    .users-wrapper>div:hover {
        animation: shake 0.5s;
        animation-iteration-count: infinite;
    }

    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }

        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }

        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }

        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }

        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }

        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }

        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }

        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }

        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }

        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }

        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }
</style>
<?php
$allUsers = fetchUsers();
?>

<h1 style="text-align: center;">Registered users:</h1>
<br>
<div style="display: flex; justify-content: center">
    <a href="../registration.php" class="btn btn-outline-primary " style="margin-right: 10px;">Create account</a><a href="../login.php" class="btn btn-outline-primary">Login</a>
</div>

<br>
<?php if (count($allUsers) != 0) : ?>
    <div style="color: gray; text-align: center" class="mt-4">Try to hover :)</div>
    <div class="users-wrapper">
        <?php foreach ($allUsers as $user) : ?>
            <div>
                <strong style="font-size: 20px;"><?php echo fetchUser($user["email"])["name"] ?></strong>
                <a href="mailto:<?php echo fetchUser($user["email"])["email"] ?>"><?php echo fetchUser($user["email"])["email"] ?></a>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php if (count($allUsers) == 0) : ?>
    <div class="alert alert-warning">
        <strong>There are currently no users registered.</strong>
        <p style="margin: 0;">Click <a href="../registration.php" style="color: rgb(102, 77, 3);">here</a> to register.</p>
    </div>

<?php endif ?>
<?php include "../components/foot.php"; ?>