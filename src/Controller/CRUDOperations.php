<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use SimpleMVC\Model\DB\DBManagerArticles;
use SimpleMVC\Model\DB\DBManagerUsers;
use SimpleMVC\Model\Article;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class CRUDOperations implements ControllerInterface
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
            case 'Create new article':
                echo $this->plates -> render('createNewArticle', ['warning' => false]);
                break;
            case 'Create':
                if($_POST['title'] == "" || $_POST['content'] == ""){
                    echo $this->plates -> render('createNewArticle', ['warning' => true]);
                    break;
                }
                $this->CreateArticle();
                header('Location: Editing');
                break;
            case 'Update':
                $this->UpdateArticle();
                header('Location: Editing');
                break;
            case 'Delete':
                $this->DeleteArticle();
                header('Location: Editing');
                break;
            default:
                header('Location: Editing');
                break;
        }
    }

    private function CreateArticle()
    {
        $article = new Article;

        $article->IDAUTHOR = $this->GetUserName();
        $article->TITLE = $_POST['title'];
        $article->CONTNENT = $_POST['content'];
        $article->DATEOFSUBMIT = date("Y-m-d H:i:s");

        if($this->TitleConflict())
            $article->TITLEFORURL = $this->GetTitleForUrl($_POST['title'])."-".$this->GenerateRandomString();
        else
            $article->TITLEFORURL = $this->GetTitleForUrl($_POST['title']);

        $this->dbma->AddArticle($article);
    }

    private function TitleConflict()
    {
        $res = $this->dbma->GetArticle($this->GetTitleForUrl($_POST['title']));
        return sizeof($res) > 0;
    }

    private function UpdateArticle()
    {
        $this->dbma->UpdateArticle($_GET['title'], $_POST['title'], $this->GetTitleForUrl($_POST['title']), $_POST['content'], isset($_POST['updateDate']));
    }

    private function DeleteArticle()
    {
        $this->dbma->RemoveArticle($_GET['id']);
    }

    private function GetUserName()
    {
        return $this->dbmu->GetUserID($_SESSION['username']);
    }

    private function GetTitleForUrl($title): string
    {
        $TitleForUrl = str_replace(' ', '-', $title);
        $TitleForUrl = strtolower($TitleForUrl);
        $TitleForUrl = preg_replace('/[^a-z0-9\-]/', '', $TitleForUrl);
        return $TitleForUrl != "" ? $TitleForUrl : $this->GenerateRandomString();
    }

    private function GenerateRandomString($length = 20): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}