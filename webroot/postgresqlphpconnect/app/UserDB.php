<?php 


class UserDB
{

    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function insertUser($name, $lastname, $age, $description)
    {
        // подготовка запроса для добавления данных
        $sql = 'INSERT INTO users(name, lastname, age, description) VALUES(:name, :lastname, :age, :description)';
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':age', $age);
        $stmt->bindValue(':description', $description);
    
        $stmt->execute();
    
        // возврат полученного значения id
        return $this->pdo->lastInsertId('users_id_seq');
    }

    public function getUsers()
    {
        $sql = 'SELECT * FROM users';
        $stmt = $this->pdo->query($sql);
        return $stmt;
    }
}

?>