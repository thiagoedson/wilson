<?php

namespace Loja;

class Loja
{

    public $id;
    public $tipo = 'pronta_entrega';
    public $nome = 'Pronta entrega';
    public $descricao = 'Produtos disponíves para pronta entrega';
    public $colecao = 'PE';
    public $data_inicio;
    public $data_fim;
    public $status = '0';

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
    public function getColecao(): string
    {
        return $this->colecao;
    }

    /**
     * @param string $colecao
     */
    public function setColecao(string $colecao): void
    {
        $this->colecao = $colecao;
    }

    /**
     * @return mixed
     */
    public function getDataInicio()
    {
        return $this->data_inicio;
    }

    /**
     * @param mixed $data_inicio
     */
    public function setDataInicio($data_inicio): void
    {
        $this->data_inicio = $data_inicio;
    }

    /**
     * @return mixed
     */
    public function getDataFim()
    {
        return $this->data_fim;
    }

    /**
     * @param mixed $data_fim
     */
    public function setDataFim($data_fim): void
    {
        $this->data_fim = $data_fim;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }



}