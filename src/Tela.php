<?php


namespace Tela;


use Exception;
use MysqliDb;

class Tela
{
    public $id;
    public $id_modulo;
    public $nome;
    public $descricao;
    public $diretorio;
    public $arquivo;


    public function __construct()
    {
        return $this->IdentificaModulo();
    }

    public function Assign($vars = array())
    {
        if (is_object($vars)) {
            $this->Assign(get_object_vars($vars));
            return;
        }

        foreach ($vars as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function IdentificaModulo()
    {

        $db = MysqliDb::getInstance();

        try {

            $this->arquivo   = basename($_SERVER['SCRIPT_FILENAME']);
            $diretorio       = $this->cleanUp(explode("/", str_replace($this->arquivo, "", $_SERVER['PHP_SELF'])));
            $this->diretorio = $diretorio[0];

            $db->where("arquivo", $this->arquivo);
            $consulta = $db->getOne('telas');
            $this->Assign($consulta);


        } catch (Exception $e) {
            return $e;
        }
    }

    private function cleanUp($array)
    {
        $cleaned_array = array();
        foreach ($array as $key => $value) {
            $qpos = strpos($value, "?");
            if ($qpos !== false) {
                break;
            }
            if ($key != "" && $value != "") {
                $cleaned_array[] = $value;
            }
        }
        return $cleaned_array;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdModulo()
    {
        return $this->id_modulo;
    }

    /**
     * @param mixed $id_modulo
     */
    public function setIdModulo($id_modulo): void
    {
        $this->id_modulo = $id_modulo;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getDiretorio()
    {
        return $this->diretorio;
    }

    /**
     * @param mixed $diretorio
     */
    public function setDiretorio($diretorio): void
    {
        $this->diretorio = $diretorio;
    }

    /**
     * @return mixed
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * @param mixed $arquivo
     */
    public function setArquivo($arquivo): void
    {
        $this->arquivo = $arquivo;
    }



}