<?php

declare(strict_types=1);

namespace SimpleMVC\Model;

class Article
{
    public $ID;
    public $IDAUTHOR;
    public $TITLE;
    public $CONTNENT;
    public $DATEOFSUBMIT;

    public function ContentPreview(): string{
        if(strlen($this->CONTNENT) <= 100)
            return $this->CONTNENT . '...';
            
        return substr($this->CONTNENT, 0, 100) . '...';
    }
}