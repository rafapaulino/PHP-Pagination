<?php
require 'vendor/autoload.php';
use Pagination\Pagination;

echo '<pre>';
$pagination = new Pagination(100,10);
//echo $pagination->getTotalOfPages();
//var_dump($pagination->getIndexesOfPages());

//echo $pagination->getNextPage();
//echo $pagination->getPreviousPage();
var_dump($pagination);
debug_print_backtrace();

echo '</pre>';