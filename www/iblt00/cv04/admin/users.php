<?php

require __DIR__ . '/../utils/utils.php';

$users = fetchUsers();

require __DIR__ . '/../includes/header.php';

?>

<main class=container>
    <h1>Available users</h1>
    <div class="container-flex-center border-rounded">
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
            </tr>
            <?php
            foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <?php echo $user['name']; ?>
                    </td>
                    <td>
                        <a href="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

<?php

require __DIR__ . '/../includes/footer.php';

?>