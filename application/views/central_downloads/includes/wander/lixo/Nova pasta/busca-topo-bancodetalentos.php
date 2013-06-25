<div id="busca_bancodetalentos"> 
  <?php if($this->session->userdata('logged_in_Aluno')):?>
  <ul id="menu_busca_bancodetalentos">    
        <li id="busca_empregos" class="active"><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>   
           <!--
 <li id="busca_curriculo"><span class="title_menu">Buscar Currículo</span> <span class="triangulo_branco"></span></li> -->   
  </ul>

  <form id="form_busca_bancodetalentos"  class="form_busca_curriculos" method="post" action="<?php echo site_url();?>bancodetalentos_busca/vagas">
    <label id="inpt_busca_bancodetalentos" for="">
      <input type="text" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
    </label>
  </form>

    <!--
  <form id="form_busca_bancodetalentos" style="display:none;" class="form_busca_curriculos" method="post" action="<?php echo site_url();?>bancodetalentos_busca/curriculo">
    <label id="inpt_busca_bancodetalentos_curriculos" for="">
      <input style="width: 690px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin: 2px 0 0 20px;" href="">
          <span>Pesquisa de Currículos</span><br />
          <strong>Busca Avançada</strong>
        </a>
    </label>
  </form>-->
<?php endif;?>
    
      <?php if($this->session->userdata('logged_in_Empresa')):?>
  <ul id="menu_busca_bancodetalentos">    
        <!--<li id="busca_empregos"><span class="title_menu">Buscar Empregos</span> <span class="triangulo_branco"></span></li>   -->
        <li id="busca_curriculo" class="active"><span class="title_menu">Buscar Currículo</span> <span class="triangulo_branco"></span></li>    
  </ul>

  <form id="form_busca_bancodetalentos" class="form_busca_curriculos" method="post" action="<?php echo site_url();?>bancodetalentos_busca/curriculo">
    <label id="inpt_busca_bancodetalentos_curriculos" for="">
      <input style="width: 690px;float: left;" type="text" name="palavra_chave" id="inpt_busca_bancodetalentos_curriculos" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa">       
        <a style="float:left;display:block;color:#333; text-decoration:none;font-size: 14px;margin: 2px 0 0 20px;" href="">
          <span>Pesquisa de Currículos</span><br />
          <strong>Busca Avançada</strong>
        </a>
    </label>
  </form>
<!--
  <form id="form_busca_bancodetalentos" style="display:none;" class="form_busca_vagas" method="post" action="<?php echo site_url();?>bancodetalentos_busca/vagas">
    <label id="inpt_busca_bancodetalentos" for="">
      <input type="text" name="palavra_chave" id="" placeholder="Palavra chave, cargo ou Empresa" onblur="if (this.value == '') {this.value = 'Palavra chave, cargo ou Empresa2';}" onfocus="if (this.value == 'Palavra chave, cargo ou Empresa2') {this.value = '';}" name="" value="Palavra chave, cargo ou Empresa2">       
    </label>
  </form>-->

<?php endif;?>
    
    
    
    
</div>
