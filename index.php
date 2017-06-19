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


interface OutputInterface
{
    public function load();
}

class SerializedArrayOutput implements OutputInterface
{
    public function load()
    {
        return serialize($arrayOfData);
    }
}

class JsonStringOutput implements OutputInterface
{
    public function load()
    {
        return json_encode($arrayOfData);
    }
}

class ArrayOutput implements OutputInterface
{
    public function load()
    {
        return $arrayOfData;
    }
}

class SomeClient
{
    private $output;

    public function setOutput(OutputInterface $outputType)
    {
        $this->output = $outputType;
    }

    public function loadOutput()
    {
        return $this->output->load();
    }
}

//http://br.phptherightway.com/pages/Design-Patterns.html
$client = new SomeClient();

// Quer um array?
$client->setOutput(new ArrayOutput());
$data = $client->loadOutput();
var_dump($data);

// Quer um JSON?
$client->setOutput(new JsonStringOutput());
$data = $client->loadOutput();
var_dump($data);