<script type="text/javascript" src="<?php echo base_url(); ?>/assets/multitools/js/chat.js"></script>
<script type="text/javascript">
/*window.onbeforeunload = Call;
        function Call() {

        	$.ajax({
        		type: 'POST',
        		url: '<?php echo site_url('multitools/login/chat_sair'); ?>',
        		success: function() {

                    alert('Deslogado com Sucesso.');

        		}
        	});

        return "";
        }*/
</script>
<style>
#wrapper{ width:100%; font-size:12px; height:400px; overflow-y:auto; overflow-x:hidden;}
#wrapper ul { padding:0px; }
#wrapper .li-no-question { margin:6px; }
#wrapper ul li { list-style:none; }
#wrapper .resposta { margin-left:10px; background-color:#F1F1F1; margin-top:0px; padding:5px; }
#wrapper input { width:560px; height:12px; padding:5px; border:#ccc; }
#wrapper .check-for-question { width:10px; display:inline-block; margin:5px;}
#wrapper .botao { background-color:#F7931E; width:80px; height:20px; color:#111; padding:0px;}
#chat-panel-questions{ display: none; }
.current_author_on{ font-weight:bolder; }
</style>
<div id="tabela">

	<div id="msg"><?php echo $this->session->flashdata('msg');?></div>

	<div class="centerCursos equalH-meus-cursos">

                 <h1>Chat</h1>

                 <br /><a href="<?php echo site_url('multitools/login/chat_sair'); ?>" class="button-link">Sair do Chat</a>

        <div id="wrapper">


            <form id="form-messages" class="chat-input" method="post" action="<?php echo site_url('multitools');?>/chat/AppSetMsg" data-action-questions="<?php echo site_url('multitools');?>/chat/AppSetQuestions" data-count-reg="<?php echo site_url('multitools');?>/chat/AppCountMsg">

			<!-- Arguments -->
			<input type="hidden" name="current-user" value="<?php echo $this->session->userdata('chat_instrutor_id');?>" />
			<input type="hidden" name="id-chat" value="<?php echo $this->session->userdata('chat_curso_id');?>" />
			<input id="status" type="hidden" name="status" value="pergunta-aberta" />

			<!-- Messages Input -->
			<input type="text" name="mensagem" id="chat-textarea" class="submit">
			<br />

			<!-- Buttons -->
			<input type="submit" id="submit-btn" value="Enviar" class="botao">
			<input type="button" id="questions" value="Perguntas" class="botao">
			<input type="button" id="chat" value="Chat" class="botao">

			<!-- Views -->
                        <ul id="chat-panel" data-view-msgs="<?php echo site_url('multitools');?>/chat/AppGetMsg"></ul>
                        <ul style="display:none;" id="chat-panel-questions" data-view-questions="<?php echo site_url('multitools');?>/chat/AppGetQuestions"></ul>

		</form>

		</div>


                </div>

</div><!--/tabela -->