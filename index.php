<?php 

require_once("vendor/autoload.php");


use Slim\Slim;
use Hcode\Page;
use Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);


    //ROTA INDEX DO SITE
    $app->get('/', function() {

        $page = new Page();         //nesse momento chama o 'header.html'
        $page->setTpl("index");     //chama o index.html
        //ao final chama o destruct 'footer.html'
    });



    //ROTA DO ADMIN
    $app->get('/admin', function() {

        $page = new PageAdmin();
        $page->setTpl("index");
    });

    $app->run();

?>