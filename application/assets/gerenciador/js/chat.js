jQuery(function() {

/*** Init ******************************************************/

	//Loader das views quando carregar o arquivo 
	loadRegs(jQuery('#chat-panel'),'data-view-msgs');
	loadRegs(jQuery('#chat-panel-questions'),'data-view-questions');


/*** Cummon ******************************************************/

	//Listener que atualiza os paineis de mensagens
	setInterval(function(){
		jQuery.get(jQuery('#form-messages').attr('data-count-reg'), function(data) {
			if(data!=jQuery('#chat-panel li.li-no-question').first().attr('id')){
				loadRegs(jQuery('#chat-panel'),'data-view-msgs');
			}
		});
	},500);


/*** Chat ******************************************************/

	//Callback que chama/atualiza a view Chat
	jQuery('#chat').click(function(){
		toogle_view(jQuery('#chat-panel'),jQuery('#chat-panel-questions'));
		loadRegs(jQuery('#chat-panel'),'data-view-msgs');
	});

	//Listener do chat que captura o envio da Mensagem
	jQuery('.chat-input').live('submit',function(e){
		ajaxRequest(e,jQuery(this),jQuery(this).attr('action'));
	});


/*** Replys ******************************************************/

	//Callback que chama/atualiza a view Chat
	jQuery('#questions').click(function(){
		toogle_view(jQuery('#chat-panel-questions'),jQuery('#chat-panel'));
		loadRegs(jQuery('#chat-panel-questions'),'data-view-questions');
	});

	//Listner do chat que captura o envio da Mensagem
	jQuery('.question-input').live('submit',function(e){
		ajaxRequest(e,jQuery('.question-input'),jQuery('.question-input').attr('data-action-questions'));
	});


/*** Helpers ******************************************************/

	//View Loader
	function loadRegs(view,viewName) {
		view.load(view.attr(viewName));
	}

	//View Toggler
	function toogle_view(elShow,elHide) {
			elHide.hide();
			elShow.show();

			if(elShow.attr('id')=="chat-panel-questions"){
				jQuery('#form-messages').removeAttr('class').addClass('question-input');
			}else if(elShow.attr('id')=="chat-panel"){
				jQuery('#form-messages').removeAttr('class').addClass('chat-input');
			}
	}

	//Ajax Pattern
	function ajaxRequest(e,el,urlToAction) {
			e.preventDefault();

			var dados = el.serialize(),
				action = urlToAction;

			jQuery.ajax({
					type: "POST",  
					url: action,    
					cache: false,
					data: dados,
					success:function(data){
					loadRegs(jQuery('#chat-panel'),'data-view-msgs');
					loadRegs(jQuery('#chat-panel-questions'),'data-view-questions');
					},
					error:function(data) {}
			});

			document.getElementById('form-messages').reset();
			return false;
	}	

});