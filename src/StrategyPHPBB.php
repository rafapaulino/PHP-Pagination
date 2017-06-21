<?php
namespace Pagination;
use Pagination\StrategyPaginationInterface;

class StrategyPHPBB implements StrategyPaginationInterface {

    private $_totalIndexes;
    private $_totalIndexesExtras;

    public function __construct(int $totalIndexes, int $totalIndexesExtras) {
        $this->_totalIndexes = $totalIndexes;
        $this->_totalIndexesExtras = $totalIndexesExtras;
        $this->checkTotalIndexesValue();
        $this->checkTotalIndexesExtrasValue();
    }

    public function getIndexes(Pagination $pagination) {

        $indexes['initial'] = array();
        $indexes['final'] = array();  

        if($pagination->getTotalOfPages() > $this->_totalIndexes) {
            
            $currentIndex = (int) $pagination->getPage() - 1;
            $pause = ($pagination->getTotalOfPages() - $this->_totalIndexes);
            $half = (int) ceil( $this->_totalIndexes / 2 ); 
            
            if($this->_totalIndexes % 2 == 0)
            $center = $half;
            else
            $center = intval($this->_totalIndexes - $half);
            
            if($currentIndex > $center)
            $currentIndex = intval($currentIndex - $center);
           
            if($pagination->getPage() > $pause)
            $currentIndex = $pause;
                     
            $indexes['indexes'] = array_slice(
                $pagination->getAllIndexesOfPages()->getArrayCopy(), 
                $currentIndex, 
                $this->_totalIndexes
            );

            if($pagination->getTotalOfPages() > ($this->_totalIndexes + ($this->_totalIndexesExtras * 2))) {
                $initialPart = ceil($pagination->getTotalOfPages() * 0.04);
                $startEnd = ($pagination->getTotalOfPages() - $this->_totalIndexesExtras);

                if(($currentIndex - 1)  > $this->_totalIndexesExtras && ($currentIndex - 1) > $initialPart) {
                    $indexes['initial'] = array_slice(
                        $pagination->getAllIndexesOfPages()->getArrayCopy(),
                        0,
                        $this->_totalIndexesExtras
                    );
                }

                if($pagination->getPage() < ($pagination->getTotalOfPages() - $this->_totalIndexes)) {
                    $indexes['final'] = array_slice(
                        $pagination->getAllIndexesOfPages()->getArrayCopy(),
                        $startEnd,
                        $this->_totalIndexesExtras
                    );
                }                
            } 

        } else {
            $indexes['indexes'] = $pagination->getAllIndexesOfPages()->getArrayCopy();
        }

        return (object) array(
            'indexes' => new \ArrayObject($indexes['indexes']),
            'initial' => new \ArrayObject($indexes['initial']),
            'final' => new \ArrayObject($indexes['final'])
        ); 
    }

    protected function checkTotalIndexesValue() {
        if ( $this->_totalIndexes <= 0 )
        throw new \LengthException("Total indexes must be greater than zero!");
    }

    protected function checkTotalIndexesExtrasValue() {
        if ( $this->_totalIndexesExtras <= 0 )
        throw new \LengthException("Total indexes Extras must be greater than zero!");
    }
}
