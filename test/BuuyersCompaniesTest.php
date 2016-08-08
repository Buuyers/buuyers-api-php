<?php

namespace Buuyers;

use Buuyers\BuuyersCompanies;
use PHPUnit\Framework\TestCase;

class BuuyersCompaniesTest extends TestCase
{

    public function testGetCompany()
    {
        $stub = $this->getMockBuilder('Buuyers\BuuyersClient')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $company = new BuuyersCompanies($stub);
        $this->assertEquals('foo', $company->getCompany(1));
    }

}