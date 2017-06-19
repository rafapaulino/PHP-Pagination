<?php
error_reporting(E_ALL);
require 'vendor/autoload.php';
use Pagination\Pagination;
use Pagination\StrategySimple;

echo '<pre>';
$pagination = new Pagination(1000, 10, 1);
//echo $pagination->getTotalOfPages();
//var_dump($pagination->getIndexesOfPages());

//echo $pagination->getNextPage();
//echo $pagination->getPreviousPage();
//var_dump($pagination);
//debug_print_backtrace();

$simple = new StrategySimple($pagination);
$indexes = $simple->getIndexes();
var_dump($indexes);
var_dump($simple);
debug_print_backtrace();
echo '</pre>';