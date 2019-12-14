<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerArticles;
use SimpleMVC\Model\DB\DBManagerUsers;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class AdminManagerOperations implements ControllerInterface
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
        if(!isset($_SESSION['username']))
            header('Location: Login');

        switch ($_POST['operation']) {
    /*================================== CREATE NEW USER ========================================*/ 
            case 'Create new user':
                echo $this->plates -> render('createNewUser', ['warning' => false]);
                break;
    /*================================== CREATE ========================================*/ 
            case 'Create':
                if($this->BadText($_POST['name'])){
                    echo $this->plates -> render('createNewUser', [
                        'warning' => true,
                        'message' => 'Username is empty'
                    ]);
                    break;
                }

                if($this->BadText($_POST['password']) || $this->BadText($_POST['password2'])){
                    if($_POST['password'] != $_POST['password2']){
                        echo $this->plates -> render('createNewUser', [
                            'warning' => true,
                            'message' => 'Password not match'
                        ]);
                        break;
                    }
                    echo $this->plates -> render('createNewUser', [
                        'warning' => true,
                        'message' => 'Password not set'
                    ]);
                    break;
                }

                $taskComplited = $this->CreateUser();

                if($taskComplited){
                    header('Location: AdminManager');
                    break;
                }

                echo $this->plates -> render('createNewUser', [
                    'warning' => true,
                    'message' => 'User already exist'
                ]);
                break;
    /*================================== UPDATE ========================================*/ 
            case 'Update':
                if($_POST['password'] != $_POST['password2']){
                    echo $this->plates -> render('editUser', [
                        'warning' => true,
                        'message' => 'Password not match',
                        'user' => $this->dbmu->GetUserByID($_POST['id'])
                    ]);
                    break;
                }

                $taskComplited = $this->UpdateUser();

                if($taskComplited){
                    if($_SESSION['username'] == $_POST['author'])
                        $_SESSION['username'] = $_POST['name'];
                    header('Location: AdminManager');
                    break;
                }

                echo $this->plates -> render('editUser', [
                    'warning' => true,
                    'message' => 'Name not set',
                    'user' => $this->dbmu->GetUserByID($_POST['id'])
                ]);
                break;
    /*================================== DELETE ========================================*/ 
            case 'Delete':
                $this->DeleteUser();
                header('Location: AdminManager');
                break;
            default:
                header('Location: AdminManager');
                break;
        }
    }

    private function CreateUser(): bool
    {
        if($this->UserAlreadyExist()){
            return false;
        }

        $role = isset($_POST['adminRole']) ? 'admin' : 'editor';
        $this->dbmu->CreateNewUser($_POST['name'], password_hash($_POST['password'], PASSWORD_DEFAULT), $role);
        return true;
    }

    private function UserAlreadyExist(): bool
    {
        if(sizeof($this->dbmu->GetUserID($_POST['name'])) > 0)
            return true;
        
        return false;
    }

    private function UpdateUser(): bool
    {
        if($_POST['id'] == "" || $_POST['name'] == "")
            return false;

        if($_POST['password'] == "")
            $this->dbmu->UpdateUser($_POST['id'], $_POST['name']);
        else
            $this->dbmu->UpdateUser($_POST['id'], $_POST['name'], password_hash($_POST['password'], PASSWORD_DEFAULT));
        
        return true;
    }

    private function DeleteUser(){
        $this->dbma->DeleteAllArticleOfAUser($_POST['id']);
        $this->dbmu->DeleteUser($_POST['id']);
    }
    
    private function BadText($text): bool
    {
        return str_replace(" ", "", $text) == "" ? true : false;
    }
}