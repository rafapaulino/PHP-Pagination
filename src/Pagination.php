<?php

namespace Pagination;

class Pagination {

    protected $_page;
    protected $_recordsPerPage;
    protected $_totalOfResults;
    protected $_totalOfPages;
    protected $_indexesOfPages;
    protected $_firstPage;
    protected $_lastPage;
    protected $_nextPage;
    protected $_previousPage;
    protected $_startForSqlQueries;

    public function __construct( int $totalOfResults, int $recordsPerPage, int $page ) {
        $this->setPage($page);
        $this->setTotalOfResults($totalOfResults);
        $this->setRecordsPerPage($recordsPerPage);
        $this->checkIfTotalIsGreaterThanZero();
        $this->checkIfRecordsIsGreaterThanZero();
        $this->setTotalOfPages();
        $this->checkIfPageIsGreaterThanTotalOfPages();
        $this->setAllIndexesOfPages();
        $this->setFirstPage();
        $this->setLastPage();
        $this->setNextPage();
        $this->setPreviousPage();
        $this->setStartForSqlQueries();
    }

    public function getPage(): int {
        return $this->_page;
    }

    protected function setPage(int $page) {
        if ($page <= 1) 
        $page = 1;

        $this->_page = $page;
    }

    public function getRecordsPerPage(): int {
        return $this->_recordsPerPage;
    }

    protected function setRecordsPerPage(int $recordsPerPage) {
        $this->_recordsPerPage = $recordsPerPage;
    }

    public function getTotalOfResults(): int {
        return $this->_totalOfResults;
    }
    
    protected function setTotalOfResults(int $totalOfResults) {
        $this->_totalOfResults = $totalOfResults;
    } 

    protected function checkIfTotalIsGreaterThanZero() {
        if ( $this->getTotalOfResults() <= 0 )
        throw new \LengthException("Total results must be greater than zero!");
    } 

    protected function checkIfRecordsIsGreaterThanZero() {
        if ( $this->getRecordsPerPage() <= 0 )
        throw new \LengthException("Results per page must be greater than zero!");
    } 

    /*
     * Check If page passed is bigger than total of pages
     * If page is bigger, so page is equal of total of pages
    */
    protected function checkIfPageIsGreaterThanTotalOfPages() {
        if ( $this->getTotalOfPages() < $this->getPage() )
        $this->setPage($this->getTotalOfPages());
    }

    public function getTotalOfPages(): int {
        return $this->_totalOfPages;
    }
    
    protected function setTotalOfPages() {
        $this->_totalOfPages = (int) ceil( $this->getTotalOfResults() / $this->getRecordsPerPage() );
    }   

    public function getAllIndexesOfPages(): \ArrayObject {
        return $this->_indexesOfPages;
    }
    
    protected function setAllIndexesOfPages() {
        $indexes = range(1, $this->getTotalOfPages());
        $this->_indexesOfPages = new \ArrayObject($indexes);
    }

    public function getFirstPage(): int {
        return $this->_firstPage;
    }

    public function setFirstPage() {
        $this->_firstPage = 1;
    }

    public function getLastPage(): int {
        return $this->_lastPage;
    }

    public function setLastPage() {
        $this->_lastPage = $this->getTotalOfPages();
    }

    public function getNextPage(): int {
        return $this->_nextPage;
    }

    public function setNextPage() {
        $nextPage = $this->getPage() + 1;
				   
		if($nextPage >= $this->getTotalOfPages())
		$nextPage = $this->getTotalOfPages();
        
        $this->_nextPage = (int) $nextPage;
    }

    public function getPreviousPage(): int {
        return $this->_previousPage;
    }

    public function setPreviousPage() {
        $prevPage = $this->getPage() - 1;
				   
		if($prevPage <= 1)
		$prevPage = 1;
        
        $this->_previousPage = (int) $prevPage;
    }

    public function getStartForSqlQueries(): int {
        return $this->_startForSqlQueries;
    }

    protected function setStartForSqlQueries() {
        $this->_startForSqlQueries = intval($this->getPage() - 1) * $this->getRecordsPerPage();
    }

    public function goTo(int $page): int {
        $go = (int) $this->getPage() + $page;

        if($go >= $this->getTotalOfPages())
        $go = $this->getTotalOfPages();

        return $go;
    }

    public function goBack(int $page): int {
        $back = (int) $this->getPage() - $page;

        if($back <= 1)
        $back = 1;

        return $back;
    }

    public function getIndexes($type) {
        return $type->getIndexes($this);
    }
}