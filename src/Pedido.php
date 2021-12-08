<?php

namespace Pedido;

use Exception;
use MysqliDb;

class Pedido
{

    public $id;
    public $npedido;
    public $tipo = 'pronta_entrega';
    public $cliente;
    public $data_1;
    public $data_2;
    public $hora_1;
    public $hora_2;
    public $status;
    public $total;
    public $obs;

    public function __construct($id = false)
    {
        if ($id) {
            $this->Carregar($id);
        }
    }

    public function Carregar($codigo)
    {
        $db = MysqliDb::getInstance();
        try {

            $db->where("P.id", $codigo);
            $consulta = $db->getOne('pedido P', 'P.*');
            $this->Assign($consulta);

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Salvar()
    {
        $db = MysqliDb::getInstance();
        try {


            $valores = array_filter((array)$this, function ($value) {
                return !is_null($value) && $value !== '';
            });

            /**
             * Se for update
             **/
            if ($this->id) {

                $db->where("id", $this->id);
                $db->update('pedido', $valores);
                $this->Carregar($this->id);
                return $this->id;

            } /**
             * Senão realiza o novo cadastro
             **/
            else {

                $this->id = $db->insert('pedido', $valores);

                if ($this->id) {

                    $this->Carregar($this->id);

                    return $this->id;

                }

                return false;


            }


        } catch (Exception $e) {
            return false;
        }
    }

    public function Assign($vars = [])
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

    public function ListaPedidos($dados,$usuario = false)
    {

        $db = MysqliDb::getInstance();

        try {

            $pagelimite    = $dados['pageSize'] == null ? null : $dados['pageSize'];
            $pagina        = $dados['pageNumber'] == 0 ? 1 : $dados['pageNumber'];
            $db->pageLimit = $pagelimite;

            if (isset($dados['filter'])) {

                $filtro = json_decode($dados['filter'], true);

            }

            if (!empty($dados['searchText'])) {

                $db->where("P.npedido", "%" . trim($dados['searchText']) . "%", "LIKE");
                $db->orWhere("P.data_1", "%" . trim($dados['searchText']) . "%", "LIKE");

            }

            if (!empty($dados['sortName'])) {

                $prefix_tabela = "P.";



                $db->orderBy($prefix_tabela . $dados['sortName'], strtoupper($dados['sortOrder']));

            } else {

                $db->orderBy("P.data_1", "DESC");

            }

            $db->groupBy("P.id");

            $db->orderBy("P.data_1", "DESC");


            if($usuario) {
                $db->where("P.cliente", $usuario);
            }


            if (!isset($dados['pageSize'])) {
                $consulta = $db->get('pedido P', null,
                    "P.* ");
            } else {
                $consulta = $db->arraybuilder()->paginate(
                    'pedido P',
                    $pagina,
                    "  P.* ");
            }

            $retorno['rows']  = $consulta;
            $retorno['total'] = $db->totalCount;
            $retorno['dados'] = $dados;

            return $retorno;


        } catch (Exception $e) {
            return $e;
        }
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getNpedido()
    {
        return $this->npedido;
    }

    /**
     * @param mixed $npedido
     */
    public function setNpedido($npedido): void
    {
        $this->npedido = $npedido;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getData1()
    {
        return $this->data_1;
    }

    /**
     * @param mixed $data_1
     */
    public function setData1($data_1): void
    {
        $this->data_1 = $data_1;
    }

    /**
     * @return mixed
     */
    public function getData2()
    {
        return $this->data_2;
    }

    /**
     * @param mixed $data_2
     */
    public function setData2($data_2): void
    {
        $this->data_2 = $data_2;
    }

    /**
     * @return mixed
     */
    public function getHora1()
    {
        return $this->hora_1;
    }

    /**
     * @param mixed $hora_1
     */
    public function setHora1($hora_1): void
    {
        $this->hora_1 = $hora_1;
    }

    /**
     * @return mixed
     */
    public function getHora2()
    {
        return $this->hora_2;
    }

    /**
     * @param mixed $hora_2
     */
    public function setHora2($hora_2): void
    {
        $this->hora_2 = $hora_2;
    }

    /**
     * @return mixed
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param mixed $obs
     */
    public function setObs($obs): void
    {
        $this->obs = $obs;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }


}