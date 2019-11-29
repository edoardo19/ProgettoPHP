<?php

declare(strict_types=1);

namespace SimpleMVC\Model;

class Article
{
    public $ID;
    public $Title;
    public $Content;
    public $Author;
    public $Data;

    public function ContentPreview(): string{
        if(sizeof($this->Content) <= 100)
            return $this->Content . '...';
            
        return substr($this->Content, 0, 100) . '...';
    }
}