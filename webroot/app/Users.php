<?php 

class Users
{

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Код для получения всех пользователей из базы данных
    public function getUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    // Код для получения пользователя по его ID из базы данных
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // Код для создания нового пользователя в базе данных
    public function createUser($userData) {  
        $stmt = $this->pdo->prepare('INSERT INTO users(name, lastname, age, description) VALUES(:name, :lastname, :age, :description)');

        $stmt->bindValue(':name', $userData['name']);
        $stmt->bindValue(':lastname', $userData['lastname']);
        $stmt->bindValue(':age', $userData['age']);
        $stmt->bindValue(':description', $userData['description']);

        $stmt->execute();
        
        return $this->pdo->lastInsertId('users_id_seq');
    }

    // Код для обновления данных пользователя в базе данных
    public function updateUser($id, $userData) {
        $stmt = $this->pdo->prepare('UPDATE users SET name = :name, lastname = :lastname, age = :age, description = :description WHERE id = :id');

        $stmt->bindValue(':name', $userData['name']);
        $stmt->bindValue(':lastname', $userData['lastname']);
        $stmt->bindValue(':age', $userData['age']);
        $stmt->bindValue(':description', $userData['description']);
        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->rowCount();
    }

    // Код для удаления пользователя из базы данных
    public function deleteUser($id) {   
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount();
    }

}
?>