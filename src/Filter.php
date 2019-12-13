<?php
declare(strict_types=1);
//namespace App;

namespace SimpleMVC;

use PDO;

class Filter 
{
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
    public function IsEmptyUsernameByTitle($title) : bool
    {
        $sql = 'SELECT u.NAME FROM users AS u INNER JOIN articles AS a ON a.IDAUTHOR = u.ID WHERE a.TITLEFORURL = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$title]);
        $result = $sth->fetchAll();

        if(!empty($result))
                return true;

            return false;
        }

}