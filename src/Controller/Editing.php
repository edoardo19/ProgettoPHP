<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use SimpleMVC\Model\DB\DBManagerArticles;
use SimpleMVC\Model\DB\DBManagerUsers;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Editing implements ControllerInterface
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
        if(isset($_POST['username']) && isset($_POST['password'])){
            if($this->dbmu->IsValidLoginParameters($_POST['username'], $_POST['password'])){
                echo $this->plates -> render('userArticles', [
                    'userArticles' => $this->dbma->GetAllUserArticles($_POST['username'])
                ]);
                return;
            }
        }

        header('Location: Login');
    }
}