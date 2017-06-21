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
//get indexes in page
$indexes = $pagination->getIndexes(new StrategySimple(15));
$iterator = $indexes->getIterator();

//get all indexes
$all = $pagination->getAllIndexesOfPages();
$iteratorAll = $all->getIterator();

include 'header.html';
?>
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>PHP Pagination Simple 
                <small>Page number: <?php echo $page; ?></small>
                <span class="label label-info"> Of total pages: <?php echo $pagination->getTotalOfPages(); ?></span>
            </h1>
        </div>
    </div>
</div>

<div class="row">
    <?php include 'menu.html'; ?>
    <div class="col-md-9">

        <div class="row">
            <div class="col-md-10">
                <p><strong>Example of Code:</strong></p>
                <pre class="brush: php; highlight: [5, 15]; html-script: true">
                    &#60;&#63;php
                    require '../vendor/autoload.php';
                    use Pagination\Pagination;
                    use Pagination\StrategySimple;

                    if ( isset($_GET['page']) && is_numeric($_GET['page']) )
                    $page = $_GET['page'];
                    else 
                    $page = 1;

                    //use pagination class with results, per page and page
                    $pagination = new Pagination(1000, 10, $page);
                    //get indexes in page
                    $indexes = $pagination->getIndexes(new StrategySimple(15));
                    $iterator = $indexes->getIterator();
                    //get first page
                    $pagination->getFirstPage();
                    //get last page
                    $pagination->getLastPage();
                    //get previous page
                    $pagination->getPreviousPage();
                    //get next page
                    $pagination->getNextPage();
                    &#63;&#62;                        
                </pre>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="?page=<?php echo $pagination->getFirstPage(); ?>" aria-label="First">
                                <span aria-hidden="true">First</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=<?php echo $pagination->getPreviousPage(); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php while ($iterator->valid()): ?>
                            <li>
                                <a href="?page=<?php echo $iterator->current() ?>">
                                    <?php echo $iterator->current() ?>
                                </a>
                            </li>
                        <?php $iterator->next(); endwhile; ?>
                        <li>
                            <a href="?page=<?php echo $pagination->getNextPage(); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li>
                            <a href="?page=<?php echo $pagination->getLastPage(); ?>" aria-label="Last">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <p><strong>More Itens:</strong></p>
                <hr >
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="total" class="col-sm-2 control-label">Pages:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="total">
                                <?php while ($iteratorAll->valid()): ?>
                                    <option value="?page=<?php echo $iteratorAll->current() ?>" <?php echo (($page == $iteratorAll->current())?'selected="selected"':''); ?>>
                                        GoTo Page: <?php echo $iteratorAll->current() ?>
                                    </option>
                                <?php $iteratorAll->next(); endwhile; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.html'; ?>