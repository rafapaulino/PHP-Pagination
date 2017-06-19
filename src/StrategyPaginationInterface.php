<?php
namespace Pagination;

interface StrategyPaginationInterface {
    public function __construct(Pagination $pagination);
    public function getIndexes();
}