<?php

use Usuario\Usuario;

function autenticacaoSISTEMA($dados)
{
    $retorno = [
        'dados' => $dados
    ];
    try {

        $usuario           = new Usuario();
        $retorno['consulta'] =   $usuario->Autenticacao($dados["fm_login"], $dados["fm_senha"]);
        //print_r($retorno);
        //var_dump($retorno['status']);
        // exit;


        if ($retorno['consulta']) {
            header("location:../home/?ACAO=Autenticacao");
        } else {
            header("location:../app/index.php?ACAO=AutenticacaoFalho&msg=Dados inválidos" . $retorno['status']);
        }

        return $retorno;
    } catch (Exception $e) {
        $retorno['error'] = $e;
        return $retorno;
    }
}


function higienizaCPF($cpf)
{
    try {

        $cpf = trim($cpf);
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        $cpf = str_replace('/', '', $cpf);

        return $cpf;

    } catch (Exception $e) {
        return $e;
    }

}

function getUsuarioSessao()
{
    try {

        if (!empty($_SESSION) && !empty($_SESSION['iduser'])) {
            return (int)$_SESSION['iduser'];
        }

        return logout();
    } catch (Exception $e) {
        return $e;
    }
}

function logout()
{
    try {
        session_unset();
        header('Location: /app/index.php?logout=0');
        //exit;
    } catch (Exception $e) {
        return $e;
    }
}

function formataDataStr($str, $format = 'Y-m-d', $default = null)
{
    try {
        if (empty($str)) {
            return $default;
        }

        $str = higienizaDataStr($str);

        if (empty($str)) {
            return $default;
        }

        $ts = @strtotime($str);
        if ($ts !== false) {
            return date($format, $ts);
        }

        return $default;
    } catch (Exception $e) {
        return $e;
    }
}

function higienizaDataStr($str)
{

    try {

        $str = trim(preg_replace('/[^0-9\s\-\/]+/', '', $str));

        if (empty($str)) {
            return null;
        }

        $str = trim(preg_replace('/[^0-9\s\-\/.]+/', '', $str));
        $str = str_replace('/', '-', $str);
        $str = trim(str_replace('.', '-', $str));

        $partes = explode(' ', $str);

        if (count($partes) > 2) {
            return null;
        }

        $data = !empty($partes[0]) ? $partes[0] : null;
        $hora = !empty($partes[1]) ? $partes[1] : null;

        $pos = strpos($data, '-');
        //01-02-2017
        if ($pos == 2) {
            $data = sprintf('%s-%s-%s', substr($data, 6, 4), substr($data, 3, 2), substr($data, 0, 2));
        }

        $dataHora = trim($data . ' ' . $hora);

        return $dataHora ? $dataHora : null;
    } catch (Exception $e) {
        return $e;
    }
}

function templateNomeTituloSISTEMA($nome)
{
    try {
        $nome  = strtolower($nome);   // Converter o nome todo para minúsculo
        $nome  = explode(" ", $nome); // Separa o nome por espaços
        $saida = "";

        foreach ($nome as $key => $item) {
            if ($nome[$key] == "de" or $nome[$key] == "da" or $nome[$key] == "e" or $nome[$key] == "dos" or $nome[$key] == "do") {
                $saida .= $nome[$key] . ' '; // Se a palavra estiver dentro das complementares mostrar toda em minúsculo
            } else {
                $saida .= ucfirst($nome[$key]) . ' '; // Se for um nome, mostrar a primeira letra maiúscula
            }
        }

        return trim($saida);
    } catch (\Exception $e) {
        return trim($nome);
    }
}

function moneyFormat($Param = 0.00)
{
    return number_format(str_replace(",", ".", $Param), 2, ',', '');
}

function moedaPhp($str_num)
{
    try {
        $resultado = str_replace('.', '', $str_num);
        $resultado = str_replace(',', '.', $resultado);

        return (float)$resultado;
    } catch (Exception $e) {
        return $e;
    }
}

function consultaCEP($dados)
{

    $retorno = [
        'dados'  => $dados,
        'status' => false,
    ];

    try {

        $class = new Jarouche\ViaCEP\BuscaViaCEPJSONP();
        $class->setCallbackFunction('consulta_cep');
        $result             = $class->retornaCEP(higienizaCPF($dados['cep']));
        $retorno['retorno'] = ($result);

        #region Html retorno
        ob_start();

        if ($result['uf'] != 'MT') {
            ?>
            <div class="card shadow-sm card-body">
                <p class="h2 text-danger" style=" overflow-y: hidden;">
                    <?php echo $result['localidade'] . ' - ' . $result['uf'] ?><br>
                    Infelizmente não atendemos a região informada, mais estamos crescendo
                    e num futuro vamos chegar até você !
                </p>
            </div>

            <?php
        } else {
            ?>
            <p class="h1 text-success" style=" overflow-y: hidden;">
                <?php echo $result['localidade'] . ' - ' . $result['uf'] ?><br>

            </p>
            <input type="text" class="form-control form-control-lg" id="bairro" name="bairro"
                   placeholder="Informe o Bairro" value="<?php echo $result['bairro']; ?>">

            <?php
        }

        $retorno['html'] = trim(ob_get_contents());
        ob_end_clean();
        #endregion

        return $retorno;
    } catch (Exception $e) {
        $retorno['error'] = $e;
        return $retorno;
    }
}
