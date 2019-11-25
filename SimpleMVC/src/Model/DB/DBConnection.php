<?php

declare(strict_types=1);

require 'DBManagerUsers.php';
require 'DBManagerArticles.php';

class DBConnection
{
    public $UsersManager;
    public $ArticlesManager;
    private $pdo;

    function __construct()
    {
        try {    
            $this->pdo = new SQLite3('../../../db/Jurnal.db');
            $this->UsersManager = new DBManagerUseres($this->pdo);
            $this->ArticlesManager = new DBManagerArticles($this->pdo);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }
    }
}