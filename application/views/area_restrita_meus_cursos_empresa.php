<?php 
	include("includes/topo.php"); 
?>
            
            
          <?php include("includes/banner-interna.php"); ?>
          

            <div class="content">
            
            <div class="vejaTambemMeusCursos">
            <h1>Cursos em Destaques</h1>


            <?php foreach (destaques() as $destaque): ?>
            
            

              <div id="item-1">
              <div class="side-left" style="margin-right: 15px;">
              <?php if ($destaque->imagem): ?>                
              <?php endif ?>
              <img src="<?php echo $destaque->imagem;?>" width="102" height="62" align="left">
              <div class="mascaraPlayer"></div> 
              <?php if ($destaque->valor!='0.00'): ?>
              
              <div class="boxPreco"><h1><small style="font-size:9px;">Compre por:</small> <br />R$ <?php echo $destaque->valor; ?></h1></div>
              
              <?php endif ?>  
              </div>
                    <div class="boxTexto side-left">
                  <h2><?php echo $destaque->titulo; ?></h2>
                    <p><?php echo $destaque->descricao; ?></p>
                    </div>



                   <div class="boxBotaoComprar"><a href="<?php echo base_url();?>carrinho/inscricao/<?php echo $destaque->id; ?>/<?php echo $destaque->table_name; ?>"><img src="<?php echo base_url();?>assets/img/btn-comprar.png" /></a></div>
                </div>


            <?php endforeach ?>


                <div class="veja-fotos-quem-somos">
                     <a href="<?php echo base_url(); ?>educacao_corporativa/cursos_abertos"> <img src="<?php echo base_url();?>assets/img/ico-veja-fotos.jpg" alt="Ver todos os cursos">Ver todos os cursos</a>
                      </div>
            </div>
            
            
              <div class="content-interna" style="width:780px; background:white;">
             
                <div class="left-cursos equalH-meus-cursos">
                  <div class="miolo-interna">
                  
                     <ul class="lista-meus-cursos">
                       <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>  
                         <li><a href="<?php echo site_url();?>meucadastro/index/J">Meu Cadastro</a> <span>Atualizar</span> </li>
                       <?php endif;?>
                       
                        <li class="selected"><a href="<?php echo site_url();?>area_restrita_meus_cursos_empresa">Nossos Cursos</a></li>
                        
                         <?php if($this->session->userdata('SessionTipoPessoa')=='J'):?>
                            <li ><a href="<?php echo site_url();?>gerenciar_permissoes">Gerenciar Permissões</a></li>
                        <?php endif;?>
                      
                       </ul>
                     
                  </div>	
                </div>
                
                <div class="centerCursos equalH-meus-cursos">
                 <h1>Nossos Cursos</h1>
                 <?php if (isset($cursos)): ?>
                 <?php foreach ($cursos as $item):?>  
                 
                   <div class="curso">
                     <a style="float:left;" href="<?php echo base_url();?>conteudo_curso_empresa/index/<?php echo $item["id_incricoes_empresa"];?>">
                      <img src="<?php echo base_url();?>assets/img/video-thumb-sample.png" width="92" height="56" align="left" style="margin-right:5px;position:absolute;">
                      <div class="mascaraPlayer meus_cursos"></div>
                    </a>
                    
                    <div class="container-header-curso">
                    <a style="text-decoration: none;" href="<?php echo base_url();?>conteudo_curso_empresa/index/<?php echo $item["id_incricoes_empresa"];?>">
                        <h2 style="position:relative; left:2px; width: 600px;display: block;"><?php echo $item["tipo_curso"]?$tipos_cursos[$item["tipo_curso"]]:'-'; ?></h2>
                        <h2 style="position:relative; left:2px; width: 600px;display: block;"><?php echo $item["titulo"];?></h2>
                    </a>
                    <h3 class="meus_cursos">Prof. <?php echo $item["instrutor"];?></h3><br>
                    <p><h3 class="meus_cursos">Curso: <?php echo $tipos_cursos[$item["tipo_curso"]]; ?></h3></p>
                    </div>
                    <div class="datas_meus_cursos">
                    <p class="meus_cursos">Data de Aquisição: <?php echo br_date_time($item["data_aquisicao"]);?></p>
                    <p class="meus_cursos">Data de Conclusão: <?php echo br_date_time($item["data_conclusao"]);?></p> 
                    </div>

                 </div>

                 <?php endforeach;?> 
                 <?php else:?> 
                   Não foi encontrado curso cadastrado!
                 <?php endif;?> 
               
                </div>
               
              </div>
              <div class="rightMeusCursos">
               <?php 
                	//include("includes/coluna-direita-area-restrita.php"); 
                ?>
              </div>
				
            </div>

<?php 
	include("includes/rodape.php"); 
?>
