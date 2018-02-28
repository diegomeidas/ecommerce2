<?php

namespace Hcode;
use Rain\Tpl;

class Page{

    private $tpl;   //atributo privado para as outras classes não terem acesso
    private $options = [];
    private $defaults = [
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "/views/")
    {
        //merge
        $this->options = array_merge($this->defaults, $opts);

        // configura o template
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
            "debug"         => false
        );

        Tpl::configure($config);
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        $this->tpl->draw("header");
    }

    private function setData($data = array())
    {
        foreach ($data as $key => $value){
            $this->tpl->assign($key, $value);
        }
    }

    //CORPO DA PAGINA
    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($name, $returnHTML);
    }


    public function __destruct()
    {
        $this->tpl->draw("footer");
    }
}



?>