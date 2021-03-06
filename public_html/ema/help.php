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
			<a>Perguntas  Freq??entes  -</a> 
			<div> 
				<p> 
					Estaremos corrigindo eventuais erros nestas perguntas  e respostas, pois sabermos muito sobre determinados assuntos ?? dif??cil explicar em frases simples termos t??cnicos que aprendemos durante muito tempo ,  tentamos explicar de uma maneira simples, desculpe alguns erros e nos oriente a corrigi-los, todos agradecem caso queiram contribuir para melhorar este tutorial.
				</p> 
			</div> 
			<a>1-	Carteira</a> 
			<div> 
				<p> 
					Por que estou recebendo produtos que n??o constam na carteira ?
Provavelmente a carteira esta  atualizada , ou seja  se n??o esta na carteira ?? porque foi faturado antes da emiss??o deste relat??rio e voc?? deve verificar no relat??rio de faturamento no mesmo dia ou no dia seguinte.
				</p> 
			</div> 
			<a>2-	Faturamento</a> 
			<div> 
				<p> 
					Por que estou recebendo produtos que n??o est??o no rel. de faturamento ?

O rel. de faturamento deve  estar desatualizado, espere um novo relat??rio , ou verifique em uma carteira anterior, desde que ela esteja sido salva em seu PC.

				</p> 
			</div> 
            <a>3-	Como devo interpretar a carteira ?</a> 
			<div> 
				<p> 
					O relat??rio  de carteira reflete a atual posi????o dos pedidos e dos produtos programados.Verifique  sempre na parte superior as data da atualiza????o do relat??rio, pois pode ser que ele esteja  desatualizado por v??rios motivos , desde problemas nos arquivos internos que geram as informa????es ou atrasos das ??reas  de TI envolvidas na gera????o  do mesmo.
Ex. se o rel. de carteira ?? do dia 10 de julho, provavelmente n??o deu tempo de aparecer os pedidos feitos na semana anterior ao relat??rio, e ?? poss??vel at?? aparecer no dia seguinte no  outro relat??rio de faturamento sem ter aparecido no relat??rio  de carteira, isso se d?? pelo simples fato de terem sido gerados em dias diferentes.

As datas de previs??o de entrega s??o justamente para que o cliente saiba que os produtos ainda n??o est??o dispon??veis para serem confirmados.
Sempre verifique na ultima coluna o status do pedido, Aconfirmar, Confirmado, eles indicam  quando um produto esta pronto para libera????o.
Na coluna Entrega Revisada ?? a data provavel de entrega do produto, fique antento pois essa data pode mudar em decorr??ncia de muitos fatores, um deles ?? por solicita????o do pr??prio cliente, por atraso na importa????o, pelo departamento de cr??dito e por atrasos ou falta de limites para liberar pedidos, etc..


				</p> 
			</div> 
            <a>4-	Por que um determinado produto que estava com Status A confirmar pode ser faturado sem antes mudar o status para Confirmado ?</a> 
			<div> 
				<p> 
					Isso pode acontecer pelo simples fato de que o produto foi retirado de outro cliente e confirmado no seu pedido, ou por um cancelamento ou por re alinhamento de entrega deste cliente, liberando assim o produto dentro do m??s, e reservando para ele na chegada do m??s seguinte, porque quando se faz uma prorroga????o de entrega n??o necessariamente garantimos que um produto que j?? estava com status de Reservado no Estoque mantenha o mesmo status, quando se prorroga uma entrega ela automaticamente perde a prefer??ncia  e toda a carteira fica sujeita a grandes mudan??a, por isso sempre orientamos os clientes a n??o fazerem muitas altera????es para n??o terem as entregas todas alteradas ..
Outro fator que faz mudar muito estas reservas  ?? a quest??o de problemas na liquida????o dos t??tulos.


				</p> 
			</div> 
            <a>5-	Quem deve corrigir a carteira e arrumar caso esteja com algum problema  ?</a> 
			<div> 
				<p> 
					Toda a confer??ncia  da carteira ?? de responsabilidade do cliente, erros devem ser alertados para o represente arrumar, por??m uma vez dispon??vel no site para conferencia o pr??prio cliente tem a responsabilidade sobre as informa????es, n??o aceitaremos devolu????o por desconhecerem  que tal produto seria entregue  em  tal data ou em tal quantidade. 

			  </p> 
			</div> 
            <a>6-	Se  um pedido era para o m??s exemplo &quot;Produto de Junho recebemdo em Agosto &quot; posso devolver por atraso na entrega ?</a> 
			<div> 
				<p> 
					          N??o , pois ele foi informado desde junho que seria entregue em Agosto e com dito         anteriormente, a carteira ?? de responsabilidade do cliente, atrasos de entrega devem ser avisados ao representante e dentro do prazo legal poder?? ser cancelada desde que n??o esteja j?? Confirmado na Carteira, verifique todos os meses os saldos de pedidos, e oriente-se para gerenciar as entregas pois poder?? acumular de um m??s para outro.

			  </p> 
			</div> 
            <a>7-	Como devo informar que n??o quero mais receber determinado produto pois esta com  o Status de  Aguardando Chegada  e ?? do m??s anterior ?</a> 
			<div> 
				<p> 
					Voc?? deve passar um e-mail para o escrit??rio do representante (mauricioadidas@terra.com.br)  informando que n??o quer mais receber os produtos do m??s atrasado, at?? que esta informa????o n??o seja passada, os produtos podem ser faturados mesmo sendo de meses anteriores , n??o temos como ficar controlando a carteira de todos os clientes, fizemos algumas confer??ncias mensalmente e esporadicamente.

			  </p> 
			</div> 
            <a>8-	Porque recebemos 28 dias extras no prazo de pagamento quando programamos um produto ?</a> 
			<div> 
				<p> 
					Justamente para que se adaptem ao recebimento de at?? 28 dias nas entregas, antecipadamente ou nas entregas atrasadas, j?? que lidamos com v??rias empresas tanto nacionais quanto internacionais, este prazo extra ?? uma forma de compensar  algum inc??modo.

			  </p> 
			</div> 
            <a>9- Posso solicitar que s?? quero receber produtos dentro do m??s que programei ?</a> 
			<div> 
				<p> 
					Sim , desde que abra m??o de todos os 28 dias em toda a carteira, assim gerenciaremos os atrasos e cancelaremos qualquer produto atrasado, e para n??o termos devolu????o por n??o aceitarem mercadorias atrasadas pagar??o pelo prazo escolhido ou seja, perder??o 4% que custa estes 28 dias adicionais.

				</p> 
			</div> 
            <a>10- Relat??rio de Cr??dito como interpretar-lo ?</a> 
			<div> 
				<p> 
					Verifique sempre a data do relat??rio na parte superior, pois pode acontecer de que esteja desatualizado e apare??am d??bitos vencidos que j?? estejam liquidados,  os bancos levam  at?? 24 horas para informar pagamentos e cart??rios levam at?? 30 dias.
Neste relat??rio aparece os limites de cada loja , os valores vencidos no m??s, a vencer no m??s e os meses seguintes acumulados .


				</p> 
			</div> 
            <a>11- Descontos</a> 
			<div> 
				<p> 
					Como devo verificar os descontos na carteira ?
Os descontos de pr?? venda s??o confirmados no primeiro dia do inicio do semestre ( 1 de janeiro e 1 de julho) tudo que tem a receber na carteira neste per??odo que tenha sido programado no show room  ter?? o valor comparado com  o percentual de desconto.
Exemplo - Se foi programado  R$ 250.000,00  e o desconto a partir desta faixa ?? de 10%,  no dia primeiro o sistema dar?? o menos desconto para todo o semestre, mais se faturar alguma coisa no m??s anterior  o sistema dar?? menos descontos porem o que foi faturado pegar?? o desconto do semestre anterior, que variavelmente ?? sempre o mesmo, ou seja voc?? n??o perde nada, desde que tenha comprado a mesma coisa no semestre anterior, j?? para o semestre atual ser?? reduzido os desconto para 8%, para evitar estas perdas durante a pr?? venda sempre orientamos os clientes para comprarem 10% al??m do valor m??nimo porque sempre cancela algum item mesmos depois de digitado e este valor pode interferir no seu desconto.


				</p> 
			</div> 
            <a>12- Onde encontrar os Percentuais ?</a> 
			<div> 
				<p> 
					No relat??rio de Cr??dito aparece o percentual que voc??  esta recebendo<br />

<br />
<pre style="background-color:#F90; display:block;">
			   Atual
Cust_Disc_Code - Atual	Cust_Disc_Name - Atual<br />
21200007	PV8,0v00,0Set00,0Seg00,0R5,5<br />
</pre>

No exemplo acima significa, 8% de desconto na pr?? venda, 5,5% para reposi????o "Reorder".


				</p> 
			</div> 
           
			
           
  </div>

</div>
</body>
</html>