<?php include("includes/topo.php"); ?>

<?php include("includes/banner-interna.php"); ?>

  <div class="content">
    <div class="content-interna">
      <div class="left-internas" style="width:710px;">
       <div class="breadcrumb">
         <ul>
            <li><a href="<? echo site_url();?>">Home ></a></li>
            <li><a href="<? echo site_url();?>menu_interno">Área Restrita ></a></li>
            <li><a href="<? echo site_url();?>menu_interno">Menu</a></li>
        </ul>
      </div>

      <div class="miolo-interna">
<!--Permissão pessoa fisica inicio-->
<?php if($this->session->userdata('SessionTipoPessoa')=='F'):?>
       <h3 style="padding:20px 0;">Área Pessoal</h3>
       <div class="text-cursos" style="float:left; margin-left:105px;"></div>

       <div class="dashboard-itens">

         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-meu-perfil.png" alt="">
          <div class="content-item-dashboard">
            <h4>Meu Perfil</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>meucadastro/index/F"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-auto-diagnostico.png" alt="">
          <div class="content-item-dashboard">
            <h4>AUTO-diagnóstico</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/F"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

        <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-central-downloads.png" alt="">
          <div class="content-item-dashboard">
            <h4>central de downloads</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url();?>central_downloads/index/F"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-treinamento.png" alt="">
          <div class="content-item-dashboard">
            <h4>treinamento</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>area_restrita_meus_cursos"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-banco-talentos.png" alt="">
          <div class="content-item-dashboard">
            <h4>banco de talentos</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>bancodetalentos/meucurriculo"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-armazenamento-nuvem.png" alt="">
          <div class="content-item-dashboard">
            <h4>armazenamento na nuvem</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url();?>armazenamento_nas_nuvens/index/F"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

       </div>
<?php elseif($this->session->userdata('SessionTipoPessoa')=='J'):?>
<!--Permissão pessoa juridica inicio-->
       <h3 style="padding:20px 0;">Área Empresarial</h3>
       <div class="text-cursos" style="float:left; margin-left:105px;"></div>

       <div class="dashboard-itens">
            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-meu-perfil.png" alt="">
             <div class="content-item-dashboard">
               <h4>PERFIL empresarial</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
             </div>
             <a href="<?php echo site_url();?>meucadastro/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>

            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-auto-diagnostico.png" alt="">
             <div class="content-item-dashboard">
               <h4>AUTO-diagnóstico</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
             </div>
             <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>


        <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-central-downloads.png" alt="">
          <div class="content-item-dashboard">
            <h4>central de downloads</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>central_downloads/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>


            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-treinamento.png" alt="">
             <div class="content-item-dashboard">
               <h4>treinamento</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok </p>
             </div>
             <a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>


         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-banco-talentos.png" alt="">
          <div class="content-item-dashboard">
            <h4>banco de talentos</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas'); ?>"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>

        <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-armazenamento-nuvem.png" alt="">
          <div class="content-item-dashboard">
            <h4>armazenamento na nuvem</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url();?>armazenamento_nas_nuvens/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>
           
           
          <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-pesquisa-online.png" alt="">
          <div class="content-item-dashboard">
            <h4>Pesquisas</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>area_restrita_modulo_de_pesquisa/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>


        </div>
<!--Permissão pessoa juridica fim-->
<?php endif;?>
<!--Permissão pessoa fisica fim-->

<!--Permissão pessoa fisica com permissão juridica inicio-->
<?php if($this->session->userdata('logged_in_Permissao_Juridica')):?>
       <h3 style="padding:20px 0;">Área Empresarial</h3>
       <div class="text-cursos" style="float:left; margin-left:105px;"></div>

       <div class="dashboard-itens">
         <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-meu-perfil.png" alt="">
             <div class="content-item-dashboard">
               <h4>PERFIL empresarial</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
             </div>
             <a href="<?php echo site_url();?>meucadastro/index/J"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>
         <?php endif;?>

         <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-2-')>0):?>
            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-auto-diagnostico.png" alt="">
             <div class="content-item-dashboard">
               <h4>AUTO-diagnóstico</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
             </div>
             <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/FJ"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>
         <?php endif;?>

         <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-4-')>0):?>
        <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-central-downloads.png" alt="">
          <div class="content-item-dashboard">
            <h4>central de downloads</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>central_downloads/index/FJ"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>
         <?php endif;?>

         <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-1-')>0):?>
            <div class="dashboard-item">
             <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-treinamento.png" alt="">
             <div class="content-item-dashboard">
               <h4>treinamento</h4>
               <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok </p>
             </div>
             <a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
            </div>
         <?php endif;?>

       <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-3-')>0):?>
         <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-banco-talentos.png" alt="">
          <div class="content-item-dashboard">
            <h4>banco de talentos</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url('bancodetalentos_empresa/minhas_vagas');?>"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>
       <?php endif;?>

        <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-5-')>0):?>
       <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-armazenamento-nuvem.png" alt="">
          <div class="content-item-dashboard">
            <h4>armazenamento na nuvem</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área</p>
          </div>
          <a href="<?php echo site_url();?>armazenamento_nas_nuvens/index/FJ"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>
        <?php endif;?>          
           
                      
  <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-7-')>0):?>         
          <div class="dashboard-item">
          <img class="icon" src="<?php echo base_url(); ?>assets/img/ico-pesquisa-online.png" alt="">
          <div class="content-item-dashboard">
            <h4>Módulo de Pesquisas</h4>
            <p>Breve descritivo da Área Breve descritivo da Área Breve descritivo da Área ok</p>
          </div>
          <a href="<?php echo site_url();?>area_restrita_modulo_de_pesquisa/index/FJ"><img src="<?php echo base_url(); ?>assets/img/link-acessar-area-restrita.png" alt=""></a>
         </div>
  <?php endif;?>             
           
           
           

       </div>
<?php endif;?>
<!--Permissão pessoa fisica com permissão juridica fim-->

     </div>
   </div>
  </div>
  <div class="right"><?php  include("includes/servicos-home.php"); ?></div>
  </div>

<?php include("includes/rodape.php"); ?>