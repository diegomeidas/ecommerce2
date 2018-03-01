<?php 
//INICIA O USO DE SESSÕES
session_start();

require_once("vendor/autoload.php");



use Slim\Slim;
use Hcode\Page;
use Hcode\PageAdmin;
use Hcode\Model\User;

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
        //verifica se usuario esta logado
        User::verifyLogin();

        $page = new PageAdmin();
        $page->setTpl("index");
    });


    //ROTA PARA LOGIN ADM
    $app->get('/admin/login', function(){

        $page = new PageAdmin([
            "header"=>false,
            "footer"=>false
        ]);
        $page->setTpl('login');
    });

    $app->post('/admin/login', function (){

        //
        User::login($_POST["login"], $_POST["password"]);
        //direciona
        header("Location: /admin");
        exit;
    });


    //ROTA PARA LOGOUT
    $app->get('/admin/logout', function (){

        User::logout();

        header("Location: /admin/login");
        exit;
    });




    $app->run();

?>