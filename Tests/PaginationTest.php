<?php 

namespace Pagination\Tests;

use Pagination\Pagination;

class PaginationTest extends \PHPUnit_Framework_TestCase {

	protected $_pagination;

    protected function setUp()
    {
        $totalResults = 100;
		$recordsPerPage = 10;
		$this->_pagination = new Pagination($totalResults,$recordsPerPage);
    }

	public function testInstanceOfPagination() 
	{
		$this->assertInstanceOf(Pagination::class, $this->_pagination);
	}

	public function testTypeOfPage()
    {
        $this->assertInternalType('integer', $this->_pagination->getPage());
    }

	public function testRecordsPerPage()
    {
        $this->assertInternalType('integer', $this->_pagination->getRecordsPerPage());
    }

	public function testTotalOfResults()
    {
        $this->assertInternalType('integer', $this->_pagination->getTotalOfResults());
    }

    /**
     * @expectedException LengthException
     */
	public function testExceptionForZeroInTotal()
	{
		new Pagination(0,10);
	}

	/**
     * @expectedException LengthException
     */
	public function testExceptionForZeroInPerPage()
	{
		new Pagination(100,0);
	}

	/**
     * @expectedException LengthException
     */
	public function testExceptionForPerPageLargeThanTotal()
	{
		new Pagination(5,10);
	}	
}