<?php

declare(strict_types=1);

namespace App\Test;

use PHPUnit\Framework\TestCase;
require __DIR__ . "/../src/Filter.php";

use App\Filter;

class FilterTest extends TestCase
{
    public function testValidLogin()
    {
        $filter = new Filter();
        $this->assertTrue($filter->IsValidLoginParameters($User, $Password));
    }

    public function testInvalidLogin()
    {
        $filter = new Filter();
        $this->assertFalse($filter->IsValidLoginParameters($User, $Password));
    }
}
