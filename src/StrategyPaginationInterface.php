<?php
namespace Pagination;

interface StrategyPaginationInterface {
    public function getIndexes(Pagination $pagination);
}