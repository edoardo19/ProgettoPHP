<?php

declare(strict_types=1);
require 'DBManagerUsers.php';

class DBManagerArticles
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function GetDailyArticles(): array
    {
        $thisDate = date("Y-m-d H:i:s");
        $newDate = $thisDate->strtotime('-1 day', strtotime($thisDate));

        $sql = 'SELECT * FROM articles WHERE DATEOFSUBMIT > :NewDate ORDER BY DATEOFSUBMIT';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':NewDate' => $newDate]);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function GetAllUserArticles($User): array
    {
        $sql = 'SELECT * FROM articles as a INNER JOIN users as u ON a.IDAUTHOR = u.ID WHERE u.NAME = :UserName ORDER BY DATEOFSUBMIT';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        return $sth->fetchAll();
    }

    public function AddArticle($Article): void
    {
        $DBMU = new DBManagerUseres($this->pdo);
        $userId = $DBMU->GetUserID($Article->Author);

        $sql = 'INSERT INTO articles(IDAUTHOR, TITLE, CONTNENT, DATEOFSUBMIT) VALUES (:IDAUTHOR, :TITLE, :CONTNENT, :DATEOFSUBMIT)';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':IDAUTHOR' => $userId]);
        $sth->execute([':TITLE' => $Article->Title]);
        $sth->execute([':CONTNENT' => $Article->Contnent]);
        $sth->execute([':DATEOFSUBMIT' => $Article->Data]);
    }

    public function RemoveArticle($ArticleID): void
    {
        $sql = 'DELETE FROM articles WHERE ID = :id';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':id' => $ArticleID]);
    }

    public function UpdateArticle($ArticleID, $NewArticle): void
    {
        $sql = 'UPDATE article SET TITLE = :NewTitle, CONTNENT = :NewContnent WHERE ID = :ArticleID';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':NewTitle' => $NewArticle->Title]);
        $sth->execute([':NewContnent' => $NewArticle->Contnent]);
        $sth->execute([':ArticleID' => $ArticleID]);
    }
}