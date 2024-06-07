<?php include './includes/head.php'; ?>

<?php require './classes/Database.php'; ?>
<?php require './classes/UsersDB.php'; ?>
<?php require './classes/ParenthoodDB.php'; ?>
<?php require './classes/HomeworksDB.php'; ?>
<?php require './classes/AssignmentsDB.php'; ?>

<?php 
$dbCon = DatabaseConnection::getInstance();
?>

<p><?php $dbCon->printConnectionCredentials(); ?></p>
<!-- <p><?php phpinfo(); ?></p> -->

<?php
$usersDB = new UsersDB();
// $newUserData = [
//     'role' => 'student', 
//     'first_name' => 'Aaa',
//     'last_name' => 'Bbb',
//     'email' => 'aaa.bbb@example.com',
//     'date_of_birth' => '2000-01-15'
// ];
// $usersDB->create($newUserData);
$usersDB->find("1");
// $updateUserData = [
//     'user_id' => 13,
//     'role' => 'teacher',
//     'first_name' => 'Jane',
//     'middle_name' => 'B.',
//     'last_name' => 'Doe',
//     'email' => 'jane.doe@example.com',
//     'date_of_birth' => '1985-05-15'
// ];
// $usersDB->update($updateUserData);
$usersDB->delete(10);
$usersDB->delete(15);
echo("<br>");
// $parenthoodDB = new ParenthoodDB();
// $parenthoodDB->create("createtest");
// $parenthoodDB->find("findtest");
// $parenthoodDB->update("updatetest");
// $parenthoodDB->delete("deletetest");
// echo("<br>");
// $homeworksDB = new HomeworksDB();
// $homeworksDB->create("createtest");
// $homeworksDB->find("findtest");
// $homeworksDB->update("updatetest");
// $homeworksDB->delete("deletetest");
// echo("<br>");
// $assignmentsDB = new AssignmentsDB();
// $assignmentsDB->create("createtest");
// $assignmentsDB->find("findtest");
// $assignmentsDB->update("updatetest");
// $assignmentsDB->delete("deletetest");
// echo("<br>");
?>

<?php include './includes/foot.php'; ?>
