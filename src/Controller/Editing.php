<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerArticles;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Editing implements ControllerInterface
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
        echo $this->plates -> render('userArticles', [
            'userArticles' => $this->dbma->GetAllUserArticles($_SESSION['username'])
        ]);
    }
}