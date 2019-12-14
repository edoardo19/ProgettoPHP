<?php

declare(strict_types=1);

namespace SimpleMVC\Model\DB;

use PDO;

class DBManagerUsers{
    
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function IsValidLoginParameters($User, $Password): bool
    {
        $sql = 'SELECT * FROM users WHERE NAME = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        if(!empty($result))
            if(password_verify($Password, $result[0]['PASSWORD']))
                return true;

        return false;
    }

    public function GetUserID($User)
    {
        $sql = 'SELECT ID FROM users WHERE NAME = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$User]);
        $result = $sth->fetchAll();

        return $result[0]['ID'];
    }

    public function GetUsernameByTitle($title)
    {
        $sql = 'SELECT u.NAME FROM users AS u INNER JOIN articles AS a ON a.IDAUTHOR = u.ID WHERE a.TITLEFORURL = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$title]);
        $result = $sth->fetchAll();

        return $result[0]['NAME'];
    }

    public function GetAllUsers($admin)
    {
        $sql = 'SELECT ID, NAME FROM users WHERE NAME != ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$admin]);
        $result = $sth->fetchAll();

        return $result;
    }

    public function GetUserByID($id)
    {
        $sql = 'SELECT * FROM users WHERE ID = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$id]);
        $result = $sth->fetchAll();

        return $result;
    }

    public function GetUserByName($name)
    {
        $sql = 'SELECT * FROM users WHERE NAME = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$name]);
        $result = $sth->fetchAll();

        return $result;
    }

    public function CreateNewUser(string $name, string $password, string $role)
    {
        $sql = 'INSERT INTO users (NAME, PASSWORD, ROLE) VALUES (?, ?, ?)';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$name, $password, $role]);
    }

    public function UpdateUser($id, $name, $password = "")
    {
        if($password == ""){
            $sql = 'UPDATE users SET NAME = ? WHERE ID = ?';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([$name, $id]);
        }
        else{
            $sql = 'UPDATE users SET NAME = ?, PASSWORD = ? WHERE ID = ?';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([$name, $password, $id]);
        }
    }

    public function DeleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE ID = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$id]);
    }
}