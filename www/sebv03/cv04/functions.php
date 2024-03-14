<?php
function fetchUsers() : array
{
    $users = [];
    $file = fopen("./users.db", "r");
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
function fetchUser(string $email)
{
    $users = fetchUsers();
    if (isset($users[$email])) {
        return $users[$email];
    }
    return null;
}
function registerNewUser(string $email, string $name, string $password)
{
    $users = fetchUsers();
    if(isset($users[$_POST['email']])){
        return(false);
    }
    $file = fopen("./users.db", "a");
    fputcsv($file, [$email, $name, $password]);
    fclose($file);
    mail($email, 'Registration succesful', 'Thank you for registering');
    return(true);
}
function authenticate($email, $password)
{
    $users = fetchUsers();
    if (isset($users[$email])) {
        if ($users[$email]['password'] === $password) {
            return true;
        }
    }
    return false;
}
?>