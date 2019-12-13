<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

use SimpleMVC\Model\DB\DBManagerArticles;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Home implements ControllerInterface
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
        echo $this->plates -> render('home', [
            'articles' => $this->dbma->GetDailyArticles()
        ]);
    }
}
