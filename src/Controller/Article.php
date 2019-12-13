<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use SimpleMVC\Model\DB\DBManagerArticles;
use SimpleMVC\Model\DB\DBManagerUsers;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Article implements ControllerInterface
{
    protected $plates;
    protected $dbma;
    protected $dbmu;

    public function __construct(Engine $plates, DBManagerArticles $dbma, DBManagerUsers $dbmu)
    {
        $this->plates = $plates;
        $this->dbma = $dbma;
        $this->dbmu = $dbmu;
    }

    public function execute(ServerRequestInterface $request)
    {
        echo $this->plates -> render('article', [
            'article' => $this->dbma->GetArticle($_GET['title']),
            'authorName' => $this->dbmu->GetUsernameByTitle($_GET['title'])
        ]); 
    }
}