<?php

require 'vendor/autoload.php';

use PostgreSQLTutorial\Connection;
use PostgreSQLTutorial\PGSQLCreateTable;
include ("./app/userDB.php");

try {
    $pdo = Connection::get()->connect();
    $tableCreator = new PGSQLCreateTable($pdo);
    $tables = $tableCreator->createTables(); 
    echo 'A connection to the PostgreSQL database sever has been established successfully.';
} catch (\PDOException $e) {
    echo $e->getMessage();
}

// Добавление юзера в бд
$name = 'Сергей';
$lastname = 'Тихонин';
$age = 21;
$description = 'Студент МИИГАиК';
$userDB = new UserDB($pdo);
$id = $userDB->insertUser($name, $lastname, $age, $description);
echo $id;

//Получение всех юзеров из бд
$userDB = new UserDB($pdo);
$users = $userDB->getUsers();
foreach ($users as $row) {
    echo '<p>'.$row['name'].' '.$row['lastname'].' '.$row['age'].' '.$row['description'].'</p>';
}

?>