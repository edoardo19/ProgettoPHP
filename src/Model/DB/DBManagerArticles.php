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

    public function GetDailyArticles()
    {
        $thisDate = date("Y-m-d H:i:s");
        $newDate = date("Y-m-d H:i:s", strtotime('-1 day', strtotime($thisDate)));

        $sql = 'SELECT * FROM articles WHERE DATEOFSUBMIT > ? ORDER BY DATEOFSUBMIT DESC';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$newDate]);
        return $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function GetArticle($titleForUrl)
    {
        $sql = 'SELECT * FROM articles WHERE TITLEFORURL = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$titleForUrl]);
        $result = $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
        return sizeof($result) > 0 ? $result[0] : $result;
    }

    public function GetAllUserArticles($user)
    {
        $sql = 'SELECT a.* FROM articles as a INNER JOIN users as u ON a.IDAUTHOR = u.ID WHERE u.NAME = ? ORDER BY DATEOFSUBMIT DESC';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$user]);
        return $sth->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function AddArticle($article): void
    {
        $sql = 'INSERT INTO articles (IDAUTHOR, TITLE, TITLEFORURL, CONTNENT, DATEOFSUBMIT) VALUES (?, ?, ?, ?, ?)';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([(string)$article->IDAUTHOR, (string)$article->TITLE, (string)$article->TITLEFORURL, (string)$article->CONTNENT, (string)$article->DATEOFSUBMIT]);
    }

    public function RemoveArticle($articleID): void
    {
        $sql = 'DELETE FROM articles WHERE ID = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$articleID]);
    }

    public function UpdateArticle($articleNameForUrl, $newTitle, $newTitleForUrl, $newContent, $updateDate): void
    {
        if(!$updateDate){
            $sql = 'UPDATE articles SET TITLE = ?, TITLEFORURL = ?, CONTNENT = ? WHERE TITLEFORURL = ?';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([$newTitle, $newTitleForUrl, $newContent, $articleNameForUrl]);
        }
        else{
            $sql = 'UPDATE articles SET TITLE = ?, TITLEFORURL = ?, CONTNENT = ?, DATEOFSUBMIT = ? WHERE TITLEFORURL = ?';
            $sth = $this->pdo->prepare($sql);
            $sth->execute([$newTitle,  $newTitleForUrl, $newContent, date("Y-m-d H:i:s"), $articleNameForUrl]);
        }
    }

    public function DeleteAllArticleOfAUser($userID){
        $sql = 'DELETE FROM articles WHERE IDAUTHOR = ?';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([$userID]);
    }
}