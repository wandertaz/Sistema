<?php
	include("includes/topo.php");
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chat.js"></script>

          <?php include("includes/banner-interna.php"); ?>

            <div class="content">

            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
           <!-- <ul>
            	<li class="selected"><a href="#">Cursos</a></li>
                <li><a href="#">Banco de Talentos</a></li>
                <li><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>-->
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>

              <div class="content-interna" style="width:780px; background:white;">
             <div class="breadcrumb">
                       <ul style="padding:5px 0 5px 0;">
                        <li><a href="<?php echo base_url();?>">Home &gt;</a></li>
                        <li><a href="<?php echo base_url();?>area_restrita_meus_cursos">Área Restrita &gt;</a></li>
                        <li><a href="<?php echo base_url();?>chat">Chat</a></li>
                       </ul>
                  </div>
                <div class="left-cursos equalH-meus-cursos">

                  <div class="miolo-interna">

            <ul class="lista-meus-cursos">
                       <li><a href="#">Conteúdo</a>
                         <span>
                               <a href="<?php echo site_url();?>conteudo_curso/programacao">Programação</a>
                           </span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/A">Apostila e anexos</a></span>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso/apostilas_anexos/L">Leituras Complementares
                           </span>
                           <span class="mensagem"><?php echo check_exercicios();?></span> <span><a href="<?php echo site_url();?>conteudo_curso/exercicios">Exercícios</a></span>
                       </li>
                        <li ><a href="<?php echo site_url();?>area_restrita_notas">Notas e Frequência</a></li>
                       <li class="selected">><a href="<?php echo site_url();?>avaliacao_do_curso">Avaliação do Curso</a></li>
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos">Meus Cursos</a></li>
                       <li><a href="<?php echo site_url();?>certificado">Certificado</a><span>Emissão do Certificado</span></li>
                       <li>
                           <span class="mensagem"><?php echo check_mensagens();?></span>
                           <a href="<?php echo site_url();?>area_restrita_mensagem">Mensagens</a>
                       </li>
</ul>

                  </div>
                </div>

                <div class="centerCursos equalH-meus-cursos">

                 <h1>Chat</h1>

        <div id="wrapper">

            <form id="form-messages" class="chat-input" method="post" action="<?php echo site_url();?>chat/AppSetMsg" data-action-questions="<?php echo site_url();?>chat/AppSetQuestions" data-count-reg="<?php echo site_url();?>chat/AppCountMsg">

                        <!-- Arguments -->
			<input type="hidden" name="current-user" value="<?php echo $this->session->userdata('SessionIdAluno');?>" />
			<input type="hidden" name="id-chat" value="<?php echo($curso['curso_id']);?>" />
			<input id="status" type="hidden" name="status" value="pergunta-aberta" />

			<!-- Messages Input -->
			<input type="text" name="mensagem" id="chat-textarea" class="submit">
			<br />

			<!-- Buttons -->
			<input type="submit" id="submit-btn" value="Enviar" class="botao">
			<!--<input type="button" id="questions" value="Perguntas" class="botao">
			<input type="button" id="chat" value="Chat" class="botao">-->

			<!-- Views -->
                        <ul id="chat-panel" data-view-msgs="<?php echo site_url();?>chat/AppGetMsg"></ul>
                        <ul style="display:none;" id="chat-panel-questions" data-view-questions="<?php echo site_url();?>chat/AppGetQuestions"></ul>

		</form>

		</div>


                </div>

              </div>
              <?php
			  	include("includes/coluna-direita-area-restrita.php");
			  ?>





            </div>

<?php
	include("includes/rodape.php");
?>