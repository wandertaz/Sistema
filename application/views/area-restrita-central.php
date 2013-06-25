
<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
           
            <div class="content">
            
            <div class="menuAreaRestrita">
            <h1>Área Restrita</h1>
            
            <!--<ul>
            	                <li><a href="#">Banco de Talentos</a></li>
<li class="selected"><a href="#">Cursos</a></li>
                <li><a href="#">Auto Diagnóstico</a></li>
                <li><a href="#">Central de Downloads</a></li>
                <li><a href="#">Gerenciamento de Usuários</a></li>
                <li><a href="#">Armazenamento na Nuvem</a></li>
            </ul>-->
            <?php
                include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'menu-area-restrita.php';
            ?>
            </div>
            <div class="breadcrumb" style="background-color:white;">
                       <ul style="padding:5px 0 5px 0;">
                        <li><a href="<? echo site_url();?>">Home ></a></li>
                        <li><a href="<? echo site_url();?>menu_interno">Área Restrita ></a></li>
                        <li><a href="<? echo site_url();?>menu_interno">Menu</a></li>
                       </ul>
             </div>
              <div class="content-interna" style="width:780px; background:white;">
             
                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                  
                  <ul class="lista-meus-cursos">
                     <!--  <li class="selected"><a href="#">Conteúdo</a>
                           <span>
                               <a href="<?php echo site_url();?>conteudo_curso_empresa/programacao">Programação</a>
                           </span>
          
                       </li>
                       <li ><a href="<?php echo site_url();?>gerenciarinscritos">Gerenciar Inscritos</a></li>
                       <li ><a href="<?php echo site_url();?>area_restrita_notas_empresa">Notas e Frequência</a></li> 
                       <li><a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Nossos Cursos</a></li>-->
                    
                  </ul>
                     
                  </div>	
                </div>
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Menu central</h1>
                 <?php if($this->session->userdata('SessionTipoPessoa')=='F'):?>
                 Menu&nbsp;&nbsp;
                    <a href="<?php echo site_url();?>area_restrita_meus_cursos">Cursos</a>&nbsp;&nbsp;
                    <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/F">Auto Diagnóstico</a>&nbsp;&nbsp;
                    <a href="<?php echo site_url();?>bancodetalentos/meucurriculo">Banco de Talentos</a> 
                  <?php elseif($this->session->userdata('SessionTipoPessoa')=='J'):?>
                 Menu&nbsp;&nbsp;
                    <a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Cursos</a>&nbsp;&nbsp;
                    <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/J">Auto Diagnóstico</a>&nbsp;&nbsp;
                    <a href="#">Banco de Talentos</a>
                    
                    <a href="<?php echo site_url();?>"></a>
                    <a href="<?php echo site_url();?>"></a>
                 <?php endif;?>
                    <br>
                    

                  <?php if($this->session->userdata('logged_in_Permissao_Juridica')=='F'):?>
                    Menu-empresa&nbsp;&nbsp;
                        
                         <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-1-')>0):?>
                            <a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Cursos</a>&nbsp;&nbsp;
                        <?php endif;?>
                        <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-2-')>0):?>
                            <a href="<?php echo site_url();?>area_restrita_autodiagnosticos/index/FJ">Auto Diagnóstico</a>&nbsp;&nbsp;
                        <?php endif;?>
                        <?php if(strpos($this->session->userdata('SessionAreaPermissoes'),'-3-')>0):?>
                            <a href="#">Banco de Talentos</a>
                        <?php endif;?>
                    
                    <?php endif;?>
                    
                    
                </div>
                
              </div>
                <div class="rightMeusCursos">&nbsp;
                	
              </div>
        
               
                        
                   
				
				
				
				
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>
