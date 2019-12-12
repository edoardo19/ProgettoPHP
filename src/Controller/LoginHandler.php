<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerUsers;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class LoginHandler implements ControllerInterface
{
    protected $plates;
    protected $dbmu;

    public function __construct(Engine $plates, DBManagerUsers $dbmu)
    {
        $this->plates = $plates;
        $this->dbmu = $dbmu;
    }

    public function execute(ServerRequestInterface $request)
    {
        if(isset($_POST['username']) && isset($_POST['password'])){
            if($this->dbmu->IsValidLoginParameters($_POST['username'], $_POST['password'])){
                $_SESSION['username'] = $_POST['username'];
                    header('Location: Editing');
                return;
            }
        }

        header('Location: Login');
    }
}