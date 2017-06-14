<?php 

namespace Pagination\Tests;

use Pagination\Pagination;

class PaginationTest extends \PHPUnit_Framework_TestCase {

	protected $_pagination;

    protected function setUp()
    {
        $this->_pagination = new Pagination;
    }

	public function testTrueIsTrue()
	{
	    $foo = true;
	    $this->assertTrue($foo);
	}

	public function testInstanceOfPagination() 
	{
		$this->assertInstanceOf(Pagination::class, $this->_pagination);
	}
	
}