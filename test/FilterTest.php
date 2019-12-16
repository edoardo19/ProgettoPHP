<?php

declare(strict_types=1);

namespace SimpleMVC\Test;
use DI\ContainerBuilder;

use PHPUnit\Framework\TestCase;
//require __DIR__ . "/../src/Filter.php";

use SimpleMVC\Filter;

class FilterTest extends TestCase
{

    protected $container;

    public function setUp() : void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__ . '/../config/container.php');
        $this->container = $builder->build();
    }

/*------TestUsers-------*/
    public function testValidLogin()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertTrue($filter->IsValidLoginParameters('Leo', '1234'));
    }
    public function testInvalidLogin()
    {    
        $filter = $this -> container -> get(Filter::Class);
        $this->assertFalse($filter->IsValidLoginParameters('Leo', '134'));
    }
    public function testEmptyUsernameByTitle()
    {    
        $filter = $this -> container -> get(Filter::Class);
        $this->assertTrue($filter->IsEmptyUsernameByTitle('Prova'));
    }
    public function testNotEmptyUsernameByTitle()
    {    
        $filter = $this -> container -> get(Filter::Class);
        $this->assertFalse($filter->IsEmptyUsernameByTitle('Prov'));
    }
    public function testGetUserByName()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertTrue($filter->GetUserByName('Leo'));
    }
    public function testNotGetUserByName()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertFalse($filter->GetUserByName('Edo'));
    }

  /*------TesArticles-------*/
    public function testGetDailyArticles()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertTrue($filter->GetDailyArticles());
    }
    public function testNotGetDailyArticles()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertFalse($filter->GetDailyArticles());
    }
    public function testGetAllUserArticles()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertTrue($filter->GetAllUserArticles('Leo'));
    }
    public function testNotGetAllUserArticles()
    {
        $filter = $this -> container -> get(Filter::Class);
        $this->assertFalse($filter->GetAllUserArticles('Edo'));
    }
}
