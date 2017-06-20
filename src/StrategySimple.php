<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategySimple implements StrategyPaginationInterface {

    private $_totalIndexes;

    public function __construct(int $totalIndexes) {
        $this->_totalIndexes = $totalIndexes;
        $this->checkTotalIndexesValue();
    }

    public function getIndexes(Pagination $pagination) {

        if($pagination->getTotalOfPages() > $this->_totalIndexes) {
            $currentIndex = (int) $pagination->getPage() - 1;
            $pause = ($pagination->getTotalOfPages() - $this->_totalIndexes);

            if($pagination->getPage() > $pause)
            $currentIndex = $pause;

            $indexes = array_slice(
                $pagination->getAllIndexesOfPages()->getArrayCopy(), 
                $currentIndex, 
                $this->_totalIndexes
            );
        } else {
            $indexes = $pagination->getAllIndexesOfPages()->getArrayCopy();
        }
        return new \ArrayObject($indexes);
    }

    protected function checkTotalIndexesValue() {
        if ( $this->_totalIndexes <= 0 )
        throw new \LengthException("Total indexes must be greater than zero!");
    }
}
