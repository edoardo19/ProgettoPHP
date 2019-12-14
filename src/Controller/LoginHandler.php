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
                    if($this->IsAdmin($_SESSION['username']))
                    {
                        $_SESSION['admin'] = true;
                        header('Location: AdminManager');
                        return;
                    }
                    $_SESSION['admin'] = false;
                    header('Location: Editing');
                return;
            }
        }

        header('Location: Login');
    }

    private function IsAdmin($username): bool
    {
        $user = $this->dbmu->GetUserByName($username);
        if($user[0]['ROLE'] == 'admin')
            return true;

        return false;
    }
}