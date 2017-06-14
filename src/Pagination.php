<?php

namespace Pagination;

class Pagination {

    protected $_page;
    protected $_recordsPerPage;
    protected $_totalOfResults;

    public function __construct( int $totalOfResults, int $recordsPerPage ) {
        $this->setPage(1);
        $this->setTotalOfResults($totalOfResults);
        $this->setRecordsPerPage($recordsPerPage);
        $this->checkIfTotalIsGreaterThanZero();
        $this->checkIfRecordsIsGreaterThanZero();
        $this->checkIfTotalIsLargerThanPerPage();
    }

    public function getPage(): int {
        return $this->_page;
    }

    public function setPage(int $page) {
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
        throw new LengthException("Total results must be greater than zero!");
    } 

    protected function checkIfRecordsIsGreaterThanZero() {
        if ( $this->getRecordsPerPage() <= 0 )
        throw new LengthException("Results per page must be greater than zero!");
    } 

    protected function checkIfTotalIsLargerThanPerPage() {
        if ( $this->getTotalOfResults() < $this->getRecordsPerPage() )
        throw new LengthException("Total results must be greater than the number of results per page!");
    }   
}