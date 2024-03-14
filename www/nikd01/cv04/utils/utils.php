<?php
function fetchUsers($filename): array
{
    $users = [];
    $file = fopen($filename, 'r');

    if ($file) {
        while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
            if (count($line) > 1) { // Make sure the line has at least 2 elements
                $users[$line[1]] = [
                    'name' => $line[0],
                    'email' => $line[1],
                    'password' => $line[2]
                ];
            }
        }
        fclose($file);
    }

    return $users;
}

function fetchUser($filename, $email): ?array
{
    $file = fopen($filename, 'r');

    if ($file) {
        while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
            if (count($line) > 1 && $line[1] === $email) {
                fclose($file);
                return [
                    'name' => $line[0],
                    'email' => $line[1],
                    'password' => $line[2]
                ];
            }
        }
        fclose($file);
    }

    return null;
}

function registerNewUser($filename, $name, $email, $password)
{
    // Fetch all users
    $users = fetchUsers($filename);

    // Check if email already exists
    if (isset($users[$email])) {
        return 'Email already registered';
    }

    // Encrypt the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the user data as a CSV string
    $user_record = implode(";", [$name, $email, $hashed_password]) . PHP_EOL;

    // Append the user record to the file
    file_put_contents($filename, $user_record, FILE_APPEND);

    mail($email, 'Registration successful', "Thank you for registering with us!");

    // Return a success message
    return 'Registration successful';
}

function authenticate($filename, $email, $password)
{
    // Fetch the user by email
    $user = fetchUser($filename, $email);

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // The password is correct, return success message
        return ['success' => 'Login successful.'];
    } elseif ($user) {
        // The user exists but the password is incorrect, return error message
        return ['error' => 'Invalid password.'];
    } else {
        // No user found with that email, return error message
        return ['error' => 'User not found.'];
    }
}

