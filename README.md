# PHP Pagination

PHP paging class with 4 different page types:

- `Simple Pagination:` Creates a simple pagination similar to Google.
![simple](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/simple.png)
- `PHPBB/Digg Pagination:` Paging in the same style as the PHPBB CMS/Digg. In addition to the normal pages you have the markers with the last pages and home pages.
![phpbb](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/phpbb.png)
- `Jumping Pagination:` Paging where the markers "jump" after a certain value, for example: Every 10 page markers are displayed from 1 to 10 - 11 to 20 - 21 to 30 and so on.
![jumping](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/jumping.png)
- `Google Pagination:` PHP paging is the same as that used by Google to display search results.
![google](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/google.png)

See the examples folder for using the class easily.

[![Latest Stable Version](https://poser.pugx.org/php-pagination/php-pagination/v/stable)](https://packagist.org/packages/php-pagination/php-pagination)
[![Total Downloads](https://poser.pugx.org/php-pagination/php-pagination/downloads)](https://packagist.org/packages/php-pagination/php-pagination)
[![Latest Unstable Version](https://poser.pugx.org/php-pagination/php-pagination/v/unstable)](https://packagist.org/packages/php-pagination/php-pagination)
[![Monthly Downloads](https://poser.pugx.org/php-pagination/php-pagination/d/monthly)](https://packagist.org/packages/php-pagination/php-pagination)

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SN4SZRSL5HPZU)

## Features

- `v2.0.0` The methods were refactored, unit tests added, examples and design patters.


### Important informations

- You need PHP 7.0 or higher to use this class.

- I used the strategy pattern to create different pagination types. I put the examples in the examples folder.
This pagination returns only one PHP ArrayObject, so you create the layout part as you wish.

- The pagination always returns the first page, last page, previous, next, an ArrayObject with total pages, 2 methods to advance or retreat a deternated number of pages and finally another ArrayObject with the markers following the paging style logic chosen.

- This is a free project, feel free to use it in your projects, even if they are commercial. You can also contribute tips, new features and fixes.

-----

## Example of use

To use this class you must follow the code below. Do not forget to access the [examples folder here in the repository](https://github.com/rafapaulino/PHP-Pagination/tree/master/examples) with the usage examples for each page type.
Also access [rafaacademy.com](http://rafaacademy.com/) for tips and tutorials on php and use of this class.

Install: composer require php-pagination/php-pagination

```php
<?php
require '../vendor/autoload.php';
use Pagination\Pagination;
use Pagination\StrategySimple;

if ( isset($_GET['page']) && is_numeric($_GET['page']) )
$page = $_GET['page'];
else 
$page = 1;

//use pagination class with results, per page and page
$pagination = new Pagination(1000, 10, $page);
//get first page
$pagination->getFirstPage();
//get last page
$pagination->getLastPage();
//get previous page
$pagination->getPreviousPage();
//get next page
$pagination->getNextPage();
//get all indexes
$all = $pagination->getAllIndexesOfPages();
$iteratorAll = $all->getIterator();
//get indexes in page stylized
$indexes = $pagination->getIndexes(new StrategySimple(15));
$iterator = $indexes->getIterator();
```
To navigate between indexes you need to learn how to work with the [ArrayInterator](http://php.net/manual/pt_BR/class.arrayiterator.php) and [ArrayObject](http://php.net/manual/pt_BR/class.arrayobject.php) of PHP.