<?php
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
?>


<?php include("includes/banner-interna.php"); ?>

<div class="content">

    <div class="menuAreaRestrita">
    <h1>Área Restrita</h1>
    <ul>
      <li><a href="#">Cursos</a></li>
      <li class="selected"><a href="#">Banco de Talentos</a></li>
      <li><a href="#">Auto Diagnóstico</a></li>
      <!--
      <li><a href="#">Central de Downloads</a></li>
      <li><a href="#">Gerenciamento de Usuários</a></li>
      <li><a href="#">Armazenamento na Nuvem</a></li>
      -->
    </ul>
    </div>


    <?php include('includes/busca-topo-bancodetalentos.php'); ?>

    <div class="content-interna" style="width:990px; background:white;">

    <!-- Left Sidebar -->
     <div class="left-cursos equalH-meus-cursos">
        <div class="miolo-interna">
         <?php include("includes/banco_de_talentos/menu_left.php"); ?>
       </div>
     </div>

     <form id="form_cadastro_de_vagas" method="post" action="<?php echo site_url('bancodetalentos_empresa/salvar_vaga'); ?>">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <h1>Vagas</h1>

      <div id="cadastrar_vagas" class="holder_cadastro_curriculo">

        <label for="titulodocargo_cadastrar_vagas"><span>Título do Cargo </span>
        <input type="text" name="titulo_cargo" id="titulodocargo_cadastrar_vagas" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" value="<?php echo (isset($registro) ? $registro->titulo_cargo : ''); ?>"/>
        </label>

        <label for="titulodocargo_cadastrar_vagas"><span>Breve Descrição da Vaga</span>
        <textarea name="descricao" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->descricao : ''); ?></textarea></label>
		</label>

		<h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:3px;width: 104px;">Nível de Atuação</h3>
        <div class="first_col">
        	<?php foreach($niveis_atuacao as $nivel_id => $nivel_nome): ?>
            	<label for="" class="inpt_checkbox"><input type="radio" name="niveis_de_atuacao_id_nivel" id="" value="<?php echo $nivel_id; ?>" <?php echo isset($registro) && $registro->niveis_de_atuacao_id_nivel == $nivel_id  ? 'Checked' : '' ;?> ><span><?php echo $nivel_nome; ?></span></label>
            <?php endforeach; ?>
        </div>

        <div class="secound_col hidden-bg">
        	<label style="position: relative;top: -9px;" class="to-left" for="qt_de_vagas_cadastrar_vagas"><span>Quantidade de Vaga </span>
        	<input type="text" name="quantidade_vagas" id="qt_de_vagas_cadastrar_vagas" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" value="<?php echo (isset($registro) ? $registro->quantidade_vagas : ''); ?>" /></label>
        </div>

        <hr class="hr_sep" style="position: relative; top:-10px;" />

        <div class="num-col-2 clear-both"><span class="label-cols">Área de Atuação </span>

        <?php $i = 1; ?>
        <?php foreach($areas_atuacao as $id_area => $area_atuacao): ?>

			<?php if($i % 12 == 0 || $i == 1): ?>
        		<div class="col">
        	<?php endif; ?>

			<label for="" class="inpt_checkbox">
				<input type="checkbox" name="areas_atuacao[]" id="areas_atuacao" value="<?php echo $id_area ?>" <?php if(isset($areas_atuacao_vagas) && in_array($id_area, $areas_atuacao_vagas)): ?> checked="checked" <?php endif; ?>><span><?php echo $area_atuacao; ?></span>
			</label>

			<?php if($i % 11 == 0): ?>
				</div>
			<?php endif; ?>
			<?php $i++; ?>
		<?php endforeach; ?>

        </div>

        <hr class="hr_sep" style="margin-bottom: 24px;" />

        <label for="" class="to-left"><span>Cursos de Formação </span>
        	<textarea name="curso_formacao" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->curso_formacao : ''); ?></textarea>
        </label>

        <label for="" class="to-left"><span>Qualificação (outros cursos importantes)</span>
        	<textarea name="outros_cursos" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->outros_cursos : ''); ?></textarea>
        </label>

        <div class="num-col-2 clear-both">
          <span class="label-cols">Experiência</span>
          <div class="col" style="width: 155px;">
           <input type="text" name="experiencia" id="experiencia" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" value="<?php echo (isset($registro) ? $registro->experiencia : ''); ?>"/>
          </div>

          <span class="label-cols">Faixa Salarial</span>
          <div class="col" style="width: 140px;">

          	<?php foreach($pretensoes_salariais as $pretensao_id => $pretensao_nome): ?>
            	<label for="" class="inpt_checkbox">
            	<input type="radio" name="pretensao_salarial_id" id="" value="<?php echo $pretensao_id; ?>" <?php echo isset($faixa_salarial) && $faixa_salarial == $pretensao_id  ? 'Checked' : '';?> ><span><?php echo $pretensao_nome; ?></span></label>
            <?php endforeach; ?>

            <label for="" class="inpt_checkbox">
            <input type="checkbox" name="exibir_faixa_salarial" id="" value="N" <?php echo isset($registro) && $registro->exibir_faixa_salarial == 'N' ? 'Checked' : ''; ?> ><span>Não exibir faixa salarial oferecida</span></label>
          </div>
        </div>

        <label for=""><span>Habilidade e conhecimentos necessários</span>
        	<textarea name="conhecimentos_necessarios" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->conhecimentos_necessarios : ''); ?></textarea>
        </label>

        <div class="num-col-2 clear-both">
        	<span class="label-cols">Idiomas</span>
        	<div class="col">
		        <?php $x = 0; ?>
		        <?php foreach ($idiomas_vagas as $idioma_vaga):?>

		            <div class="idioma_origin set_idioma_add">
		                <select name="idioma[]" id="">
		                	<?php foreach($idiomas as $idioma): ?>
		                    	<option value="<?php echo $idioma->id_idioma;?>" <?php echo isset($idioma_vaga->idiomas_id_idioma) && $idioma->id_idioma == $idioma_vaga->idiomas_id_idioma ? 'selected' : ''; ?> class="idioma-lang <?php echo ($x==0) ? 'first' : '' ; ?>"><?php echo $idioma->nome_idioma;?></option>
		                	<?php endforeach; ?>
						</select>

		               <?php echo form_dropdown("idioma_leitura[]", array('' => 'Leitura') + $niveis_idiomas, set_value("nivel_leitura", (isset($idioma_vaga->nivel_leitura) ? $idioma_vaga->nivel_leitura : "")), "id=\"nivel_leitura\" "); ?>
		               <?php echo form_dropdown("idioma_escrita[]", array('' => 'Escrita') + $niveis_idiomas, set_value("nivel_escrita", (isset($idioma_vaga->nivel_escrita) ? $idioma_vaga->nivel_escrita : "")), "id=\"nivel_escrita\" "); ?>
		               <?php echo form_dropdown("idioma_conversacao[]", array('' => 'Conversação') + $niveis_idiomas, set_value("nivel_conversacao", (isset($idioma_vaga->nivel_conversacao) ? $idioma_vaga->nivel_conversacao : "")), "id=\"nivel_conversacao\" "); ?>
		          </div>

		        	<?php $x++; ?>

		        <?php endforeach;?>
		        <div class="add_idioma"></div>
		        <a id="btn_add_idioma" class="btn_add_modulo" href="">+ Incluir outro idioma</a>
          </div>
      </div>

        <h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:3px;">Formação</h3>
        <div class="first_col">
            <?php foreach($graus_formacao as $grau_id => $grau_nome): ?>
            	<label for="" class="inpt_checkbox">
            	<input type="radio" name="grau_formacao" id="" value="<?php echo $grau_id; ?>" <?php echo isset($registro) && $registro->grau_formacao == $grau_id  ? 'Checked' : '' ;?> ><span><?php echo $grau_nome; ?></span></label>
            <?php endforeach; ?>
        </div>

        <div class="secound_col hidden-bg">
	        <label for="" class="to-left" style="position: relative;top: -10px;"><span>Benefícios Oferecidos </span>
	        	<textarea name="beneficios" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->beneficios : ''); ?></textarea>
	        </label>

	        <label for="" class="to-left"><span>Horário de Trabalho</span>
	        	<input type="text" name="horario" id="horario" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" value="<?php echo (isset($registro) ? $registro->horario : ''); ?>"/>
			</label>

			 <label for="" class="to-left"><span>Regime de Contratação</span>
	        	<?php echo form_dropdown("regime_contratacao", $tipos_contrato, set_value("regime_contratacao", (isset($registro) ? $registro->regime_contratacao : "")), "id=\"regime_contratacao\" class=\"inpt_cadastro_curriculo small_inpt_cadastro_curriculo\" "); ?>
			</label>
        </div>

        <label class="clear-both" for=""><span>Informações Adicionais</span>
        <textarea name="informacoes_adicionais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" id="" cols="30" rows="5"><?php echo (isset($registro) ? $registro->informacoes_adicionais : ''); ?></textarea></label>

        <div class="set" style="border-top: 1px solid #ddd;margin-top: 20px;padding-top: 10px;">
        <h3 class="clear-both" style="margin: 0;top: 21px;font-size: 13px; padding-left:67px;width: 36px;">Sexo</h3>
        <div class="first_col">
            <?php echo form_dropdown("sexo", array('I' => 'Indiferente', 'F' => 'Feminino', 'M' => 'Masculino'), set_value("sexo", (isset($registro) ? $registro->sexo : "")), "id=\"sexo\" class=\"inpt_cadastro_curriculo small_inpt_cadastro_curriculo\" "); ?>
        </div>
        <div class="secound_col_custom hidden-bg">
            <span style="position:relative;top:1px;padding-left: 12px;font-size:13px;">Idade</span>

            <label class="to-right clear-both" for="">
              <small>De</small>
              <input style="width: 54px;" class="inpt_cadastro_curriculo" size="5" type="text" name="idade_minima" id="" value="<?php echo (isset($registro) ? $registro->idade_minima : ''); ?>"> <small>anos até</small>
              <input style="width: 58px;" class="inpt_cadastro_curriculo" size="5" type="text" name="idade_maxima" id="" value="<?php echo (isset($registro) ? $registro->idade_maxima : ''); ?>">
            </label>
        </div>
        </div>

      </div>

      <div>

      	<input name="id_vaga" id="id_vaga" type="hidden" value="<?php echo isset($registro) ? $registro->id_vaga : ''; ?>" class="" />

        <input class="salvar_cadastro_curriculo" type="submit" value="Salvar" />
      </div>

     </div>
      </form>

     <!-- Right Sidebar -->
     <div class="rightMeusCursos">
         <?php include("includes/banco_de_talentos/menu_right.php"); ?>
     </div>

   </div>


 </div>

 <?php
 include("includes/rodape.php");
 ?>