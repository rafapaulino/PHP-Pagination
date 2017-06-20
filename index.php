<?php
require 'vendor/autoload.php';
use Pagination\Pagination;
use Pagination\StrategySimple;

echo '<pre>';
$pagination = new Pagination(1000, 10, 1);
//echo $pagination->getTotalOfPages();
//var_dump($pagination->getAllIndexesOfPages());
//echo $pagination->getNextPage();
//echo $pagination->getPreviousPage();
var_dump($pagination);
//debug_print_backtrace();

$indexes = $pagination->getIndexes(new StrategySimple(20));


var_dump($indexes);
debug_print_backtrace();
echo '</pre>';