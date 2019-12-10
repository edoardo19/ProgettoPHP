<?php
declare(strict_types=1);

namespace App;

namespace SimpleMVC\Model\DB;

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
       $sql = 'SELECT * FROM users WHERE name = :UserName';
       $sth = $this->pdo->prepare($sql);
       $sth->execute([':UserName' => $User]);
       $result = $sth->fetchAll();

       if(!empty($result))
           if(password_verify($Password, $result[0]['PASSWORD']))
               return true;

       return false;
   }

}