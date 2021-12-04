<?php


namespace Modulo;


use Exception;
use MysqliDb;
use Tela\Tela;

class Modulo
{
    public $id        = 2;
    public $nome      = "Bem vindo";
    public $descricao = "Página inicial do sistema após autenticação";
    public $diretorio = "app";
    public $arquivo   = "app.php";
    public $url;

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

            $db->where("diretorio", $this->diretorio);
            $consulta = $db->getOne('modulos');
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

    public function Tela(){
        try{

            return new Tela();

        }catch (Exception $e){
            return $e;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getDiretorio(): string
    {
        return $this->diretorio;
    }

    /**
     * @param string $diretorio
     */
    public function setDiretorio(string $diretorio): void
    {
        $this->diretorio = $diretorio;
    }

    /**
     * @return string
     */
    public function getArquivo(): string
    {
        return $this->arquivo;
    }

    /**
     * @param string $arquivo
     */
    public function setArquivo(string $arquivo): void
    {
        $this->arquivo = $arquivo;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }




}