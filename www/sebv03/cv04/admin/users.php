<?php
include '../includes/head.php';
function fetchUsers() : array
{
    $users = [];
    $file = fopen("../users.db", "r");
    while (($data = fgetcsv($file)) !== FALSE) {
        if (isset($data[0])) {
            $users[$data[0]] = [
                'name' => $data[1],
                'password' => $data[2],
            ];
        }
    }
    fclose($file);
    return $users;
}
$users = fetchUsers();
?>
<div class="container mx-auto">
    <h1 class="text-3xl font-bold">Users</h1>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $email => $user) : ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo $email; ?></td>
                    <td class="border px-4 py-2"><?php echo $user['name']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php
include '../includes/foot.php';
?>