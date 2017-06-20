<?php 
declare(strict_types = 1);
namespace Pagination\Tests;
use Pagination\Pagination;
use Pagination\StrategySimple;

class PaginationTest extends \PHPUnit_Framework_TestCase {

	protected $_pagination;

    protected function setUp()
    {
        $totalResults = 100;
		$recordsPerPage = 10;
		$page = 1;
		$this->_pagination = new Pagination($totalResults, $recordsPerPage, $page);
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
		new Pagination(0,10,1);
	}

	/**
     * @expectedException LengthException
     */
	public function testExceptionForZeroInPerPage()
	{
		new Pagination(100,0,1);
	}

	

	public function testTotalOfPagesType()
    {
        $this->assertInternalType('integer', $this->_pagination->getTotalOfPages());
    }

	public function testTotalOfPages()
    {
        $this->assertEquals(10, $this->_pagination->getTotalOfPages());
    }

	public function testIndexesOfPagesIsArrayObject()
    {
        $this->assertInstanceOf('ArrayObject', $this->_pagination->getAllIndexesOfPages());
    }

	public function testIndexesOfPagesIsGreaterThanZero()
    {
        $this->assertCount(10, $this->_pagination->getAllIndexesOfPages());
    }

	public function testFirstPage()
    {
        $this->assertEquals(1, $this->_pagination->getFirstPage());
    }

	public function testLastPage()
    {
        $this->assertEquals(10, $this->_pagination->getLastPage());
    }

	public function testNextPage()
    {
        $this->assertEquals(2, $this->_pagination->getNextPage());
    }

	public function testPreviousPage()
    {
        $this->assertEquals(1, $this->_pagination->getPreviousPage());
    }

	public function testGo()
    {
        $this->assertEquals($this->_pagination->getLastPage(), $this->_pagination->goTo(190));
    }

	public function testBack()
    {
        $this->assertEquals(1, $this->_pagination->goBack(190));
    }

    public function testTotalOfResultsIsOne()
    {
        $pagination = new Pagination(1,10,1);
        $this->assertEquals(1, $pagination->getAllIndexesOfPages()->count());
    }

	public function testPageIsGreaterOfTotalOfPages()
    {
        $pagination = new Pagination(100,10,1000);
		$this->assertEquals($pagination->getTotalOfPages(), $pagination->getPage());
    }

	/**
     * @expectedException LengthException
     */
    public function testSimpleTotalIndexValue()
    {
        $simple = new StrategySimple(0);
    }

	public function testSimpleIndexes()
	{
		$pagination = new Pagination(1,10,1);
        $indexes = $pagination->getIndexes(new StrategySimple(20));
        $this->assertEquals($pagination->getAllIndexesOfPages()->count(), $indexes->count());
	}

}