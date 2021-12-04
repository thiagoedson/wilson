<?php


namespace Usuario;


use Exception;
use MysqliDb;

class Usuario
{
    public $id;
    public $codigo_representacao;
    public $nome = 'Fulano Ciclano';
    public $login = '01051929024';
    public $email = 'exemplo@email.com';
    public $comprador ;
    public $celular1 ;
    public $celular2;
    public $perfil_usuario = 'user8-128x128.jpg';
    public $telefone = '(99) 99999-9999';
    public $senha;
    public $datanasc;
    public $segmento_1;
    public $segmento_2;
    public $loja;
    public $represe;
    public $cod_grupo;
    public $cod_referencia;
    public $cidade;
    public $UF;
    public $min_c;
    public $min_t;
    public $min_e;
    public $grupo = 1;
    public $cargo = 'Auxiliar Administrativo';
    public $cor = "#ff8b00";
    public $foto = "../assets/img/undraw_profile.svg";
    public $status ;
    public $datahora ;
    public $admin ;

    public $grupo_nome;

    public function Autenticacao($cpf, $senha)
    {

        $db = MysqliDb::getInstance();

        try {

            $cpf   = higienizaCPF($cpf);
            $senha = trim($senha);


            //$this->senha =  sha1(md5(base64_encode('clinergy123')));//senha padrão
            //$this->setSenha(sha1(md5(base64_encode('clinergy123'))));//senha padrão
            //$usuario->setSenha(sha1(md5(base64_encode($dados['senha']))));//senha padrão
            // $this->setSenha(sha1(md5(base64_encode($senha))));//senha padrão
            //$this->setSenha(sha1(md5(base64_encode($senha))));//senha padrão
            $this->setSenha(($senha));//senha padrão

            $db->where("login", $cpf)->where("senha", $this->getSenha());
            $consulta = $db->getOne("login");
            //echo $db->getLastQuery();

            if (!empty($consulta)) {
                $usuario = new Usuario($consulta['id']);
                $usuario->IniciaAcessoSistema();
                return $usuario;
            }

            return false;

        } catch (Exception $e) {

            return false;

        }
    }

    public function __construct($id = false)
    {
        if ($id) {
            $this->Carregar($id);
        } else {

            $this->senha = sha1(md5(base64_encode('clinergy123')));//senha padrão

        }
    }

    /**
     * @return mixed
     */
    public function getCodigoRepresentacao()
    {
        return $this->codigo_representacao;
    }

    /**
     * @param mixed $codigo_representacao
     */
    public function setCodigoRepresentacao($codigo_representacao): void
    {
        $this->codigo_representacao = $codigo_representacao;
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
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getComprador()
    {
        return $this->comprador;
    }

    /**
     * @param mixed $comprador
     */
    public function setComprador($comprador): void
    {
        $this->comprador = $comprador;
    }

    /**
     * @return mixed
     */
    public function getCelular1()
    {
        return $this->celular1;
    }

    /**
     * @param mixed $celular1
     */
    public function setCelular1($celular1): void
    {
        $this->celular1 = $celular1;
    }

    /**
     * @return mixed
     */
    public function getCelular2()
    {
        return $this->celular2;
    }

    /**
     * @param mixed $celular2
     */
    public function setCelular2($celular2): void
    {
        $this->celular2 = $celular2;
    }

    /**
     * @return mixed
     */
    public function getDatanasc()
    {
        return $this->datanasc;
    }

    /**
     * @param mixed $datanasc
     */
    public function setDatanasc($datanasc): void
    {
        $this->datanasc = $datanasc;
    }

    /**
     * @return mixed
     */
    public function getSegmento1()
    {
        return $this->segmento_1;
    }

    /**
     * @param mixed $segmento_1
     */
    public function setSegmento1($segmento_1): void
    {
        $this->segmento_1 = $segmento_1;
    }

    /**
     * @return mixed
     */
    public function getSegmento2()
    {
        return $this->segmento_2;
    }

    /**
     * @param mixed $segmento_2
     */
    public function setSegmento2($segmento_2): void
    {
        $this->segmento_2 = $segmento_2;
    }

    /**
     * @return mixed
     */
    public function getLoja()
    {
        return $this->loja;
    }

    /**
     * @param mixed $loja
     */
    public function setLoja($loja): void
    {
        $this->loja = $loja;
    }

    /**
     * @return mixed
     */
    public function getReprese()
    {
        return $this->represe;
    }

    /**
     * @param mixed $represe
     */
    public function setReprese($represe): void
    {
        $this->represe = $represe;
    }

    /**
     * @return mixed
     */
    public function getCodGrupo()
    {
        return $this->cod_grupo;
    }

    /**
     * @param mixed $cod_grupo
     */
    public function setCodGrupo($cod_grupo): void
    {
        $this->cod_grupo = $cod_grupo;
    }

    /**
     * @return mixed
     */
    public function getCodReferencia()
    {
        return $this->cod_referencia;
    }

    /**
     * @param mixed $cod_referencia
     */
    public function setCodReferencia($cod_referencia): void
    {
        $this->cod_referencia = $cod_referencia;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade): void
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getUF()
    {
        return $this->UF;
    }

    /**
     * @param mixed $UF
     */
    public function setUF($UF): void
    {
        $this->UF = $UF;
    }

    /**
     * @return mixed
     */
    public function getMinC()
    {
        return $this->min_c;
    }

    /**
     * @param mixed $min_c
     */
    public function setMinC($min_c): void
    {
        $this->min_c = $min_c;
    }

    /**
     * @return mixed
     */
    public function getMinT()
    {
        return $this->min_t;
    }

    /**
     * @param mixed $min_t
     */
    public function setMinT($min_t): void
    {
        $this->min_t = $min_t;
    }

    /**
     * @return mixed
     */
    public function getMinE()
    {
        return $this->min_e;
    }

    /**
     * @param mixed $min_e
     */
    public function setMinE($min_e): void
    {
        $this->min_e = $min_e;
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
     * @return mixed
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * @param mixed $cor
     */
    public function setCor($cor): void
    {
        $this->cor = $cor;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPerfilUsuario(): string
    {
        return $this->perfil_usuario;
    }

    /**
     * @param string $perfil_usuario
     */
    public function setPerfilUsuario(string $perfil_usuario): void
    {
        $this->perfil_usuario = $perfil_usuario;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     */
    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return int
     */
    public function getGrupo(): int
    {
        return $this->grupo;
    }

    /**
     * @param int $grupo
     */
    public function setGrupo(int $grupo): void
    {
        $this->grupo = $grupo;
    }

    /**
     * @return string
     */
    public function getCargo(): string
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }

    /**
     * @return string
     */
    public function getFoto(): string
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto(string $foto): void
    {
        $this->foto = $foto;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getGrupoNome()
    {
        return $this->grupo_nome;
    }

    /**
     * @param mixed $grupo_nome
     */
    public function setGrupoNome($grupo_nome): void
    {
        $this->grupo_nome = $grupo_nome;
    }

    public function RedefinirSenha()
    {

        try {

            $this->senha = sha1(md5(base64_encode('clinergy123')));//senha padrão
            //$this->senha = sha1(md5(base64_encode('Valdir123')));//senha padrão
            return $this->Salvar();

        } catch (Exception $e) {
            return false;
        }


    }

    public function Carregar($codigo)
    {
        $db = MysqliDb::getInstance();
        try {

            $db->where("U.id", $codigo);
            //$db->join("grupos G", "G.id = U.grupo", "INNER");
            $consulta = $db->getOne('login U', 'U.*');
            $this->Assign($consulta);

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Admin()
    {
        $db = MysqliDb::getInstance();
        try {

            $db->where("U.id", $this->getId());
            $db->where("RG.grupo_id", '1');//Admin
            $db->join("rel_usuario_grupo RG", "U.id = RG.usuario_id", "INNER");
            $consulta = $db->getOne('usuarios U', 'U.*');
            if ($consulta) {
                return true;
            }


            return false;

        } catch (Exception $e) {
            return false;
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
                $db->update('usuarios', $valores);
                $this->Carregar($this->id);
                return $this->id;

            } /**
             * Senão realiza o novo cadastro
             **/
            else {

                $this->id = $db->insert('usuarios', $valores);

                if ($this->id) {

                    $this->Carregar($this->id);

                    return $this->id;

                }

                return false;


            }


        } catch (\Exception $e) {
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

    public function IniciaAcessoSistema(): bool
    {
        try {

            session_start();
            $_SESSION['iduser'] = $this->id;

            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function ListaUsuarios($grupo = false)
    {
        $db = MysqliDb::getInstance();
        try {

            if ($grupo) {
                $db->where("RG.grupo_id", $grupo);
            }

            $db->groupBy("U.id");
            $db->orderBy("U.nome", "ASC");
            $db->join("rel_usuario_grupo RG", "U.id = RG.usuario_id", "INNER");
            return $db->get("usuarios U", null, "U.*");

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Grupos()
    {
        $db = MysqliDb::getInstance();
        try {


            $db->where("usuario_id", $this->id);
            return $db->get("rel_usuario_grupo ");

        } catch (Exception $e) {
            return $e;
        }
    }

    public function AtualizarGrupos($dados)
    {
        $db = MysqliDb::getInstance();
        try {

            if (is_array($dados)) {
                if (count($dados)) {

                    /**
                     * Limpa a tabela de relação do usuário
                     **/
                    $db->where("usuario_id", $this->id);
                    $db->delete("rel_usuario_grupo");

                    foreach ($dados as $row) {

                        $db->insert("rel_usuario_grupo", ['usuario_id' => $this->id, 'grupo_id' => (int)$row]);

                    }

                }
            }

        } catch (Exception $e) {
            return $e;
        }
    }

    public function EncrytSenha($senha)
    {
        try {

            $retorno = sha1(md5(base64_encode($senha)));

            return $retorno;
        } catch (Exception $e) {
            return false;
        }

    }

}