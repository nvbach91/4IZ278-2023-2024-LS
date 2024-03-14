<?php

require __DIR__ . '/../config/config.php';

//register new user
function registerNewUser($newUser)
{
    if (!fetchUserByEmail($newUser['email'])) {
        $dbConn = fopen(DB_USERS, 'a');
        fputcsv($dbConn, $newUser, DELIMITER);
        fclose($dbConn);
        return 'success';
    } else {
        return null;
    }
}


//fetch users
function fetchUsers()
{
    $users = [];

    //read file users.db
    $dbConn = fopen(DB_USERS, 'r');

    //read the file line by line until reaching the EOF
    while (($data = fgetcsv($dbConn, 200, ',')) != FALSE) {
        //insert only not NULL lines into array users
        if ($data[0] != NULL) {
            $users[$data[1]] = [
                'name' => $data[0],
                'email' => $data[1],
                'password' => $data[2],
            ];
        }
    }
    fclose($dbConn);

    //return array of users with email as a key
    return $users;
};

//fetch user by email
function fetchUserByEmail($email)
{
    //read file users.db
    $dbConn = fopen(DB_USERS, 'r');

    //read the file line by line until reaching the EOF
    while (($data = fgetcsv($dbConn, 200, ',')) != FALSE) {
        //return data if user is found (triple '=' = value and data type must match / exact match)
        if ($data[1] === $email) {
            return [
                'name' => $data[0],
                'email' => $data[1],
                'password' => $data[2],
            ];
            break;
        }
    }
    fclose($dbConn);
};

//authenticate user
function authenticateUser($user)
{
    //check if return value is NULL
    if (!fetchUserByEmail($user['email'])) {
    } else {
        //generate fetched user and compare with user that wants to login
        $fetchedUser = fetchUserByEmail($user['email']);
        if ($user['email'] === $fetchedUser['email'] && $user['password'] === $fetchedUser['password']) {
            return 'success';
        }
    }
};


//send email announcement about successful registration
function sendEmailConfirmation($user)
{
    $webLoginLink = 'https://eso.vse.cz/~iblt00/lab04/login.php';
    global $headers;
    mail($user['email'], "Successful registration at iblt00's PHP sandbox N.04", '<h2>Thank you ' . $user['name'] . ' for registering<h2>' . '<p> You can now sign up at this super fancy <a href=' . $webLoginLink . '>Login Page</a>', $headers);
}
