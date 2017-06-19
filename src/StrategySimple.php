<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategySimple implements StrategyPaginationInterface {

    private $_pagination;

    public function __construct(Pagination $pagination) {
        $this->_pagination = $pagination;
    }

    public function getIndexes() {

        if($this->_pagination->getTotalOfPages() > $this->_pagination->getRecordsPerPage()) {
            $_currentIndex = $this->_pagination->getPage() - 1;
            $_pause = ($this->_pagination->getTotalOfPages() - $this->_pagination->getRecordsPerPage());

            if($this->_pagination->getPage() > $_pause)
            $_currentIndex = $_pause;
            $indexes = array_slice(
                $this->_pagination->getIndexesOfPages()->getArrayCopy(), 
                $_currentIndex, 
                $this->_pagination->getRecordsPerPage()
            );
        } else {
            $indexes = $this->_pagination->getIndexesOfPages()->getArrayCopy();
        }
        return new \ArrayObject($indexes);
    }
}