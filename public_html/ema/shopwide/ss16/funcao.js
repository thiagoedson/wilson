var req;
 
// FUNÇÃO PARA BUSCA NOTICIA
function buscarNoticias(valor) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "funcao.php?valor="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);

req.send(null);
}