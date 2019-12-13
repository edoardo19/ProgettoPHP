<?php
use League\Plates\Engine;
use Psr\Container\ContainerInterface;

return [
    'view_path' => 'src/View',
    Engine::class => function(ContainerInterface $c) {
        return new Engine($c->get('view_path'));
    },
    'dsn' => 'sqlite:' . __DIR__ . '/../db/Jurnal.db',
    PDO::class => function(ContainerInterface $c) {
        return new PDO($c->get('dsn'));
    }
];
