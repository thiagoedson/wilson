<?php
session_start();
include "dire.php";
$senha = $_SESSION["codigo"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $titulo;?></title>
<link href="img/Adidas.ico" rel="shortcut icon" type="image/x-icon" />
<link type="text/css" href="menu.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="menu.js"></script>
<style type="text/css" media="all">
@import url("estilo.css");
</style>
<link rel="stylesheet" href="help/demo.css" /> 
	


	<script type="text/javascript" src="help/lib/chili-1.7.pack.js"></script> 
	
	<script type="text/javascript" src="help/lib/jquery.easing.js"></script> 
	<script type="text/javascript" src="help/lib/jquery.dimensions.js"></script> 
	<script type="text/javascript" src="help/jquery.accordion.js"></script> 
 
	<script type="text/javascript"> 
	jQuery().ready(function(){

		// simple accordion
		jQuery('#list1a').accordion();
		jQuery('#list1b').accordion({
			autoheight: false
		});
		
		// second simple accordion with special markup
		jQuery('#navigation').accordion({
			active: false,
			header: '.head',
			navigation: true,

			event: 'mouseover',
			fillSpace: true,
			animated: 'easeslide'
		});
		
		// highly customized accordion
		jQuery('#list2').accordion({
			event: 'mouseover',
			active: '.selected',
			selectedClass: 'active',
			animated: "bounceslide",
			header: "dt"
		}).bind("change.ui-accordion", function(event, ui) {

			jQuery('<div>' + ui.oldHeader.text() + ' hidden, ' + ui.newHeader.text() + ' shown</div>').appendTo('#log');
		});
		
		// first simple accordion with special markup
		jQuery('#list3').accordion({
			header: 'div.title',
			active: false,
			alwaysOpen: false,
			animated: false,
			autoheight: false
		});

		

		var wizard = $("#wizard").accordion({

			header: '.title',

			event: false

		});

		
		var wizardButtons = $([]);

		$("div.title", wizard).each(function(index) {

			wizardButtons = wizardButtons.add($(this)
			.next()
			.children(":button")
			.filter(".next, .previous")
			.click(function() {

				wizard.accordion("activate", index + ($(this).is(".next") ? 1 : -1))

			}));

		});

		
		// bind to change event of select to control first and seconds accordion
		// similar to tab's plugin triggerTab(), without an extra method

		var accordions = jQuery('#list1a, #list1b, #list2, #list3, #navigation, #wizard');

		
		jQuery('#switch select').change(function() {
			accordions.accordion("activate", this.selectedIndex-1 );
		});
		jQuery('#close').click(function() {
			accordions.accordion("activate", -1);
		});
		jQuery('#switch2').change(function() {
			accordions.accordion("activate", this.value);
		});

		jQuery('#enable').click(function() {

			accordions.accordion("enable");

		});

		jQuery('#disable').click(function() {

			accordions.accordion("disable");

		});

		jQuery('#remove').click(function() {

			accordions.accordion("destroy");
			wizardButtons.unbind("click");

		});

	});
	</script> 
 
</head>
<body >
<?php 
include"../adisul_prt1.php";
	   echo $menu_principal; 
?>
<div id="iframe">
<div class="basic" style="float:left; margin-left: 2em;" id="list1b"> 
			<a>Perguntas  Freqüentes  -</a> 
			<div> 
				<p> 
					Estaremos corrigindo eventuais erros nestas perguntas  e respostas, pois sabermos muito sobre determinados assuntos é difícil explicar em frases simples termos técnicos que aprendemos durante muito tempo ,  tentamos explicar de uma maneira simples, desculpe alguns erros e nos oriente a corrigi-los, todos agradecem caso queiram contribuir para melhorar este tutorial.
				</p> 
			</div> 
			<a>1-	Carteira</a> 
			<div> 
				<p> 
					Por que estou recebendo produtos que não constam na carteira ?
Provavelmente a carteira esta  atualizada , ou seja  se não esta na carteira é porque foi faturado antes da emissão deste relatório e você deve verificar no relatório de faturamento no mesmo dia ou no dia seguinte.
				</p> 
			</div> 
			<a>2-	Faturamento</a> 
			<div> 
				<p> 
					Por que estou recebendo produtos que não estão no rel. de faturamento ?

O rel. de faturamento deve  estar desatualizado, espere um novo relatório , ou verifique em uma carteira anterior, desde que ela esteja sido salva em seu PC.

				</p> 
			</div> 
            <a>3-	Como devo interpretar a carteira ?</a> 
			<div> 
				<p> 
					O relatório  de carteira reflete a atual posição dos pedidos e dos produtos programados.Verifique  sempre na parte superior as data da atualização do relatório, pois pode ser que ele esteja  desatualizado por vários motivos , desde problemas nos arquivos internos que geram as informações ou atrasos das áreas  de TI envolvidas na geração  do mesmo.
Ex. se o rel. de carteira é do dia 10 de julho, provavelmente não deu tempo de aparecer os pedidos feitos na semana anterior ao relatório, e é possível até aparecer no dia seguinte no  outro relatório de faturamento sem ter aparecido no relatório  de carteira, isso se dá pelo simples fato de terem sido gerados em dias diferentes.

As datas de previsão de entrega são justamente para que o cliente saiba que os produtos ainda não estão disponíveis para serem confirmados.
Sempre verifique na ultima coluna o status do pedido, Aconfirmar, Confirmado, eles indicam  quando um produto esta pronto para liberação.
Na coluna Entrega Revisada é a data provavel de entrega do produto, fique antento pois essa data pode mudar em decorrência de muitos fatores, um deles é por solicitação do próprio cliente, por atraso na importação, pelo departamento de crédito e por atrasos ou falta de limites para liberar pedidos, etc..


				</p> 
			</div> 
            <a>4-	Por que um determinado produto que estava com Status A confirmar pode ser faturado sem antes mudar o status para Confirmado ?</a> 
			<div> 
				<p> 
					Isso pode acontecer pelo simples fato de que o produto foi retirado de outro cliente e confirmado no seu pedido, ou por um cancelamento ou por re alinhamento de entrega deste cliente, liberando assim o produto dentro do mês, e reservando para ele na chegada do mês seguinte, porque quando se faz uma prorrogação de entrega não necessariamente garantimos que um produto que já estava com status de Reservado no Estoque mantenha o mesmo status, quando se prorroga uma entrega ela automaticamente perde a preferência  e toda a carteira fica sujeita a grandes mudança, por isso sempre orientamos os clientes a não fazerem muitas alterações para não terem as entregas todas alteradas ..
Outro fator que faz mudar muito estas reservas  é a questão de problemas na liquidação dos títulos.


				</p> 
			</div> 
            <a>5-	Quem deve corrigir a carteira e arrumar caso esteja com algum problema  ?</a> 
			<div> 
				<p> 
					Toda a conferência  da carteira é de responsabilidade do cliente, erros devem ser alertados para o represente arrumar, porém uma vez disponível no site para conferencia o próprio cliente tem a responsabilidade sobre as informações, não aceitaremos devolução por desconhecerem  que tal produto seria entregue  em  tal data ou em tal quantidade. 

			  </p> 
			</div> 
            <a>6-	Se  um pedido era para o mês exemplo &quot;Produto de Junho recebemdo em Agosto &quot; posso devolver por atraso na entrega ?</a> 
			<div> 
				<p> 
					          Não , pois ele foi informado desde junho que seria entregue em Agosto e com dito         anteriormente, a carteira é de responsabilidade do cliente, atrasos de entrega devem ser avisados ao representante e dentro do prazo legal poderá ser cancelada desde que não esteja já Confirmado na Carteira, verifique todos os meses os saldos de pedidos, e oriente-se para gerenciar as entregas pois poderá acumular de um mês para outro.

			  </p> 
			</div> 
            <a>7-	Como devo informar que não quero mais receber determinado produto pois esta com  o Status de  Aguardando Chegada  e é do mês anterior ?</a> 
			<div> 
				<p> 
					Você deve passar um e-mail para o escritório do representante (mauricioadidas@terra.com.br)  informando que não quer mais receber os produtos do mês atrasado, até que esta informação não seja passada, os produtos podem ser faturados mesmo sendo de meses anteriores , não temos como ficar controlando a carteira de todos os clientes, fizemos algumas conferências mensalmente e esporadicamente.

			  </p> 
			</div> 
            <a>8-	Porque recebemos 28 dias extras no prazo de pagamento quando programamos um produto ?</a> 
			<div> 
				<p> 
					Justamente para que se adaptem ao recebimento de até 28 dias nas entregas, antecipadamente ou nas entregas atrasadas, já que lidamos com várias empresas tanto nacionais quanto internacionais, este prazo extra é uma forma de compensar  algum incômodo.

			  </p> 
			</div> 
            <a>9- Posso solicitar que só quero receber produtos dentro do mês que programei ?</a> 
			<div> 
				<p> 
					Sim , desde que abra mão de todos os 28 dias em toda a carteira, assim gerenciaremos os atrasos e cancelaremos qualquer produto atrasado, e para não termos devolução por não aceitarem mercadorias atrasadas pagarão pelo prazo escolhido ou seja, perderão 4% que custa estes 28 dias adicionais.

				</p> 
			</div> 
            <a>10- Relatório de Crédito como interpretar-lo ?</a> 
			<div> 
				<p> 
					Verifique sempre a data do relatório na parte superior, pois pode acontecer de que esteja desatualizado e apareçam débitos vencidos que já estejam liquidados,  os bancos levam  até 24 horas para informar pagamentos e cartórios levam até 30 dias.
Neste relatório aparece os limites de cada loja , os valores vencidos no mês, a vencer no mês e os meses seguintes acumulados .


				</p> 
			</div> 
            <a>11- Descontos</a> 
			<div> 
				<p> 
					Como devo verificar os descontos na carteira ?
Os descontos de pré venda são confirmados no primeiro dia do inicio do semestre ( 1 de janeiro e 1 de julho) tudo que tem a receber na carteira neste período que tenha sido programado no show room  terá o valor comparado com  o percentual de desconto.
Exemplo - Se foi programado  R$ 250.000,00  e o desconto a partir desta faixa é de 10%,  no dia primeiro o sistema dará o menos desconto para todo o semestre, mais se faturar alguma coisa no mês anterior  o sistema dará menos descontos porem o que foi faturado pegará o desconto do semestre anterior, que variavelmente é sempre o mesmo, ou seja você não perde nada, desde que tenha comprado a mesma coisa no semestre anterior, já para o semestre atual será reduzido os desconto para 8%, para evitar estas perdas durante a pré venda sempre orientamos os clientes para comprarem 10% além do valor mínimo porque sempre cancela algum item mesmos depois de digitado e este valor pode interferir no seu desconto.


				</p> 
			</div> 
            <a>12- Onde encontrar os Percentuais ?</a> 
			<div> 
				<p> 
					No relatório de Crédito aparece o percentual que você  esta recebendo<br />

<br />
<pre style="background-color:#F90; display:block;">
			   Atual
Cust_Disc_Code - Atual	Cust_Disc_Name - Atual<br />
21200007	PV8,0v00,0Set00,0Seg00,0R5,5<br />
</pre>

No exemplo acima significa, 8% de desconto na pré venda, 5,5% para reposição "Reorder".


				</p> 
			</div> 
           
			
           
  </div>

</div>
</body>
</html>