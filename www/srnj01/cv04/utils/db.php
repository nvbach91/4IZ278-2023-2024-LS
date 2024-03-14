<?php

function getUserLines($fileName)
{
  if (file_exists($fileName)) {
    $fileContents = file_get_contents($fileName);
    return explode(PHP_EOL, $fileContents);
  }
  return [];
}

function deleteLine($fileName, $id)
{
  $fileContents = file_get_contents($fileName);
  $users = explode(PHP_EOL, $fileContents);
  $users = array_filter($users, function ($user) use ($id) {
    return explode(';', $user)[0] !== $id;
  });
  file_put_contents($fileName, implode(PHP_EOL, $users));
}

function addUser($fileName, $user)
{
  file_put_contents($fileName, PHP_EOL . $user, FILE_APPEND);
}

function fetchUsers($fileName)
{
  $users = getUserLines($fileName);
  $users = array_map(function ($user) {
    $user = explode(';', $user);
    return [
      'id' => $user[0],
      'name' => $user[1],
      'email' => $user[2],
      'password' => $user[3],
      'phone' => $user[4],
      'avatar' => $user[5],
      'gender' => $user[6],
      'deck' => $user[7],
      'cards' => $user[8],
    ];
  }, $users);
  return $users;
}

function fetchUser($fileName, $email)
{
  $users = fetchUsers($fileName);
  $found = array_filter($users, function ($user) use ($email) {
    return $user['email'] === $email;
  });
  return $found ? array_values($found)[0] : null;
}

function getNextId($fileName)
{
  $users = fetchUsers($fileName);
  return $users ? $users[count($users) - 1]['id'] + 1 : 0;
}
