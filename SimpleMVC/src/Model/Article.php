<?php

declare(strict_types=1);

class Article
{
    public $ID;
    public $Title;
    public $Content;
    public $Author;
    public $Data;

    public function ContentPreview(): string{
        return substr($this->Content, 0, 100) . '...';
    }
}