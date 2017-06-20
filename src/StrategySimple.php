<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategySimple implements StrategyPaginationInterface {

    private $_totalIndexes;

    public function __construct(int $totalIndexes = 10) {
        $this->_totalIndexes = $totalIndexes;
    }

    public function getIndexes(Pagination $pagination) {

        if($pagination->getTotalOfPages() > $this->_totalIndexes) {
            $_currentIndex = $pagination->getPage() - 1;
            $_pause = ($pagination->getTotalOfPages() - $this->_totalIndexes);

            if($pagination->getPage() > $_pause)
            $_currentIndex = $_pause;

            $indexes = array_slice(
                $pagination->getAllIndexesOfPages()->getArrayCopy(), 
                $_currentIndex, 
                $this->_totalIndexes
            );
        } else {
            $indexes = $pagination->getAllIndexesOfPages()->getArrayCopy();
        }
        return new \ArrayObject($indexes);
    }
}