<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategySimple implements StrategyPaginationInterface {

    public function getIndexes(Pagination $pagination) {

        if($pagination->getTotalOfPages() > $pagination->getRecordsPerPage()) {
            $_currentIndex = $pagination->getPage() - 1;
            $_pause = ($pagination->getTotalOfPages() - $pagination->getRecordsPerPage());

            if($pagination->getPage() > $_pause)
            $_currentIndex = $_pause;
            $indexes = array_slice(
                $pagination->getIndexesOfPages()->getArrayCopy(), 
                $_currentIndex, 
                $pagination->getRecordsPerPage()
            );
        } else {
            $indexes = $pagination->getIndexesOfPages()->getArrayCopy();
        }
        return new \ArrayObject($indexes);
    }
}