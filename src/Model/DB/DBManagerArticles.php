<?php

declare(strict_types=1);

namespace SimpleMVC\Model\DB;

use PDO;
use SimpleMVC\Model\Article;

class DBManagerArticles
{
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function GetDailyArticles(): array
    {
        $thisDate = date("Y-m-d H:i:s");
        $newDate = date("Y-m-d H:i:s", strtotime('-1 day', strtotime($thisDate)));

        $sql = 'SELECT * FROM articles WHERE DATEOFSUBMIT > :NewDate ORDER BY DATEOFSUBMIT';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':NewDate' => $newDate]);
        return $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function GetArticle($titleforurl): Article
    {
        $sql = 'SELECT * FROM articles WHERE TITLEFORURL = :t';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':t' => $titleforurl]);
        $result = $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
        return $result[0];
    }

    public function GetAllUserArticles($User): array
    {
        $sql = 'SELECT * FROM articles as a INNER JOIN users as u ON a.IDAUTHOR = u.ID WHERE u.NAME = :UserName ORDER BY DATEOFSUBMIT';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        return $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function AddArticle($Article, $userId): void
    {
        $sql = 'INSERT INTO articles(IDAUTHOR, TITLE, CONTNENT, DATEOFSUBMIT) VALUES (:IDAUTHOR, :TITLE, :CONTNENT, :DATEOFSUBMIT)';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            ':IDAUTHOR' => $userId,
            ':TITLE' => $Article->Title,
            ':CONTNENT' => $Article->Contnent,
            ':DATEOFSUBMIT' => $Article->Data
        ]);
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
        $sth->execute([
            ':NewTitle' => $NewArticle->Title,
            ':NewContnent' => $NewArticle->Contnent,
            ':ArticleID' => $ArticleID
        ]);
    }
}