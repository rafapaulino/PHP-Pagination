<?php
namespace Pagination;

interface StrategyPaginationInterface {
    public function __construct(int $totalIndexes);
    public function getIndexes(Pagination $pagination);
}