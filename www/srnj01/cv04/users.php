<?php
require('./utils/db.php');

const DB_FILE = './users.db';
$users = fetchUsers(DB_FILE);

if (isset($_GET['delete'])) {
  deleteLine(DB_FILE, $_GET['delete']);
  header('Location: ' . explode('?', $_SERVER['REQUEST_URI'])[0]);
}

include('./includes/header.php') ?>
<div class="m-4 mx-auto w-fit max-w-full overflow-x-hidden p-4">
  <h2 class="text-xl bold max-w-fit mb-4">Uživatelé</h2>
  <div class="mx-auto overflow-x-scroll">
    <table class="max-w-96 border-collapse border-2 border-green">
      <thead>
        <tr>
          <th class="border-2 border-green pl-2 pr-2">Id</th>
          <th class="border-2 border-green pl-2 pr-2">Name</th>
          <th class="border-2 border-green pl-2 pr-2">Email</th>
          <th class="border-2 border-green pl-2 pr-2">Password Hash</th>
          <th class="border-2 border-green pl-2 pr-2">Phone</th>
          <th class="border-2 border-green pl-2 pr-2">Avatar</th>
          <th class="border-2 border-green pl-2 pr-2">Gender</th>
          <th class="border-2 border-green pl-2 pr-2">Deck</th>
          <th class="border-2 border-green pl-2 pr-2">Cards</th>
          <th class="border-2 border-green pl-2 pr-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($users)) {
          foreach ($users as $user) {
            echo '<tr>';
            foreach ($user as $value) {
              if (filter_var($value, FILTER_VALIDATE_URL)) {
                echo '<td class="border-2 border-green"><img src="' . $value . '" class="h-8 w-8 m-auto rounded-full" alt="avatar"></td>';
                continue;
              }
              echo '<td class="border-2 border-green pl-2 pr-2 whitespace-nowrap">' . $value . '</td>';
            }
            echo '<td class="border-2 border-green pl-2 pr-2"><a href="./users.php?delete=' . $user['id'] . '">Delete</a></td>';
            echo '</tr>';
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php include('./includes/footer.php') ?>