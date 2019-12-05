<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use SimpleMVC\Model\DB\DBManagerArticles;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Article implements ControllerInterface
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
        try {
            echo $this->plates -> render('article', [
                'article' => $this->dbma->GetArticle($_GET['title'])
            ]);
        } catch (\Throwable $th) {
            echo $this->plates -> render('404');
        } 
    }
}