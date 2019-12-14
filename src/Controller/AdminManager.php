<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerUsers;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class AdminManager implements ControllerInterface
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
        if(!$_SESSION['admin'])
            header('Location: Login');
            
        echo $this->plates -> render('adminManager',[
            'users' => $this->dbmu->GetAllUsers($_SESSION['username']),
            'adminName' => $_SESSION['username'],
            'adminID' => $this->dbmu->GetUserID($_SESSION['username'])
        ]);
    }
}