<div id="busca_bancodetalentos"> 
 
 <ul id="menu_busca_bancodetalentos">
     <?php if($this->session->userdata('SessionTipoPessoa')=='F'):?>
        <li id="busca_empregos" <?php echo $this->session->userdata('SessionTipoPessoa')=='F'?'class="active"':'';?>><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>
     <?php endif;?>   
        <?php if(($this->session->userdata('logged_in_Permissao_Juridica')&& strpos($this->session->userdata('SessionAreaPermissoes'),'-3-')||($this->session->userdata('SessionTipoPessoa')=='J'))):?>
        <li id="busca_curriculo" <?php echo $this->session->userdata('SessionTipoPessoa')=='J'?'class="active"':'';?>><span class="title_menu">Buscar Curr&iacute;culo</span> <span class="triangulo_branco"></span></li>    
        <?php endif;?>
  </ul>

  <form id="form_busca_bancodetalentos"  <?php echo $this->session->userdata('SessionTipoPessoa')!='F'?'style="display:none;"':'';?> class="form_busca_vagas" method="post" action="<?php echo site_url('bancodetalentos_busca/vagas');?>">
    <label id="inpt_busca_bancodetalentos" for="">
        <?php if(testa_curriculo($this->session->userdata('SessionIdAluno'))>0):?>
        <input type="text" style="width: 645px;" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa"  onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
        <?php else:?>
        <input type="text" style="width: 645px;" name="" disabled="disabled" placeholder="Palavra chave, cargo ou Empresa"  onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Para buscar, cadastre o seu curriculo">       
      <?php endif;?>
    </label>
  </form>
 

  <form id="form_busca_bancodetalentos" <?php echo $this->session->userdata('SessionTipoPessoa')!='J'?'style="display:none;"':'';?> class="form_busca_curriculos" method="post" action="<?php echo site_url();?>bancodetalentos_busca/curriculo">
    <label id="inpt_busca_bancodetalentos_curriculos" for="">
        <?php if(($this->session->userdata('logged_in_Permissao_Juridica')&& strpos($this->session->userdata('SessionAreaPermissoes'),'-3-')||($this->session->userdata('SessionTipoPessoa')=='J'))):?>
            <input style="width: 475px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
       
        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin:-3px 0 0 20px;" href="<?php echo site_url();?>bancodetalentos_busca/curriculo_busca_avancada">
            
          <span style="width: 150px;">Pesquisa de Curr&ccedil;culos</span><br />
          
          <strong>Busca Avan&ccedil;ada</strong>
        </a>
          <?php else:?>
            <span style="text-align: left;width:300px;">Voc&ecirc; deve estar logado para a pesquisa de curriculo!</span>
         <?php endif;?>    
    </label>
  </form>

    
    
</div>
