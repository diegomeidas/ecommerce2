<?php 

require_once("vendor/autoload.php");

use Slim\Slim;
use Hcode\Page;

$app = new Slim();

$app->config('debug', true);



$app->get('/', function() {

    $page = new Page();         //nesse momento chama o 'header.html'
    $page->setTpl("index");     //chama o index.html
                                //ao final chama o destruct 'footer.html'
});

$app->run();

 ?>