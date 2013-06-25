<div class="publicacoes">
	<h1>Publicações</h1>
    <div class="box-item">
         
        <ul id="example1" class="accordion">
            <?php if(isset($revista) && $revista): ?>
				<li>
	                <h3>Revista MB</h3>
	                <div class="panel loading">

	                   <div class="box-foto">
	        			<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $revista[0]->imagem; ?>" alt="revista MB" width="105" height="150" />
	            		<span class="borda"></span>
	                   </div>
	                   <div class="descri-publica">
	                     <h4><?php echo $revista[0]->titulo; ?></h4>
	                     <p><?php echo $revista[0]->descricao; ?>
	                     <a href="<?php echo site_url('publicacoes/revistas'); ?>">Ver mais</a>                             
	                     </p>
	                   </div>

	               </div>
	            </li>
	        <?php endif; ?>
                    
                   
                    
                <?php if(isset($artigo) && $artigo): ?>
                <li>
                    <h3>Artigos</h3>
                     <div class="panel loading">

                       <div class="box-foto">
                                    <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $artigo[0]->imagem; ?>" alt="revista MB" width="105" height="150" />
                            <span class="borda"></span>
                       </div>
                       <div class="descri-publica">
                         <h4><?php echo $artigo[0]->titulo; ?></h4>
                         <p><?php echo $artigo[0]->descricao; ?>
                         <a href="<?php echo site_url('publicacoes/ver_artigo/'.$artigo[0]->id.'/'.$artigo[0]->titulo); ?>">Ver mais</a>
                         </p>
                       </div>

                   </div>
                </li>
            <?php endif; ?>
                    
                    
                    
                    

	        
	        <?php if(isset($pesquisa) && $pesquisa): ?>
	            <li>
	                <h3>Pesquisas e Estudos</h3>
	                 <div class="panel loading">

	                   <div class="box-foto">
	        			<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $pesquisa[0]->imagem; ?>" alt="revista MB" width="105" height="150" />
	            		<span class="borda"></span>
	                   </div>
	                   <div class="descri-publica">
	                     <h4><?php echo $pesquisa[0]->titulo; ?></h4>
	                     <p><?php echo $pesquisa[0]->descricao; ?>	                     
                             <a href="<?php echo site_url('publicacoes/ver_pesquisas_estudos/'.$pesquisa[0]->id.'/titulo'); ?>">Ver mais</a>
	                     </p>
	                   </div>

	               </div>
	            </li>
	        <?php endif; ?>
        </ul>
    </div>
</div>