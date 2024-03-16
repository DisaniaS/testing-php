<?php

require 'webroot/vendor/autoload.php';

use PostgreSQLTutorial\Connection;
use PostgreSQLTutorial\PGSQLCreateTable;

include ("./webroot/app/Users.php");


// Вызов создания таблиц в базе данных
// try {
//     $pdo = Connection::get()->connect();
//     $tableCreator = new PGSQLCreateTable($pdo);
//     $tables = $tableCreator->createTableUsers();
//     $tables = $tableCreator->createTablePosts();  

    

//     echo 'A connection to the PostgreSQL database sever has been established successfully.';
// } catch (\PDOException $e) {
//     echo $e->getMessage();
// }


// Функция для обработки GET-запроса users
function handleGetUsersRequest() {
    $userDB = new Users(Connection::get()->connect());
    $users = $userDB->getUsers();
    header('Content-Type: application/json');
    echo json_encode($users);
}

// Функция для обработки GET-запроса user by id
function handleGetUserByIdRequest($id) {
    $userDB = new Users(Connection::get()->connect());
    $user = $userDB->getUserById($id);
    header('Content-Type: application/json');
    echo json_encode($user);
}

// Функция для обработки POST-запроса users
function handlePostUsersRequest($userData) {
    $userDB = new Users(Connection::get()->connect());
    $userDB->createUser($userData);
    echo json_encode(array("status" => "success", "message" => "User created successfully."));
}

// Функция для обработки PUTCH-запроса users
function handlePatchUsersRequest($id, $userData) {
    $userDB = new Users(Connection::get()->connect());
    $userDB->updateUser($id, $userData);
    echo json_encode(array("status" => "success", "message" => "User updated successfully."));
}

// Функция для обработки DELETE-запроса users
function handleDeleteUsersRequest($id) {
    $userDB = new Users(Connection::get()->connect());
    $userDB->deleteUser($id);
    echo json_encode(array("status" => "success", "message" => "User deleted successfully."));
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['resource'])) {
        $resource = $_GET['resource'];
        if ($resource === 'users') {
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                handleGetUserByIdRequest($id);
            } else {
                handleGetUsersRequest();
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['resource'])) {
        $resource = $_GET['resource'];
        if ($resource === 'users') {
            $data = json_decode(file_get_contents('php://input'), true);
            if(isset($data['name'])&&isset($data['lastname'])&&isset($data['age'])&&isset($data['description'])) {
                handlePostUsersRequest($data);
            } else {
                echo "Please provide all parameters.";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    if (isset($_GET['resource'])) {
        $resource = $_GET['resource'];
        if ($resource === 'users') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($_GET['id'])&&isset($data['name'])&&isset($data['lastname'])&&isset($data['age'])&&isset($data['description'])) {
                $id = (int)$_GET['id'];
                handlePatchUsersRequest($id, $data);
            } else {
                echo "Please provide all parameters.";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['resource'])) {
        $resource = $_GET['resource'];
        if ($resource === 'users') {
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                handleDeleteUsersRequest($id);
            } else {
                echo "Please provide id parameter.";
            }
        }
    }
}






















// // Обработка POST запроса
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $data = json_decode(file_get_contents('php://input'), true);

//     if(isset($data) {
//         $name = $data['name'];
//         $lastname = $data['lastname'];
//         $age = $data['name'];
//         $description = $data['description'];
//         $users = new Users($pdo);
//         // Добавление юзера в бд
//         $id = $users->insertUser($data);
//         echo $id.' '.$name.' '.$lastname.' '.$age.' '.$description;
//     } else {
//         echo "Please provide all parameters.";
//     }
// }


// //Получение всех юзеров из бд
// $users = new Users($pdo);
// $users = $users->getUsers();
// foreach ($users as $row) {
//     echo '<p>'.$row['name'].' '.$row['lastname'].' '.$row['age'].' '.$row['description'].'</p>';
// }
// // Обработка GET запроса
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if(isset($_GET['name'])) {
//         $name = $_GET['name'];
//         echo "Hello, $name!";
//     } else {
//         echo "Please provide a name parameter.";
//     }
// }



?>