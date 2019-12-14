<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerArticles;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class EditArticle implements ControllerInterface
{
    protected $plates;
    protected $dbma;

    public function __construct(Engine $plates, DBManagerArticles $dbma)
    {
        $this->plates = $plates;
        $this->dbma = $dbma;
    }

    public function execute(ServerRequestInterface $request)
    {
        if(!isset($_SESSION['username']))
            header('Location: Login');

        echo $this->plates -> render('editArticle', [
            'article' => $this->dbma->GetArticle($_GET['title'])
        ]); 
    }
}