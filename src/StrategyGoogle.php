<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategyGoogle implements StrategyPaginationInterface {

    private $_indexes;
    private $_additionalIndexes;

    public function __construct(int $indexes, int $additionalIndexes) {
        $this->_indexes = $indexes;
        $this->_additionalIndexes = $additionalIndexes;
        $this->checkIndexesValue();
        $this->checkAdditionalIndexesValue();
        $this->checkAdditionalIsBiggerIndexes();
    }

    public function getIndexes(Pagination $pagination) {

        if($pagination->getTotalOfPages() > $this->_indexes) {
            
            if($pagination->getPage() == 1) {
                $indexes = array_slice(
                    $pagination->getAllIndexesOfPages()->getArrayCopy(), 
                    0, 
                    $this->_indexes
                );
            } else {
                $currentIndex = (int) $pagination->getPage() - 1;
                $pause = ($pagination->getTotalOfPages() - $this->_indexes);
                $add = $currentIndex + $this->_additionalIndexes;

                if($this->_indexes > $add)
                $add = $this->_indexes;

                $half = (int) ceil( $add / 2 );

                if($this->_indexes % 2 == 0)
                $center = $half;
                else
                $center = intval($this->_indexes - $half);

                if($currentIndex > $center)
                $currentIndex = intval($currentIndex - $center);

                if($pagination->getPage() > $pause)
                $currentIndex = $pause;

                $indexes = array_slice(
                    $pagination->getAllIndexesOfPages()->getArrayCopy(), 
                    $currentIndex, 
                    $this->_indexes
                );
            }

        } else {
            $indexes = $pagination->getAllIndexesOfPages()->getArrayCopy();
        }
        return new \ArrayObject($indexes);
    }

    protected function checkIndexesValue() {
        if ( $this->_indexes <= 0 )
        throw new \LengthException("Indexes must be greater than zero!");
    }

    protected function checkAdditionalIndexesValue() {
        if ( $this->_additionalIndexes <= 0 )
        throw new \LengthException("Additional indexes must be greater than zero!");
    }

    protected function checkAdditionalIsBiggerIndexes() {
        if ( $this->_additionalIndexes > $this->_indexes )
        throw new \LengthException("Page indices should be greater than the value of the additional indices!");
    }
}
