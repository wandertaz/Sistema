<?php
	include("includes/topo.php");
?>

          <?php include("includes/banner-interna.php"); ?>

            <div class="content">
              <div class="content-interna">

                <div class="left-internas">
                  <div class="breadcrumb">
                       <ul>
                        <li><a href="<?php echo site_url(); ?>">Home ></a></li>
                        <li><a>Publicações ></a></li>
                        <li><a href="<?php echo site_url('publicacoes/revistas'); ?>">Periódicos</a></li>
                       </ul>
                  </div>
                  <div class="miolo-interna">

                    <h3 style="color:#ff3600;">Periódicos</h3>
                    <div class="txt-interna">
                     <?php if(isset($pagina) && $pagina): ?>
                     	<?php echo $pagina->texto; ?>
                     <?php endif; ?>

					<?php if($ultimas_revistas): ?>
	                     <div class="revista-buscar">
	                     	<form action="<?php echo site_url('publicacoes/revistas'); ?>" method="post" >
			                     <select name="cmbRevista" style="float:left; margin-top:5px;">
			                     	<?php foreach($ultimas_revistas as $ultima): ?>
				                     	<option value="<?php echo $ultima->id; ?>" ><?php echo $ultima->data; ?></option>
				                     <?php endforeach; ?>
			                     </select>
			                     <input type="submit" name="buscar" id="buscar" value="" class="botao">
	                    	 </form>
	                     </div>
	                 <?php endif; ?>

					<?php if($revista): ?>

	                     <p>&nbsp;</p>
	                     <div class="box-foto" style="float:left;"><img img src="<?php echo base_url(); ?>assets/uploads/<?php echo $revista[0]->imagem; ?>" alt="Preview" width="180" height="258" align="left"/>
	                     <span class="borda" style="position:relative; left:0px; top:0px;"></span>
	                     </div>

	                     <div class="texto-interna-revistas">
	                     <h4><?php echo $revista[0]->data; ?></h4><?php echo $revista[0]->descricao; ?>
						<a href="<?php echo base_url(); ?>assets/uploads/<?php echo $revista[0]->arquivo; ?>" target="_blank" class="down-programacao" style="float:left; border-top:thin solid #111; background-position-y:10px; padding-top:10px; margin-top:10px;">Fazer <span>download</span> da Revista</a>
	                     </div>

	                     </p>
	                     <div class="veja-fotos-quem-somos" style="color:#ff3600;">
	                     <a href="<?php echo $revista[0]->link; ?>" target="_blank" style="color:#ff3600;"> <img img src="<?php echo base_url(); ?>assets/img/eye-red.png" alt="Ver a Revista MB"/>Ver a Revista MB</a>
	                      </div>


                    <?php endif; ?>
 					</div>
                  </div>
                </div>
                <div class="center2">
                 <div id="destaques" style="border:none;">
                  	<?php if($ultimos_artigos): ?>
					  <div class="depoimentos">
	                     <h4>ÚLtiMAS PUBLICAÇÕES</h4>
	                     <h5>Artigos</h5>
	                     	<?php foreach($ultimos_artigos as $artigo): ?>
								 <h6><?php echo $artigo->titulo; ?></h6>
			                     <p class="ultimosArtigos"><?php echo $artigo->descricao; ?>
			                    <a href="<?php echo site_url('publicacoes/ver_artigo/'.$artigo->id.'/'.$artigo->url); ?>" ><img img src="<?php echo base_url(); ?>assets/img/btn-leia-mais-vermelho-preto.png"></p></a>
							<?php endforeach; ?>
	                  </div>
	              <?php endif; ?>
                 </div>
                </div>
                <div class="vejaTambemPublicacoes">
					<?php include("includes/veja-tambem-publicacoes-revistas.php"); ?>
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