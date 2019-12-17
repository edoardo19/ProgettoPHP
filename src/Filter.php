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
/*-------Test DBManagerArticles------*/

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
    
    public function GetUserByName($name)
    {
        $sql = 'SELECT * FROM users WHERE NAME = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$name]);
        $result = $sth->fetchAll();

        if(!empty($result))
                return true;

            return false;
        
    }
/*-------Test DBManagerArticles-------*/
    
    public function GetAllUserArticles($user)
    {
        $sql = 'SELECT a.* FROM articles as a INNER JOIN users as u ON a.IDAUTHOR = u.ID WHERE u.NAME = ? ORDER BY DATEOFSUBMIT DESC';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$user]);
        $result = $sth->fetchAll();
    
        if(!empty($result))
            return true;

        return false;
    }
}