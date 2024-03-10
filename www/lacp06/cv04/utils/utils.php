<?php

function readFileContent($filePath)
{
  $fileContent = file_get_contents($filePath);
  return $fileContent;
}

function appendFileContent($filePath, $data)
{
  file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}

function fetchUser($filePath, $email)
{
  $fileContent = file_get_contents($filePath);
  $lines = explode(PHP_EOL, $fileContent);
  for ($i = 0; $i < count($lines); $i++) {
    $line = $lines[$i];
    $fields = explode(";", $line);
    if (!empty($fields[1])) {
      if ($fields[1] == $email) {
        $user = [
          "name" => $fields[0],
          "email" => $fields[1],
          "gender" => $fields[2],
          "phone" => $fields[3],
          "avatar" => $fields[4],
          "password" => $fields[5]
        ];
        return $user;
      }
    } else {
      return null;
    }
  }
  return null;
}

function fetchUsers($filePath)
{
  $userData = readFileContent($filePath);
  $userLines = explode(PHP_EOL, $userData);

  $users = [];

  for ($i = 0; $i < count($userLines); $i++) {
    if (empty(trim($userLines[$i]))) {
      continue;
    }
    $fields = explode(";", $userLines[$i]);
    $user = ["email" => $fields[1]];
    array_push($users, $user);
  }
  return $users;
}

function fetchDatabase($filePath)
{
  $userData = readFileContent($filePath);
  $userLines = explode(PHP_EOL, $userData);

  $users = [];

  for ($i = 0; $i < count($userLines); $i++) {
    if (empty(trim($userLines[$i]))) {
      continue;
    }
    $fields = explode(";", $userLines[$i]);
    $user = [$fields[1] => [
      "name" => $fields[0],
      "email" => $fields[1],
      "gender" => $fields[2],
      "phone" => $fields[3],
      "avatar" => $fields[4]
    ]];
    array_push($users, $user);
  }
  return $users;
}
function registerNewUser($filePath, $name, $email, $gender, $phone, $avatar, $password)
{
  $succes = true;
  $users = fetchUsers($filePath);
  for ($i = 0; $i < count($users); $i++) {
    if ($users[$i]["email"] == $email) {
      $succes = false;
    }
  }
  if ($succes == true) {
    $userRecord = implode(
      ";",
      [$name, $email, $gender, $phone, $avatar, password_hash($password, PASSWORD_DEFAULT)]
    );
    appendFileContent("./users.db", $userRecord);
    return true;
  } else {
    return false;
  }
}

function authenticate($email, $password, $filePath)
{

  $user = fetchUser($filePath, $email);
  if ($user) {
    if (password_verify($password, $user["password"])) {
      return true;
    } else {
      return "Wrong password!";
    }
  } else {
    return "Account doesnt exits!";
  }
}
