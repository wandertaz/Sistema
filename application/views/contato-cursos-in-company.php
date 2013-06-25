<?php
if(isset($_REQUEST['email']) && $_REQUEST['email'] != ''):

else:
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MB CONSULTORIA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="http://www.multiwebphp.com.br/mb_consultoria/assets/css/normalize.css">
        <link rel="stylesheet" href="http://www.multiwebphp.com.br/mb_consultoria/assets/css/main.css">
        <link rel="stylesheet" href="http://www.multiwebphp.com.br/mb_consultoria/assets/css/estilos.css">
        <link rel="stylesheet" href="http://www.multiwebphp.com.br/mb_consultoria/assets/css/fontes.css">
        <script src="http://www.multiwebphp.com.br/mb_consultoria/assets/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="http://www.multiwebphp.com.br/mb_consultoria/assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
		<script src="http://www.multiwebphp.com.br/mb_consultoria/assets/js/jquery.maskedinput-1.3.min.js"></script>

        <script type="text/javascript">
		jQuery(function($){
		   $(".data").mask("99/99/9999");
		   $("#telefone").mask("(99) 9999-9999");
		   $("#Celular").mask("(99) 9999-9999");
		   $("#cep").mask("99999-999");
		   $("#cnpj").mask("99.999.999/9999-99");
		   });


    jQuery(function(){
      jQuery("#form-contato").validate({
        submitHandler:function(form) {
          SubmittingForm();
        },
        rules: {
          "nome-fantasia": "required",
          "razao-social": "required",
          "cnpj": "required",
          "segmento": "required",
          "tipoCurso": "required",
          "nomeCurso": "required",
          "areaCurso": "required",
          "qtdParticipantes": "required",
          "cargaHoraria": "required",
          "resultadoEsperado": "required",
          "local": "required",
          "infra": "required",
          "dataInicio": "required",
          "dataTermino": "required",
          "cel": "required",
          "tel": "required",
          "mensagem": "required",
          email: {        // compound rule
            required: true,
            email: true
          }
        }
      }); 
    })

		</script>

        <style>
        h4{
         color:#F7931E;
       }
       #form-contato label.error {
        position: absolute;
        width: auto;
        left: 0;
        margin: 2px 0 0 116px;
      }
		</style>

    </head>
    <body>
<form action="<?php echo site_url('educacao_corporativa/enviar_solicitacao'); ?>" id="form-contato" method="post" style="height:2200px;">
	<?php if(isset($tipo_curso)): ?>
		<h2>Solicitação de orçamento para <?php echo $tipo_curso == 'IN' ? 'Curso In Company' : 'Programa de Desenvolvimento e Universidade Corporativa'; ?></h2>
	<?php else: ?>
		<b><?php echo isset($mensagem) ? $mensagem : ''; ?></b>
	<?php endif; ?>
	<div>
		<p>Desde de já agradecemos seu contato. Por favor preencha os campos abaixo e enviaremos o orçamento assim que possível. Campos com * são de preenchimento obrigatório.</p>

		<input type="text" id="nomefantasia" name="nome-fantasia" placeholder="Nome Fantasia *"/>
		<input type="text" id="razao-social" name="razao-social"  placeholder="Razão Social *" />
		<input type="text" id="cnpj" name="cnpj"  placeholder="CNPJ*" /><br/>
		<h4>Segmento</h4>
      <input type="radio" name="segmento" value="Indústria" id="segmento_0" class="radioButton0">Indústria
      <input type="radio" name="segmento" value="Comércio" id="segmento_1" class="radioButton">
		    Comércio
      <!--<input type="radio" name="segmento" value="Serviços" id="segmento_2" class="radioButton">
		    Serviços-->
      <input type="radio" name="segmento" value="Gestão Pública" id="segmento_3" class="radioButton">
		    Gestão Pública
      <input type="radio" name="segmento" value="Terceiro Setor" id="segmento_4" class="radioButton">
		    Terceiro Setor
            <input type="radio" name="segmento" value="Serviços" id="tipoCurso_2" class="radioButton">
		    Serviços


      <h4>Tipo do Curso</h4>
      <input type="radio" name="tipoCurso" value="Palestra" id="tipoCurso_0" class="radioButton0">Palestra
      <input type="radio" name="tipoCurso" value="Workshop" id="tipoCurso_1" class="radioButton">
		    Workshop

      <input type="radio" name="tipoCurso" value="Curso" id="tipoCurso_3" class="radioButton">
		    Curso
      <input type="radio" name="tipoCurso" value="Seminário" id="tipoCurso_4" class="radioButton">
		    Seminário
            <br/>

            <br/><input id="nomeCurso" name="nomeCurso" placeholder="Nome do Curso" value="<?php echo isset($curso) && $curso ? $curso->titulo : ''; ?>" /><br/>

            <h4>Área do Curso</h4>
            <input type="radio" name="areaCurso" value="Gestão" id="tipoCurso_0" class="radioButton0">Gestão (Liderança, Marketing, Comunicação, Feedback, Finanças, etc)<br/>
      		<input type="radio" name="areaCurso" value="Técnico" id="tipoCurso_1" class="radioButton0">Técnico (Normas ISO, Auditorias, CEP, 5S, Lean Manufacturing, etc)<br/>

            <h4>Quantidade de Participantes</h4>
            <input type="radio" name="qtdParticipantes" value="Até 10 pessoas" id="qtdParticipantes_0" class="radioButton0">Até 10 pessoas
      		<input type="radio" name="qtdParticipantes" value="De 11 a 20 pessoas" id="qtdParticipantes_1" class="radioButton">11 a 20 pessoas
            <input type="radio" name="qtdParticipantes" value="De 21 a 40 pessoas" id="qtdParticipantes_2" class="radioButton">21 a 40 pessoas<br/>
            <input type="radio" name="qtdParticipantes" value="De 41 a 60 pessoas" id="qtdParticipantes_3" class="radioButton0">41 a 60 pessoas
            <input type="radio" name="qtdParticipantes" value="De 61 a 150 pessoas" id="qtdParticipantes_4" class="radioButton">61 a 150 pessoas
            <input type="radio" name="qtdParticipantes" value="De 151 a 300 pessoas" id="qtdParticipantes_5" class="radioButton">151 a 300 pessoas<br/>
            <input type="radio" name="qtdParticipantes" value="Acima de 300 pessoas" id="qtdParticipantes_6" class="radioButton0">Acima de 300 pessoas<br/>


            <h4>Objetivo do Curso</h4>
            <input type="checkbox" name="objetivo[]" value="Capacitação Inicial" id="qtdParticipantes_0" class="radioButton0">Capacitação Inicial (os participantes não conhecem ou não tem experiência no assunto)<br/>
      		<input type="checkbox" name="objetivo[]" value="Atualização do Aprendizado" id="qtdParticipantes_1" class="radioButton0">Atualização do Aprendizado (os participantes conhecem o assunto, mas precisam de um reforço ou atualização)<br/>
            <input type="checkbox" name="objetivo[]" value="Mudança Organizacional" id="qtdParticipantes_2" class="radioButton0">Mudança Organizacional (a empresa deseja reforçar novas atitudes e comportamentos relacionados ao seu interesse)<br/>
            <input type="checkbox" name="objetivo[]" value="Cumprimento de Menta e Plano de Treinamento" id="qtdParticipantes_3" class="radioButton0">Cumprimento de Meta e Plano de Treinamento (a empresa precisa cumprir o LNT_Levantamento de Necessidades de Treinamento ou orçamento do ano)<br/>
            <input type="text" id="outroObjetivo" name="outroObjetivo" placeholder="Outro objetivo" />

            <h4>Carga Horária</h4>
            <input type="radio" name="cargaHoraria" value="2 horas" id="cargaHoraria_0" class="radioButton0">2 horas
      		<input type="radio" name="cargaHoraria" value="4 horas" id="cargaHoraria_1" class="radioButton">4 horas
            <input type="radio" name="cargaHoraria" value="8 a 10 horas" id="cargaHoraria_2" class="radioButton">8 a 10 horas
            <input type="radio" name="cargaHoraria" value="12 a 16 horas" id="cargaHoraria_3" class="radioButton0">12 a 16 horas
            <input type="radio" name="cargaHoraria" value="16 a 20 horas" id="cargaHoraria_4" class="radioButton">16 a 20 horas<br/>
            <input type="radio" name="cargaHoraria" value="Acima de 20 horas" id="cargaHoraria_5" class="radioButton0">Acima de 20 horas<br/>

            <h4>Público Alvo</h4>
            <input type="checkbox" name="publicoAlvo[]" value="Diretoria" id="qtdParticipantes_0" class="radioButton0">Diretoria<br/>
      		<input type="checkbox" name="publicoAlvo[]" value="Gerência" id="qtdParticipantes_1" class="radioButton0">Gerência<br/>
            <input type="checkbox" name="publicoAlvo[]" value="Supervisão / Coordenação" id="radioButton0" class="radioButton0">Supervisão / Coordenação<br/>
            <input type="checkbox" name="publicoAlvo[]" value="Analistas/ Técnicos" id="radioButton0" class="radioButton0">Analistas/ Técnicos<br/>
            <input type="checkbox" name="publicoAlvo[]" value="Operacional" id="radioButton0" class="radioButton0">Operacional<br/>

            <h4>Resultado Esperado</h4>
            <textarea id="resultadoEsperado" name="resultadoEsperado" placeholder="Resultado Esperado"></textarea>

            <h4>Local de Realização</h4>
            <input type="radio" name="local" value="In Company" id="local_0" class="radioButton0">In Company (Na empresa contratante)<br/>
      		<input type="radio" name="local" value="Sala ou Espaço físico alugado" id="local_1" class="radioButton0">Sala ou Espaço físico alugado (hotel, centro de convenções, etc)<br/>
            <input type="radio" name="local" value="Auditório da MB Consultoria" id="local_2" class="radioButton0">Auditório da MB Consultoria

            <h4>A empresa possui infra-estrutura</h4>
            <input type="checkbox" name="infra[]" value="Sala de Treinamento" id="infra_0" class="radioButton0">Sala de Treinamento<br/>
      		<input type="checkbox" name="infra[]" value="Data Show" id="infra_1" class="radioButton0">Data Show<br/>
            <input type="checkbox" name="infra[]" value="Flip Chart" id="infra_2" class="radioButton0">Flip Chart<br/>
            <input type="checkbox" name="infra[]" value="TV/DVD" id="infra_3" class="radioButton0">TV/DVD<br/>
            <input type="text" id="infra_4" name="outraInfra" placeholder="Outros" />

            <h4>Data Prevista</h4>
            Início: <input type="text" name="dataInicio" id="data" class="data" style="width:100px; margin-left:22px;"><br/>
            Término: <input type="text" name="dataTermino" id="data" class="data" style="width:100px; margin-left:3px;">

            <h4>Hora Prevista</h4>
            <input type="checkbox" name="horaPrevista[]" value="Manhã" id="qtdParticipantes_0" class="radioButton0">Manhã<br/>
      		<input type="checkbox" name="horaPrevista[]" value="Tarde" id="qtdParticipantes_1" class="radioButton0">Tarde<br/>
            <input type="checkbox" name="horaPrevista[]" value="Noite" id="qtdParticipantes_0" class="radioButton0">Noite<br/>
      		<input type="checkbox" name="horaPrevista[]" value="Fim de Semana" id="qtdParticipantes_1" class="radioButton0">Fim de Semana (Sábado, Domingo, Feriado)<br/>

            <h4>Contato</h4>
        <span>
		<input type="text" id="telefone" name="tel" placeholder="Telefone *" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" id="Celular" name="cel" placeholder="Celular" />
		</span>
		<input type="text" id="email" name="email" placeholder="E-mail" />
        <textarea id="mensagem" name="mensagem" placeholder="Mensagem"></textarea>

		<input type="submit" value="enviar" name="enviar" id="enviar" style="float:left;" />
	</div>
</form>
<?php endif; ?>