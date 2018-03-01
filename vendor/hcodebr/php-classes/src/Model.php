<?php

namespace Hcode;

class Model{
    //recebe os valores do usuario
    private $values = [];

    //METODO MAGICO PARA OS GET E SET
    public function __call($name, $args)
    {
        //para identificar se é 'set' ou 'get'
        $method = substr($name, 0, 3);
        //a partir do 3º elemento
        $fieldName = substr($name, 3, strlen($name));

        switch ($method)
        {
            //se for 'GET' retorna o fieldname
            case "get":
                return $this->values[$fieldName];
            break;
            //se for set
            case "set":
                $this->values[$fieldName] = $args[0];
            break;
        }
    }

    public function setData($data = array())
    {
        foreach ($data as $key=>$value){
            //$this->setValor(i)
            $this->{"set" . $key}($value);
        }

    }

    public function getValues()
    {
        return $this->values;
    }


}

?>