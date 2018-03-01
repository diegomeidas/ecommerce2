<?php

namespace Hcode\Model;

use Hcode\DB\Sql;
use Rain\Tpl\Exception;
use Hcode\Model;

class User extends Model{

    const SESSION = "User";

    public static function login($login, $password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_user WHERE deslogin = :login ", [
            ":login"=>$login
        ]);
        if(count($results) === 0)
            throw new Exception("Usuário inexistente.");

        //verifica a senha
        $data = $results[0];
        if(password_verify($password, $data["despassword"]) === true){

            $user = new User();
            //chama metodo magico
            $user->setData($data);

            //cria uma sessão que recebe os dados do usuario
            $_SESSION[User::SESSION] = $user->getValues();

            return $user;

        }else
            throw new Exception("Senha inválida.");

    }

    public static function verifyLogin($inadmin = true)
    {
        if(
            !isset($_SESSION[User::SESSION])    //se não exixtir uma sessão
            || !$_SESSION[User::SESSION]        //ou se esta vazia
            || (int)$_SESSION[User::SESSION]["iduser"] > 0    //se o id for maior que 0
            || (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin //se pode acessar a administração
        ){
            header("Location: /admin/login");
            exit;
        }
    }

    public static function logout()
    {
        //session_unset();
        $_SESSION[User::SESSION] = NULL;
    }
}

?>