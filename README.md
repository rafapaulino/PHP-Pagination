# PHP Pagination

PHP paging class with 4 different page types:

- `Simple Pagination:` Creates a simple pagination similar to Google.
![simple](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/simple.png)
- `PHPBB Pagination:` Paging in the same style as the PHPBB CMS. In addition to the normal pages you have the markers with the last pages and home pages.
![phpbb](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/phpbb.png)
- `Jumping Pagination:` Paging where the markers "jump" after a certain value, for example: Every 10 page markers are displayed from 1 to 10 - 11 to 20 - 21 to 30 and so on.
![jumping](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/jumping.png)
- `Google Pagination:` PHP paging is the same as that used by Google to display search results.
![google](https://raw.githubusercontent.com/rafapaulino/PHP-Pagination/master/doc/google.png)

See the examples folder for using the class easily.


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

The output HTML is fully static and uses relative paths to the asset files, which are also copied into the output folder. This means that you could, for example, point a HTTP server at the output folder and be done with it or push the output folder to Amazon S3.

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


## Writing your own layout

`v2.0` makes it easier to get started with a custom layout via `--export`, which exports a built in layout as a starting point. Just pick a reasonable built in layout and start customizing. For example:

```sh
generate-md --export github --output ./my-layout
```

will export the `github` layout to `./my-layout`. To make use of your new layout:

```sh
generate-md --layout ./my-layout --input ./some-input --output ./output
```

If you look under `./my-layout`, you'll see that a layout folder consists of:

- `./page.html`, the template to use in the layout
- `./assets`, the assets folder to copy over to the output
- `./partials`, the [partials](#partials) directory
- `./helpers`, the [helpers](#helpers) directory

See the next few sections for more details for how these features work.

### Template Evaluation (page.html)

The [handlebars.js](https://github.com/wycats/handlebars.js) template language is used to evaluate both the template and the markdown.

Here is a list of all the built in features:

- `{{~> content}}`: renders the markdown content
- `{{asset 'asset-path'}}`: renders a specific asset path
- `{{~> toc}}`: renders the table of contents
- `{{title}}`: renders the title from the metadata section

Any metadata fields you have defined in the page's metadata section can be referenced in `page.html` by name. For example, `{{title}}` is replaced with the value of the `title` metadata field when the template is rendered.

You can include your own helpers and partials in your custom layout as shown below.

