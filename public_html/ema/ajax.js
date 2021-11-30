var req;

// FUNÇÃO PARA BUSCA DO QUE PROCURA
function buscar_o_que_procura(valor) {

// Verificando Browser
if(window.XMLHttpRequest) {
req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
req = new ActiveXObject("Microsoft.XMLHTTP");
}

// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "getID.php?valor="+valor;

// Chamada do método open para processar a requisição
req.open("Get", url, true);

// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {

// Exibe a mensagem "Buscando usuario..." enquanto carrega
// Resultado é o nome da div que está lá no teste.php
if(req.readyState == 1) {
document.getElementById('resultado').innerHTML = 'aguarde ...';
}

// Verifica se o Ajax realizou todas as operações corretamente
if(req.readyState == 4 && req.status == 200) {

// Resposta retornada pelo busca.php
var resposta = req.responseText;

// Abaixo colocamos a(s) resposta(s) na div resultado que está lá no teste.php
document.getElementById('resultado').innerHTML = resposta;

}
}
req.send(null);
}