<?php
use SimpleMVC\Controller;


return [
    'GET /' => Controller\Home::class, // "SimpleMVC\Controller\Home"
    'GET /Article' => Controller\Article::class,
    'GET /Login' => Controller\Login::class,
    'POST /Editing' => Controller\Editing::class,
    'GET /EditArticle' => Controller\EditArticle::class,
    'POST /CRUDOperations' => Controller\CRUDOperations::class
];
