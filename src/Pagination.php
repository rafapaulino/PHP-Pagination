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
    }

    public function getPage(): int {
        return $this->_page;
    }

    protected function setPage(int $page) {
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
}