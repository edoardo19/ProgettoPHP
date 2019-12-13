<?php

declare(strict_types=1);

namespace SimpleMVC\Model;

use SimpleMVC\Model\DB\DBManagerUsers;

class Article
{
    public $ID;
    public $IDAUTHOR;
    public $TITLE;
    public $TITLEFORURL;
    public $CONTNENT;
    public $DATEOFSUBMIT;

    public function ContentPreview(): string{
        if(strlen($this->CONTNENT) <= 100)
            return $this->CONTNENT;
            
        return substr($this->CONTNENT, 0, 100) . '...';
    }
}