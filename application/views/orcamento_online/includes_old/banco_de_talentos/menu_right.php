<div class="rightMeusCursos">

	<?php
        $CI =& get_instance();
        
            if ($CI->session->userdata('SessionIdEmpresa')>0){
                //Id da empresa 
                $enterprise= $CI->session->userdata('SessionIdEmpresa'); 
             }elseif($CI->session->userdata('SessionEmpresaPermissoes')>0){
                //Id da empresa 
                $enterprise= $CI->session->userdata('SessionEmpresaPermissoes');     
             }

	 ?>
	 <?php if ($enterprise!=false ): ?>
    	<h1>Currículos Recebidos</h1>
    	<ul id="curriculos_recebidos">
    		<?php exibir_curriculos_recebidos(); ?>
    	</ul>
    	<a href="<?php echo site_url('bancodetalentos_empresa/curriculos_recebidos'); ?>"><img class="btn_ver_curriculos" src="<?php echo base_url()?>assets/img/ver-curriculos.png" alt="Ver Currículos"></a>
	 <?php endif ?>

</div>