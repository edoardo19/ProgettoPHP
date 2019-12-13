<?php

declare(strict_types=1);

namespace SimpleMVC\Controller;

session_start();

use Psr\Http\Message\ServerRequestInterface;

class Logout implements ControllerInterface
{
    protected $plates;

    public function __construct(){}

    public function execute(ServerRequestInterface $request)
    {
        session_unset();
        session_destroy();
        header('Location: /');
    }
}