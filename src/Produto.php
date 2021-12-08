<?php

namespace Produto;

use Exception;
use MysqliDb;

class Produto
{

    //produtos
    public $id;
    public $codigo_referencia; // artigo
    public $codigo_familia; // código mãe
    public $data_lancamento; // data de lançamento do produto
    public $data_encerramento; // data corte do produto
    public $color; // cores disponiveis
    public $categoria; // categoria
    public $segmentacao; // categoria
    public $divisao; //
    public $genero; //
    public $tipo = 'pronta_entrega';
    public $nome;
    public $descricao;
    public $quantidade;
    public $valor_venda;
    public $valor_custo;
    public $valor_promocional;
    public $tamanhos;
    public $foto = 'https://via.placeholder.com/250x250';
    public $thumb;
    public $fotos;

    public $datahora;
    public $usuario_importacao;
    public $lote;

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

            $db->where("U.id", $codigo);
            //$db->join("grupos G", "G.id = U.grupo", "INNER");
            $consulta = $db->getOne('produtos U', 'U.*');
            $this->Assign($consulta);

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Salvar()
    {
        $db = MysqliDb::getInstance();
        try {

            unset($this->grupo_nome);

            $valores = array_filter((array)$this, function ($value) {
                return !is_null($value) && $value !== '';
            });

            /**
             * Se for update
             **/
            if ($this->id) {

                $db->where("id", $this->id);
                $db->update('produtos', $valores);
                $this->Carregar($this->id);
                return $this->id;

            } /**
             * Senão realiza o novo cadastro
             **/
            else {

                $this->id = $db->insert('produtos', $valores);

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

    public function ListarProdutos($dados)
    {
        $db = MysqliDb::getInstance();
        try {

            $data = [
                [
                    'id'          => 1,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 119.03,
                    'nome'        => 'Produto A'
                ],
                [
                    'id'          => 2,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 215.03,
                    'nome'        => 'Produto B'
                ],
                [
                    'id'          => 3,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 1415.03,
                    'nome'        => 'Produto C'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
                [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ], [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ], [
                    'id'          => 4,
                    'descricao'   => 'Produto descricao',
                    'valor_venda' => 19.03,
                    'nome'        => 'Produto D'
                ],
            ];

            //$data = array_flip(preg_grep($dados['procura'], array_flip($data)));

            $db->groupBy("U.nome");
            $db->where("U.tipo", $this->getTipo());
            //$db->join("grupos G", "G.id = U.grupo", "INNER");
            $consulta = $db->get('produtos U', 200,'U.*');

            return $consulta;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Card()
    {
        try {


            ob_start();
            ?>
            <div class="col-sm-2">
                <a href="../loja/produto.php?i=<?php echo $this->getId(); ?>&q=<?php echo $this->getTipo(); ?>" class="text-decoration-none">
                    <div class="card shadow-sm mb-2">
                        <img src="<?php echo $this->getFoto(); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="small">
                                <?php
                                echo $this->getNome();
                                ?>
                            </p>

                            <h6 class="text-info">PDV R$
                                <?php
                                echo formataValorBR($this->getValorVenda());
                                ?>
                            </h6>

                        </div>
                    </div>
                </a>
            </div>
            <?php
            $retorno = trim(ob_get_contents());
            ob_end_clean();

            return $retorno;


        } catch (Exception $e) {

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
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @return mixed
     */
    public function getCodigoReferencia()
    {
        return $this->codigo_referencia;
    }

    /**
     * @param mixed $codigo_referencia
     */
    public function setCodigoReferencia($codigo_referencia): void
    {
        $this->codigo_referencia = $codigo_referencia;
    }

    /**
     * @return mixed
     */
    public function getCodigoFamilia()
    {
        return $this->codigo_familia;
    }

    /**
     * @param mixed $codigo_familia
     */
    public function setCodigoFamilia($codigo_familia): void
    {
        $this->codigo_familia = $codigo_familia;
    }

    /**
     * @return mixed
     */
    public function getDataLancamento()
    {
        return $this->data_lancamento;
    }

    /**
     * @param mixed $data_lancamento
     */
    public function setDataLancamento($data_lancamento): void
    {
        $this->data_lancamento = $data_lancamento;
    }

    /**
     * @return mixed
     */
    public function getDataEncerramento()
    {
        return $this->data_encerramento;
    }

    /**
     * @param mixed $data_encerramento
     */
    public function setDataEncerramento($data_encerramento): void
    {
        $this->data_encerramento = $data_encerramento;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getSegmentacao()
    {
        return $this->segmentacao;
    }

    /**
     * @param mixed $segmentacao
     */
    public function setSegmentacao($segmentacao): void
    {
        $this->segmentacao = $segmentacao;
    }

    /**
     * @return mixed
     */
    public function getDivisao()
    {
        return $this->divisao;
    }

    /**
     * @param mixed $divisao
     */
    public function setDivisao($divisao): void
    {
        $this->divisao = $divisao;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero): void
    {
        $this->genero = $genero;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
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
    public function getValorVenda()
    {
        return $this->valor_venda;
    }

    /**
     * @param mixed $valor_venda
     */
    public function setValorVenda($valor_venda): void
    {
        $this->valor_venda = $valor_venda;
    }

    /**
     * @return mixed
     */
    public function getValorCusto()
    {
        return $this->valor_custo;
    }

    /**
     * @param mixed $valor_custo
     */
    public function setValorCusto($valor_custo): void
    {
        $this->valor_custo = $valor_custo;
    }

    /**
     * @return mixed
     */
    public function getValorPromocional()
    {
        return $this->valor_promocional;
    }

    /**
     * @param mixed $valor_promocional
     */
    public function setValorPromocional($valor_promocional): void
    {
        $this->valor_promocional = $valor_promocional;
    }

    /**
     * @return mixed
     */
    public function getTamanhos()
    {
        return $this->tamanhos;
    }

    /**
     * @param mixed $tamanhos
     */
    public function setTamanhos($tamanhos): void
    {
        $this->tamanhos = $tamanhos;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param mixed $thumb
     */
    public function setThumb($thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * @return mixed
     */
    public function getFotos()
    {
        return $this->fotos;
    }

    /**
     * @param mixed $fotos
     */
    public function setFotos($fotos): void
    {
        $this->fotos = $fotos;
    }

    /**
     * @return mixed
     */
    public function getDatahora()
    {
        return $this->datahora;
    }

    /**
     * @param mixed $datahora
     */
    public function setDatahora($datahora): void
    {
        $this->datahora = $datahora;
    }

    /**
     * @return mixed
     */
    public function getUsuarioImportacao()
    {
        return $this->usuario_importacao;
    }

    /**
     * @param mixed $usuario_importacao
     */
    public function setUsuarioImportacao($usuario_importacao): void
    {
        $this->usuario_importacao = $usuario_importacao;
    }

    /**
     * @return mixed
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * @param mixed $lote
     */
    public function setLote($lote): void
    {
        $this->lote = $lote;
    }




}