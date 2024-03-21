<?php
function fetchUsers() {
    $users = [];
    $file_path = __DIR__ . '/users.db';

    if (file_exists($file_path)) {
        $file = fopen($file_path, 'r');
        if ($file === false) {
            die('Error opening the file: ' . $file_path);
        }

        while (($line = fgets($file)) !== false) {
            $data = explode(';', trim($line));
            if (count($data) === 3) {
                $users[$data[1]] = [
                    'name' => $data[0],
                    'email' => $data[1],
                    'password' => $data[2]
                ];
            }
        }
        fclose($file);
    }

    return $users;
}

function fetchUser($email) {
    $users = fetchUsers();
    return $users[$email] ?? null;
}
?>