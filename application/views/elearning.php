<?php
	include("includes/topo.php");
?>


          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">

                <div class="left-internas2">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Educação Corporativa ></a></li>
                        <li><a>E-Learning</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">
                    <h3>E-LEARNING</h3>
                    <div class="txt-interna-servicos">
                     <?php if(isset($pagina) && $pagina): ?>
					        	<?php echo $pagina->texto; ?>
					        <?php endif; ?>


                    </div>

				   <?php if($cursos): ?>
				    <div class="box-search-cursos">
                        <h3 style="width: 445px">CURSOS</h3>
						<form action="<?php echo site_url('educacao_corporativa/elearning'); ?>" method="get">
	                        <input style="float: left;margin-top: 1px;" type="text" name="busca" id="buscarCurso" placeholder="Buscar Curso" class="inputBuscarCurso" />
	                        <input type="submit" name="buscar" id="buscar" class="buttonBuscarCurso" />
	                    </form>
                    </div>
                        
                    <?php if(isset($pagina->arquivo)): ?>
					    <a href="<?php echo isset($pagina) && $pagina->arquivo ? base_url('assets/uploads/'.$pagina->arquivo) : ''; ?>" target="_blank" class="down-programacao">Fazer <span>download</span> de toda a programação</a>
					 <?php endif;?>
                                            <h3>&nbsp;</h3>
                    <div class="txt-interna-servicos">

                    <!-- Inserir paginação -->
                    <div id="paginationdemo" class="demo" style="height:420px;">
                     <div id="p1" class="pagedemo _current" style="width:600px;">

                    	<?php $i = 1; ?>
                    	<?php foreach($cursos as $curso): ?>
							<div class="single-curso-list">
	                        <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $curso->imagem; ?>" width="118" align="left">
	                        	<h1><a href="<?php echo site_url('educacao_corporativa/ver_elearning/'.$curso->id.'/'.$curso->url); ?>"><?php echo $curso->titulo;?></a></h1>
	                            <p><?php echo $curso->descricao;?></p>
	                            <span class="preco">Compre por <h4>R$ <?php echo number_format($curso->valor, 2, ',', '.'); ?></h4></span>
	                            <a href="<?php echo site_url('carrinho/adicionar/'.$curso->id.'/EL'); ?>"><img src="<?php echo base_url(); ?>assets/img/btn-comprar-peq.png"></a>
	                        </div>

	                        <?php if($i % 2 == 0): ?>
	                        	<span class="separador-curso"></span>
	                        <?php endif; ?>

	                    <?php $i++; endforeach; ?>
                        </div>
                        <div class="pagination-courses">
                    <?php echo ($paginacao ? $paginacao : ''); ?>
                    </div>
                       </div>

                    </div>
                    <?php else: ?>
                        <br> Nenhum curso foi encontrado!

                    <?php endif; ?>



                  </div>
                </div>

                <div class="vejaTambem">
					<?php include("includes/veja-tambem.php"); ?>
				</div>
					<?php include("includes/box-destaques.php");?>
              </div>
              <div class="right">
                	<?php
						include("includes/servicos-home.php");
					?>
              </div>





            </div>

<?php
	include("includes/rodape.php");
?>