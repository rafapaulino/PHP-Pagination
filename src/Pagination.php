<?php

namespace Pagination;

class Pagination {

    protected $_page;
    protected $_recordsPerPage;
    protected $_totalOfResults;

    public function getPage(): int {
        return $this->_page;
    }

    public function setPage(int $page) {
        $this->_page = $page;
    }

    public function getRecordsPerPage(): int {
        return $this->_recordsPerPage;
    }

    public function setRecordsPerPage(int $recordsPerPage) {
        $this->_recordsPerPage = $recordsPerPage;
    }

    public function getTotalOfResults(): int {
        return $this->_totalOfResults;
    }
    
    public function setTotalOfResults(int $totalOfResults) {
        $this->_totalOfResults = $totalOfResults;
    }     
}