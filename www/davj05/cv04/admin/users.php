<?php

require "../functions.php";

$users = fetch_users("../users.db");
$view_dir = "../views/";
?>


<?php require $view_dir . "head.php"; ?>

<body>


<div>
        <ul class="users">
            <?php foreach ($users as $user_email => $user_data): ?>
            <li class="user">
                <div class="name"><?php echo $user_data["name"]; ?></div>
                <div class="email"><?php echo $user_email; ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
               


        
    </div>
</body>

<?php require $view_dir . "foot.php"; ?>