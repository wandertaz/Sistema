
<?php
//echo $_SERVER['DOCUMENT_ROOT'].'/mbconsultoria/application/views/includes/topo.php';
//include $_SERVER['DOCUMENT_ROOT'].'/site/application/views/includes/topo.php';
include $_SERVER['DOCUMENT_ROOT'].URL_VIEW_INCLUDES.'topo.php';
//include('includes/topo.php');
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

     <form id="form_cadastro_curriculo" method="post" action="<?php echo site_url()?>bancodetalentos/salvarcurriculo">
     <div class="centerCursos equalH-meus-cursos bancodetalentos_content">
      <h1>Cadastro de Curr&iacute;culo</h1>
      <div class="holder_cadastro_curriculo">


      </div>


      <span class="seta-bancodetalentos seta-right"></span><span class="seta-bancodetalentos seta-left"></span>

      <div id="menu-cadastro-curriculo">
        <ul id="bancodetalentos_menu_cadastro">
          <li><a class="bancodetalentos_bg_menu_cadastro dados_pessoais selected" href="#dados_pessoais"></a></li>
          <li><a class="bancodetalentos_bg_menu_cadastro formacao_academica" href="#formacoes_academicas"></a></li>
          <li><a class="bancodetalentos_bg_menu_cadastro historico_profissional" href="#historico_profissional"></a></li>
          <li><a class="bancodetalentos_bg_menu_cadastro referencias_profissionais" href="#referencias_profisionais"></a></li>
          <li><a class="bancodetalentos_bg_menu_cadastro objetivos_profissionais" href="#objetivos_profissionais"></a></li>
        </ul>
      </div>




      <!-- Dados Pessoais -->
      <div id="dados_pessoais" class="holder_cadastro_curriculo container_page_cadastro_curriculo">
          <label for="email_dados_pessoais"><span>E-mail* </span><input type="text" disabled="disabled" value="<?php echo $dadosaluno[0]->email;?>" name="email_dados_pessoais" id="email_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="nome_dados_pessoais"><span>Nome Completo* </span><input type="text" value="<?php echo $dadosaluno[0]->nome;?>" name="nome_dados_pessoais" id="nome_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="nascimento_dados_pessoais" class="to-left"><span>Nascimento* </span><input type="text" value="<?php echo br_date($dadosaluno[0]->data_nascimento);?>" name="nascimento_dados_pessoais" id="nascimento_dados_pessoais" class="data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="idade_dados_pessoais" class="to-left"><span>Idade </span><input type="text" disabled="disabled" value="<?php echo $dadosaluno[0]->data_nascimento!=''? calculaidade(br_date($dadosaluno[0]->data_nascimento)):'';?>" name="idade_dados_pessoais" id="idade_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="sexo_dados_pessoais" class="clear-both"><span>Sexo* </span>
          <select name="sexo_dados_pessoais" id="sexo_dados_pessoais" class="inpt_cadastro_curriculo big_select_cadastro_curriculo">
              <option value="M" <?php echo  $dadosaluno[0]->sexo=='M'?'selected':''; ?> >Masculino</option>
            <option value="F" <?php echo  $dadosaluno[0]->sexo=='F'?'selected':''; ?>>Feminino</option>
          </select>
        </label>
        <label for="tel_dados_pessoais" class="to-left"><span>Telefone* </span><input type="text" value="<?php echo $dadosaluno[0]->telefone;?>" name="tel_dados_pessoais" id="tel_dados_pessoais" class="phone inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="cel_dados_pessoais" class="to-left"><span>Celular </span><input type="text"  value="<?php echo $dadosaluno[0]->celular;?>" name="cel_dados_pessoais" id="cel_dados_pessoais" class="phone inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>

        <label for="estado_civil_dados_pessoais" class="to-left"><span>Estado Civil </span>
          <select name="estado_civil_dados_pessoais" id="estado_civil_dados_pessoais" class="inpt_cadastro_curriculo small_select_cadastro_curriculo">
             <option value="" <?php echo $dadosaluno[0]->estadocivil==''?'selected':''; ?>>Selecione</option>
            <option value="S" <?php echo $dadosaluno[0]->estadocivil=='S'?'selected':''; ?>>Solteiro(a)</option>
            <option value="C" <?php echo $dadosaluno[0]->estadocivil=='C'?'selected':''; ?>>Casado(a)</option>
            <option value="D" <?php echo $dadosaluno[0]->estadocivil=='D'?'selected':''; ?>>Divorciado(a)</option>
            <option value="V" <?php echo $dadosaluno[0]->estadocivil=='V'?'selected':''; ?>>Viúvo(a)</option>

          </select>
        </label>
        <label for="religiao_dados_pessoais" class="to-left"><span>Religião </span><input type="text" value="<?php echo $dadosaluno[0]->religiao;?>" name="religiao_dados_pessoais" id="religiao_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>


        <label for="cep_dados_pessoais" class="to-left clear-both"><span>CEP* </span><input type="text" value="<?php echo $dadosaluno[0]->cep;?>" name="cep_dados_pessoais" id="cep_dados_pessoais" class="cep inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="endereco_dados_pessoais" class="to-left clear-both"><span>Endereço* </span><input type="text" value="<?php echo $dadosaluno[0]->endereco;?>"name="endereco_dados_pessoais" id="endereco_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="num_dados_pessoais" class="to-left"><span>Número* </span><input type="text" value="<?php echo $dadosaluno[0]->numero;?>" name="numero_dados_pessoais" id="endereco_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="bairro_dados_pessoais" class="to-left"><span>Bairro* </span><input type="text" value="<?php echo $dadosaluno[0]->bairro;?>"name="bairro_dados_pessoais" id="bairro_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="cidade_dados_pessoais" class="to-left"><span>Cidade* </span><input type="text" value="<?php echo $dadosaluno[0]->cidade;?>" name="cidade_dados_pessoais" id="cidade_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="estado_dados_pessoais" class="to-left"><span>Estado* </span><input type="text" value="<?php echo $dadosaluno[0]->estado;?>" name="estado_dados_pessoais" id="estado_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="filhos_dados_pessoais" class="to-left"><span>Filhos </span>
          <select name="filhos_dados_pessoais" id="filhos_dados_pessoais" class="inpt_cadastro_curriculo small_select_cadastro_curriculo">
              <option value="" <?php echo $dadosaluno[0]->filhos==''?'selected':''; ?>>Selecione</option>
              <option value="N" <?php echo $dadosaluno[0]->filhos=='N'?'selected':''; ?>>Não</option>
              <option value="S" <?php echo $dadosaluno[0]->filhos=='S'?'selected':''; ?>>Sim</option>
          </select>
        </label>
        <label for="quantos_filhos_dados_pessoais" class="to-left"><span>Quantos? </span><input type="text" value="<?php echo $dadosaluno[0]->filhos=='S'?$dadosaluno[0]->qtd_filhos:'';?>" name="quantos_filhos_dados_pessoais" id="quantos_filhos_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="cnh_dados_pessoais" class="to-left clear-both" ><span>CNH </span>
          <select name="cnh_dados_pessoais" id="cnh_dados_pessoais" class="inpt_cadastro_curriculo small_select_cadastro_curriculo">
            <option value="" <?php echo $dadosaluno[0]->cnh==''?'selected':''; ?>>Selecione</option>
            <option value="N" <?php echo $dadosaluno[0]->cnh=='N'?'selected':''; ?>>Não</option>
            <option value="S" <?php echo $dadosaluno[0]->cnh=='S'?'selected':''; ?>>Sim</option>
          </select>
        </label>
        <label for="veiculo_dados_pessoais" class="to-left"><span>Veículo </span>
          <select name="veiculo_dados_pessoais" id="veiculo_dados_pessoais" class="inpt_cadastro_curriculo small_select_cadastro_curriculo">
              <option value="" <?php echo $dadosaluno[0]->veiculo==''?'selected':''; ?>>Selecione</option>
              <option value="N" <?php echo $dadosaluno[0]->veiculo=='N'?'selected':''; ?>>Não</option>
              <option value="S" <?php echo $dadosaluno[0]->veiculo=='S'?'selected':''; ?>>Sim</option>
          </select>
        </label>
       <label for="deficiente_dados_pessoais" class="to-left"><span>Portador de necessidades especiais </span>
          <select name="deficiente_dados_pessoais" id="deficiente_dados_pessoais" class="inpt_cadastro_curriculo small_select_cadastro_curriculo">
            <option value="" <?php echo $dadosaluno[0]->deficiencia==''?'selected':''; ?>>Selecione</option>
            <option value="N" <?php echo $dadosaluno[0]->deficiencia=='N'?'selected':''; ?>>Não</option>
            <option value="S" <?php echo $dadosaluno[0]->deficiencia=='S'?'selected':''; ?>>Sim</option>
          </select>
        </label>
        <label for="qual_deficiencia_filhos_dados_pessoais" class="to-left"><span>Se sim, qual? </span><input type="text" value="<?php echo $dadosaluno[0]->deficiencia=='S'?$dadosaluno[0]->qual_deficiencia:'';?>" name="qual_deficiencia_filhos_dados_pessoais" id="qual_deficiencia_filhos_dados_pessoais" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="facebook_dados_pessoais" class="clear-both"><span class="social_icons fb"></span><input type="text" value="<?php echo $dadosaluno[0]->link_facebook;?>" name="facebook_dados_pessoais" id="facebook_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="twitter_dados_pessoais"><span class="social_icons tw"></span><input type="text"  value="<?php echo $dadosaluno[0]->link_twitter;?>" name="twitter_dados_pessoais" id="twitter_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="linkedin_dados_pessoais"><span class="social_icons in"></span><input type="text" value="<?php echo $dadosaluno[0]->link_linkedin;?>" name="linkedin_dados_pessoais" id="linkedin_dados_pessoais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
      </div>

      <!-- Formações Acadêmicas -->
      <div id="formacoes_academicas" class="holder_cadastro_curriculo container_page_cadastro_curriculo">
        <?php
            $x=0;
            foreach ($formacaoacademica as $itens):
                 $x=$x+1;

                ?>

        <div class="formacao_academica_origin origins set_formacao_academica_add">
        <div class="num-col-2"><span class="label-cols">Grau de Formação</span>
          <div class="col">

            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='EF'?'checked':'':''; ?> value="EF" id=""><span>Ensino Fundamental</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='EM'?'checked':'':''; ?> value="EM" id=""><span>Ensino Médio</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='GR'?'checked':'':''; ?> value="GR" id=""><span>Graduação</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='PG'?'checked':'':''; ?> value="PG" id=""><span>Pós-graduação/ MBA</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='ME'?'checked':'':''; ?> value="ME" id=""><span>Mestrado</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="grau_formacao_<?php echo $x;?>" <?php echo $itens['vazio']==0? $itens['grau_formacao']=='DO'?'checked':'':''; ?> value="DO" id=""><span>Doutoria</span></label>
          </div>

        </div>

        <div class="num-col-2"><span class="label-cols">Status do Curso</span>

        <div class="col">
            <label for="" class="inpt_checkbox"><input type="radio" name="status_curso_<?php echo $x;?>" <?php echo $itens['vazio']==0?$itens['status']=='IN'?'checked':'':''; ?> value="IN" id="IN"><span>Interrompido</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="status_curso_<?php echo $x;?>" <?php echo $itens['vazio']==0?$itens['status']=='CO'?'checked':'':''; ?> value="CO" id="CO"><span>Completo</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="status_curso_<?php echo $x;?>" <?php echo $itens['vazio']==0?$itens['status']=='CU'?'checked':'':''; ?> value="CU" id="CU"><span>Cursando</span></label>
          </div>
        </div>
              <label for=""><span>Nome do Curso </span><input type="text" value="<?php echo $itens['vazio']==0? $itens['nome_curso']:'';?>" name="nomedocurso_form_academica_<?php echo $x;?>" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for=""><span>Instituição </span><input type="text"  value="<?php echo $itens['vazio']==0? $itens['instituicao']:'';?>" name="instituicao_form_academica_<?php echo $x;?>" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Início </span><input   value="<?php echo $itens['vazio']==0? br_date($itens['data_inicio']):'';?>" type="text" name="inicio_form_academica_<?php echo $x;?>" class="data_nascimento data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Conclusão</span><input value="<?php echo $itens['vazio']==0?br_date($itens['data_conclusao']):'';?>" type="text" name="conclusao_form_academica_<?php echo $x;?>" class="data_nascimento data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        </div>
          <?php

            endforeach;

          ?>
          <input type="hidden" name="controleformacaoacademica" id="controleformacaoacademica" value="<?php echo $x;?>">
        <div class="add_formacao_academica"></div>
        <a id="btn_add_formacao_academica" class="btn_add_modulo" href="">+ Incluir outra formação</a>


        <h3 class="clear-both">Idioma</h3>
        <?php $x = 0; ?>
        <?php foreach ($idiomas as $itens):?>

            <div class="idioma_origin set_idioma_add">
                <select name="idioma[]" id="">
                  <?php foreach ($idiomas_lista as $itens_lista):?>
                    <option value="<?php echo$itens_lista->id_idioma;?>" <?php echo $itens_lista->id_idioma==$itens['id_idioma']?'selected':'';?> class="idioma-lang <?php echo ($x==0) ? 'first' : '' ; ?>"><?php echo$itens_lista->nome_idioma;?></option>
                  <?php endforeach;?>
                </select>
               <select name="idioma_leitura[]" id="">
                  <option value="" <?php echo $itens['nivel_leitura']==''?'selected':$itens['nivel_leitura']==''?'selected':'';?>>Leitura</option>
                  <option value="N" <?php echo $itens['nivel_leitura']=='N'?'selected':'';?>>Nenhum</option>
                  <option value="B" <?php echo $itens['nivel_leitura']=='B'?'selected':'';?>>Básica</option>
                  <option value="I" <?php echo $itens['nivel_leitura']=='I'?'selected':'';?>>Intermediária</option>
                  <option value="A" <?php echo $itens['nivel_leitura']=='A'?'selected':'';?>>Avançada</option>
                  <option value="F" <?php echo $itens['nivel_leitura']=='F'?'selected':'';?>>Fluente</option>
                </select>
                <select name="idioma_escrita[]" id="">
                  <option value="" <?php echo $itens['nivel_escrita']==''?'selected':''?'selected':'';?>>Escrita</option>
                  <option value="N" <?php echo $itens['nivel_escrita']=='N'?'selected':'';?>>Nenhum</option>
                  <option value="B" <?php echo $itens['nivel_escrita']=='B'?'selected':'';?>>Básica</option>
                  <option value="I" <?php echo $itens['nivel_escrita']=='I'?'selected':'';?>>Intermediária</option>
                  <option value="A" <?php echo $itens['nivel_escrita']=='A'?'selected':'';?>>Avançada</option>
                  <option value="F" <?php echo $itens['nivel_escrita']=='F'?'selected':'';?>>Fluente</option>
                </select>
                <select name="idioma_conversacao[]" id="">
                  <option value="" <?php echo $itens['nivel_conversacao']==''?'selected':$itens['nivel_conversacao']==''?'selected':'';?>>Conversação</option>
                  <option value="N" <?php echo $itens['nivel_conversacao']=='N'?'selected':'';?>>Nenhum</option>
                  <option value="B" <?php echo $itens['nivel_conversacao']=='B'?'selected':'';?>>Básica</option>
                  <option value="I" <?php echo $itens['nivel_conversacao']=='I'?'selected':'';?>>Intermediária</option>
                  <option value="A" <?php echo $itens['nivel_conversacao']=='A'?'selected':'';?>>Avançada</option>
                  <option value="F" <?php echo $itens['nivel_conversacao']=='F'?'selected':'';?>>Fluente</option>
                </select>
          </div>

        <?php $x++; ?>

        <?php endforeach;?>
        <div class="add_idioma"></div>
        <a id="btn_add_idioma" class="btn_add_modulo" href="">+ Incluir outro idioma</a>





        <h3 class="clear-both">Cursos Complementares</h3>
        <?php
            foreach ($cursoscomplementares as $itens):
         ?>
        <div id="formacao_academica_origin_complementar" class="origins">
            <label for=""><span>Nome do Curso </span><input type="text" value="<?php echo $itens['vazio']==0? $itens['nome_curso']:'';?>" name="nomedocurso_complementar_form_academica[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Carga Horária </span><input type="text" value="<?php echo $itens['vazio']==0? $itens['carga_horaria']:'';?>" name="carga_horaria_complementar_form_academica[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Cidade/ País</span><input type="text" value="<?php echo $itens['vazio']==0? $itens['cidade_pais']:'';?>" name="cidade_pais_complementar_form_academica[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>

        <label for="" class="clear-both"><span>Instituição </span><input type="text" value="<?php echo $itens['vazio']==0? $itens['instituicao']:'';?>" name="instituicao_complementar_form_academica[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Início </span><input type="text" value="<?php echo $itens['vazio']==0? br_date($itens['data_inicio']):'';?>" name="inicio_complementar_form_academica[]" class="data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        <label for="" class="to-left"><span>Conclusão</span><input type="text" value="<?php echo $itens['vazio']==0? br_date($itens['data_conclusao']):'';?>" name="conclusao_complementar_form_academica[]" class="data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
        </div>
          <?php

            endforeach;

          ?>
        <a id="btn_add_formacao_academica_complementar" class="btn_add_modulo" href="">+ Incluir outra formação</a>

      </div>


      <!-- Objetivos Profissionais -->
      <div id="objetivos_profissionais" class="holder_cadastro_curriculo container_page_cadastro_curriculo">
        <label for="objetivo_text_objetivos_profissionais"><span>Objetivos Profissionais </span>
          <textarea name="objetivo_text_objetivos_profissionais" id="objetivo_text_objetivos_profissionais" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" cols="30" rows="10"><?php echo isset($objetivosprofissionais_obs['objetivosprofissionais'])? $objetivosprofissionais_obs['objetivosprofissionais']:''?></textarea>
          <small class="to-right">Até 500 caracteres.</small>
        </label>

        <hr class="hr_sep" />

        <div class="num-col-2"><span class="label-cols">Nível de Atuação </span>


         <?php
            $x=1;
            $media=0;

            foreach ($objetivosprofissionais_atuacao as $itens):
                 $media=round($itens['qtd_media']/2)+$itens['qtd_media']%2;
         ?>
          <?php if($x==1 ||$x==($media+1)):?>
            <div class="col">
         <?php endif;?>
             <label for="nivelatuacao" class="inpt_checkbox"><input type="radio" name="nivelatuacao" <?php echo $itens['id_curriculo']>0?'Checked':'' ;?> value="<?php echo $itens['id_nivel'] ;?>"><span><?php echo $itens['nome_nivel'] ;?></span></label>
        <?php if(($x==$media) || $x==$itens['qtd_media'] ):?>
         </div>
         <?php endif;?>

     <?php
            $x=$x+1;
           endforeach;
         ?>

        </div>

        <hr class="hr_sep" />

        <div class="num-col-2"><span class="label-cols">Área de Atuação </span>

            <?php
                $x=1;
                $media=0;
                foreach ($objetivosprofissionais_area_atuacao as $itens):
                    $media=round($itens['qtd_media']/2)+$itens['qtd_media']%2;
            ?>
                 <?php if($x==1 ||$x==($media+1)):?>
                    <div class="col">
                <?php endif;?>
                    <label for="" class="inpt_checkbox"><input type="checkbox" name="area_atuacao[]" <?php echo $itens['area_atuacao_cadastro_id']>0?'Checked':'' ;?> value="<?php echo $itens['id_area'] ;?>" id=""><span><?php echo $itens['nome_area'] ;?></span></label>

                 <?php if(($x==$media) || $x==$itens['qtd_media'] ):?>
                    </div>
                 <?php endif;?>

            <?php
                $x=$x+1;
               endforeach;
            ?>

        </div>

        <hr class="hr_sep" />

        <div class="num-col-2"><span class="label-cols">Segmento de Atuação </span>
            <?php
                $x=1;
                $media=0;
             foreach ($objetivosprofissionais_segmento_atuacao as $itens):
                 $media=round($itens['qtd_media']/2)+$itens['qtd_media']%2;

            ?>
              <?php if($x==1 ||$x==($media+1)):?>
                    <div class="col">
            <?php endif;?>
             <label for="" class="inpt_checkbox"><input type="radio" name="segmentodeatuacao" value="<?php echo $itens['segmentodeatuacao_id'] ;?>" <?php echo $itens['segmentodeatuacao_cadastro_id']>0?'Checked':'' ;?> id=""><span><?php echo $itens['segmentodeatuacao_nome'] ;?></span></label>

             <?php if(($x==$media) || $x==$itens['qtd_media'] ):?>
                    </div>
                 <?php endif;?>

            <?php
                $x=$x+1;
               endforeach;





            ?>
            </div>



        <hr class="hr_sep" />

        <div class="num-col-2">
            <span class="label-cols">Disponibilidade de Horário </span>


             <?php
                $x=1;
                $media=0;
             foreach ($objetivosprofissionais_disponibilidade_horario as $itens):
                 $media=round($itens['qtd_media']/2)+$itens['qtd_media']%2;
            ?>
            <?php if($x==1 ||$x==($media+1)):?>
                    <div class="col">
            <?php endif;?>
             <label for="" class="inpt_checkbox"><input type="radio" name="disponibilidadedehorario" value="<?php echo $itens['disponibilidadehorario_id'] ;?>" <?php echo $itens['disponibilidadehorario_cadastro_id']>0?'checked':'' ;?> id=""><span><?php echo $itens['disponibilidadehorario_nome'] ;?></span></label>

              <?php if(($x==$media) || $x==$itens['qtd_media'] ):?>
                    </div>
                 <?php endif;?>

            <?php
                $x=$x+1;
               endforeach;
            ?>


        </div>

        <hr class="hr_sep" />

        <div class="num-col-2"><span class="label-cols">Pretensão Salarial </span>

         <?php
                $x=1;
                $media=0;
             foreach ($objetivosprofissionais_pretencaosalarial as $itens):
                 $media=round($itens['qtd_media']/2)+$itens['qtd_media']%2;
            ?>
            <?php if($x==1 ||$x==($media+1)):?>
                    <div class="col">
            <?php endif;?>
             <label for="" class="inpt_checkbox"><input type="radio" name="pretencaosalarial" value="<?php echo $itens['pretencaosalarial_id'] ;?>" <?php echo $itens['pretencaosalarial_cadastro_id']>0?'Checked':'' ;?> id=""><span><?php echo $itens['pretencaosalarial_nome'] ;?></span></label>

              <?php if(($x==$media) || $x==$itens['qtd_media'] ):?>
                    </div>
                 <?php endif;?>

            <?php
                $x=$x+1;
               endforeach;
            ?>

        </div>

        <hr class="hr_sep" />

      </div>

      <!-- Referencias Profissionais -->
      <div id="referencias_profisionais" class="holder_cadastro_curriculo container_page_cadastro_curriculo">

        <?php foreach ($referenciasprofissionais as $itensreferencia):?>
        <div id="referencia_profissional_origin_origin" class="origins">
            <label><span>Empresa </span><input type="text" value="<?php echo $itensreferencia['vazio']==0? $itensreferencia['empresa']:'';?>" name="empresa_ref_prof[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
            <label><span>Nome do Superior Imediato </span><input type="text" value="<?php echo $itensreferencia['vazio']==0?  $itensreferencia['nome_superior_imediato']:'';?>" name="nome_sup_imediato_ref_prof[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
            <label><span>Cargo </span><input type="text" value="<?php echo $itensreferencia['vazio']==0? $itensreferencia['cargo']:'';?>" name="cargo_ref_prof[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
            <label class="to-left"><span>Telefone </span><input type="text" value="<?php echo $itensreferencia['vazio']==0? $itensreferencia['telefone_comercial']:'';?>" name="tel_ref_prof[]" class="phone inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label class="clear-both"><span>E-mail </span><input type="text" value="<?php echo $itensreferencia['vazio']==0? $itensreferencia['email']:'';?>" name="email_ref_prof[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
        </div>
          <?php endforeach;?>
        <a id="btn_add_referencia_profissional" class="btn_add_modulo" href="">+ Incluir outra referência</a>
      </div>


      <!-- Histórico Profissional -->
      <?php
      $x=0;
      $y=0;

      ?>
      <div id="historico_profissional" class="holder_cadastro_curriculo container_page_cadastro_curriculo">
        <?php foreach ($historicoprofessional as $itens):?>
            <div class="historico_profissional_origin origins set_add" data-thisid="0">
                <label><span>Empresa </span><input type="text"  value="<?php echo $itens['vazio']==0? $itens['empresa']:'';?>" name="empresa_his_prof[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
                <?php if (isset($itens['cargos'][$x])):?>
                        <?php foreach ($itens['cargos'][$x] as $itenscargos):?>
                           <label for="" class="cargo_origin origins_input campo_add"><span>Cargo </span>
                               <input type="text" value="<?php echo $itenscargos['cargo'];?>" name="empresa_cargo_prof[<?php echo $x;?>][]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
                        <?php
                        $y=$y+1;
                        endforeach;?>
                  <?php else:?>
                        <label for="" class="cargo_origin origins_input campo_add"><span>Cargo </span><input type="text" value="" name="empresa_cargo_prof[<?php echo $x;?>][]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
                  <?php endif;?>
            <div class="add_fields"></div>
            <a class="btn_add_cargo btn_add_modulo add_campo" href="">+ Incluir outro cargo nesta experiência</a>

            <label for="" class="to-left clear-both"><span>Entrada </span><input type="text" value="<?php echo $itens['vazio']==0? br_date($itens['data_inicial']):'';?>" name="entrada_his_prof[]" id="entrada_his_prof" class="data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="to-left"><span>Saída </span><input type="text" value="<?php echo $itens['vazio']==0? br_date($itens['data_saida']):'';?>" name="saida_his_prof[]" id="saida_his_prof" class="data_nascimento inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="clear-both"><span>Motivo de Desligamento </span><input type="text" value="<?php echo $itens['vazio']==0?$itens['motivo_desligamento']:'';?>" name="motivo_his_prof[]" id="motivo_his_prof" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>

            <label for="" class="to-left"><span>Salário </span><input type="text" value="<?php echo $itens['salario'];?>" name="salario_his_prof[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="to-left"><span>Benefícios </span><input type="text" value="<?php echo $itens['beneficios'];?>" name="beneficios_his_prof[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="to-left"><span>Superior Imediato </span><input type="text" value="<?php echo $itens['superior_imediato'];?>" name="sup_imediato_his_prof[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="to-left"><span>Cargo do<br />Superior<br />Imediato </span><input type="text" value="<?php echo $itens['cargo_superior_imediato'];?>" name="cargo_sup_imediato_his_prof[]" class="inpt_cadastro_curriculo small_inpt_cadastro_curriculo" /></label>
            <label for="" class="clear-both"><span>Principais atribuições </span><input type="text" value="<?php echo $itens['principais_atribuicoes'];?>" name="principais_atribuicoes[]" class="inpt_cadastro_curriculo big_inpt_cadastro_curriculo" /></label>
            </div>
          <?php
            $x=$x+1;

          endforeach;?>
        <div class="add_sets"></div>
        <a class="btn_add_historico_profissional btn_add_modulo add_set" href="">+ Incluir outra experiência</a>

        <div class="num-col-2 clear-both"><span class="label-cols">Disponibilidade de trabalhar em outra cidade</span>

          <div class="col">
            <label for="" class="inpt_checkbox"><input type="radio" name="trabalhar_outra_cidade" <?php echo $dadosaluno[0]->trabalhar_outra_cidade=='N'?'checked':''; ?> value="N" id=""><span>Não</span></label>
            <label for="" class="inpt_checkbox"><input type="radio" name="trabalhar_outra_cidade" <?php echo $dadosaluno[0]->trabalhar_outra_cidade=='S'?'checked':''; ?> value="S" id=""><span>Sim</span></label>
          </div>
        </div>
        <input id="controlehistoricoprofissional" type="hidden" value="<?php echo $x-1; ?>">
      </div>

<div class="termo-de-uso" <?php echo $dadosaluno[0]->termos_curriculo=='S'?'style="display:none;"':''; ?>>
<div class="title-termos-de-uso">
  Termos de Uso
</div>
<pre>
CONTRATO DE PRESTAÇÃO DE SERVIÇO POR MEIO ELETRÔNICO DE CADASTRO E ENVIO DE CURRÍCULO

Este Contrato disciplina os termos e condições mediante as quais o Ceviu Vagas e Prestação de Serviços Ltda,sociedade por quotas de responsabilidade limitada com sede na cidade de Belo Horizonte, Estado de Minas Gerais, na Av. Francisco Sales, 1614 Sl. 1602, inscrita no CNPJ/MF sob o n.º 07.457.586/0001-67, coloca à disposição de seus Usuários, após aceitação, o fornecimento de serviço de cadastro gratuito de currículo e envio do mesmo às oportunidades profissionais na área de TI.

ATENÇÃO: AO CLICAR O BOTÃO "ACEITO" O USUÁRIO ESTARÁ AUTOMATICAMENTE CONCORDANDO COM TODOS OS TERMOS E CONDIÇÕES DESTE INSTRUMENTO.

1.OBJETO

1.1 O objeto do Contrato é o oferecimento de cadastro gratuito de currículo e provimento de acesso às vagas cadastradas e um envio máximo de até 7 currículos por mês, para pessoa física maior de 18 anos, bem como para pessoa jurídica devidamente constituída ("Usuário"), que preencherem as condições de cadastro previstas neste Instrumento.

2. DOS DADOS OBRIGATÓRIOS PARA CADASTRO DO USUÁRIO

2.1 O Usuário deverá fornecer todos os dados pessoais solicitados nos campos de preenchimento obrigatório da página de cadastro do site CEVIU. Ao cadastrar-se, o Usuário fornecerá informações verdadeiras, atualizadas e completas, declarando-se plenamente ciente de que a utilização indevida de dados de terceiros ou o fornecimento de informações falsas poderá caracterizar a prática de crime, sujeitando o infrator às penalidades previstas em lei.

2.2 O Usuário obriga-se a manter todos os seus dados cadastrais devidamente atualizados, bem como a atender as solicitações de atualização quando solicitado, observando estritamente os termos da Cláusula 2.1 acima.

2.3 O CEVIU poderá utilizar os meios que entender necessários para, a qualquer momento, averiguar a veracidade das informações prestadas. Sendo identificada qualquer irregularidade nos dados fornecidos pelo Usuário, poderá o CEVIU suspender imediatamente seus serviços, até que o cadastro do Usuário seja devidamente corrigido e aceito.

2.4 Ao cadastrar-se, o Usuário deverá registrar sua senha de acesso ao login e provimento de acesso objeto deste Contrato, a qual poderá ser posteriormente alterada, a qualquer tempo, mediante o fornecimento e confirmação dos dados de cadastro do Usuário.

2.5 IMPORTANTE. A SENHA É PESSOAL E INTRANSFERÍVEL E, PORTANTO, NÃO DEVE SER DIVULGADA PELO USUÁRIO A TERCEIROS. CASO TENHA MOTIVOS PARA ACREDITAR QUE TIVERAM ACESSO À SUA SENHA, O USUÁRIO DEVERÁ IMEDIATAMENTE PROVIDENCIAR A SUA MODIFICAÇÃO. O USUÁRIO É O ÚNICO E EXCLUSIVO RESPONSÁVEL POR DANOS E PREJUÍZOS DECORRENTES DA UTILIZAÇÃO DE SUA SENHA.

3. DO SERVIÇO DE SUPORTE TÉCNICO

3.1 O CEVIU oferecerá suporte técnico exclusivamente por e-mail com o objetivo de auxiliar os Usuários na solução de problemas relacionados aos seus serviços prestados.

3.2 A conduta do Usuário, no seu contato com os atendentes do suporte técnico do CEVIU não será ameaçador, obsceno, difamatório, pejorativo, prejudicial ou injurioso, nem discriminatório em relação à raça, cor, credo ou nacionalidade, sob pena de rescisão imediata do Contrato, sem prejuízo de todas as demais medidas cabíveis.

3.3 O CEVIU poderá fazer uso dos dados cadastrados pelos usuários para fins que visem direta ou indiretamente recolocação profissional.

3.4 IMPORTANTE. A RESPONSABILIDADE DO CEVIU LIMITA-SE A EMPREENDER OS MELHORES ESFORÇOS COM VISTAS AO ATENDIMENTO SATISFATÓRIO DAS PERGUNTAS E DÚVIDAS DO USUÁRIO REFENTES AO OBJETO DESTE CONTRATO. O CEVIU NÃO SE RESPONSABILIZA PELA SOLUÇÃO DAS REFERIDAS DÚVIDAS E PERGUNTAS NO MOMENTO DA CONSULTA AO SERVIÇO, ENVIDANDO, NO ENTANTO, SEUS MELHORES ESFORÇOS PARA TANTO.

3.5 IMPORTANTE. O CEVIU EXIME-SE, AINDA, DE QUALQUER RESPONSABILIDADE POR CUSTOS, PREJUÍZOS E/OU DANOS CAUSADOS A USUÁRIOS OU A TERCEIROS PELA NÃO IMPLEMENTAÇÃO, PELA IMPLEMENTAÇÃO PARCIAL OU PELA MÁ IMPLEMENTAÇÃO DA SOLUÇÃO OFERECIDA ÀS DÚVIDAS E PERGUNTAS APRESENTADAS PELO USUÁRIO RELACIONADAS AOS SERVIÇOS OBJETO DESTE CONTRATO.

4. PRAZO DO CONTRATO

4.1 Este Contrato estará em vigor a partir da aceitação eletrônica dada pelo Usuário, permanecendo vigente por prazo indeterminado até que qualquer das Partes motive a rescisão contratual nas formas definidas neste Instrumento.

5. DA PERDA DOS DIREITOS PELO USUÁRIO

5.1 O Usuário que não acessar o sistema usando seu "login" e senha de acesso por um período igual ou superior a 90 (noventa) dias terá seu cadastro bloqueado pelo CEVIU, sendo considerado como Usuário Inativo até que providencie a reativação do serviço por meio da página principal do CEVIU.

5.2 O Usuário considerado como Usuário Inativo ficará impossibilitado de receber os resumos em sua caixa de entrada.

5.3 O Usuário que utilizar a franquia mensal de envio, ficará impossibilitado de fazer novos envios de currículos desde que o mesmo não faça parte do Plano Destaque.

5.4 Tendo o Usuário manifestado interesse na continuidade dos serviços prestados pelo CEVIU nos termos da cláusula 5.1 acima, e desde que sua conta de e-mail não tenha sido ainda cancelada, O CEVIU providenciará a reativação do serviço ora contratado num prazo de até 5 (cinco) dias.

6. DAS OBRIGAÇÕES DO CEVIU

6.1 O CEVIU compromete-se a:

a) respeitar a privacidade de seus Usuários, a menos que seja obrigado a fazê-lo em decorrência de ordem judicial ou de obrigação prevista em lei;

b) proteger a privacidade dos usuários dentro dos limites do presente instrumento contratual;

c) envidar seus melhores esforços para assegurar e desenvolver a qualidade do Serviço objeto do presente Contrato;

d) não realizar quaisquer alterações nos termos e condições deste Contrato sem notificar os Usuários.

e) possibilitar ao usuário o envio de 7 currículos por mês.

7. DAS OBRIGAÇÕES DO USUÁRIO

7.1 O Usuário obriga-se a fornecer informações verdadeiras e a manter seus dados cadastrais devidamente atualizados e completos, comunicando o CEVIU sempre que houver qualquer alteração.

7.2 O Usuário que permitir o compartilhamento de sua senha e/ou acesso com terceiros será integralmente responsável pelas ações e omissões praticadas por tais terceiros por meio da internet, devendo responder inclusive pelas conseqüências que estas ações ou omissões vierem a gerar na esfera civil e criminal.

7.3 O Usuário compromete-se a observar o "Termo de Uso do Serviço" previsto na Cláusula 8ª deste Contrato.

8. DO TERMO DE USO DO SERVIÇO

8.1 O Usuário não utilizará o Serviço para:

a) transmitir ou divulgar material ilegal, difamatório, ameaçador, obsceno, prejudicial, injurioso ou praticar atos que possam ser considerados discriminatórios em relação a qualquer raça, cor, credo ou nacionalidade;

b) atentar contra o direito de personalidade e intimidade de terceiros divulgando informações, sons ou imagens que causem, ou possam causar, qualquer espécie de constrangimento ou danos à reputação de referidas pessoas;

c) armazenar, compartilhar, difundir, transmitir ou colocar à disposição de terceiros quaisquer informações, imagens, desenhos, fotografias, gráficos, gravações de imagem ou de som que violem segredo industrial ou de comunicação;

d) transmitir arquivos, mensagens ou qualquer outro material cujo conteúdo viole direitos de propriedade intelectual do CEVIU e/ou de terceiros;

e) obter informações a respeito de terceiros, em especial endereços de e-mails, sem anuência do seu titular;

f) transmitir, dolosa ou culposamente, arquivos contendo vírus ou que de qualquer forma possam prejudicar os programas e/ou os equipamentos do CEVIU ou de terceiros;

g) obter software ou informação de qualquer natureza amparados por lei de proteção à privacidade ou à propriedade intelectual, salvo se detiver as respectivas licenças e/ou autorizações;

h) tentar violar sistemas de segurança de informação do CEVIU ou de terceiros, ou tentar obter acesso não autorizado a redes de computador conectadas à Internet;

i) enviar mensagens não solicitadas conhecidas como "spam" ou correntes que gerem uso abusivo dos servidores do provedor e/ou reiteradas reclamações de Usuários.

j) fins ilegais mediante transmissão ou obtenção de material em desacordo com a legislação brasileira, materiais que atentem contra a ordem pública, ou ainda, que caracterizem prática tipificada como crime, exemplificadamente, material relacionado ao tráfico de drogas, pirataria e pedofilia;

k) a divulgação de imagens e idéias cujo conteúdo, a critério de CEVIU, seja considerado socialmente condenável ou atente contra valores éticos, morais e religiosos, assim como aqueles que ponham em risco a saúde ou a integridade física do Usuário ou de terceiros;

l) a divulgação de imagens e idéias cujo conteúdo, a critério de CEVIU, seja considerado socialmente condenável ou atente contra valores éticos, morais e religiosos, assim como aqueles que ponham em risco a saúde ou a integridade física do Usuário ou de terceiros;

9. ALTERAÇÕES NOS TERMOS E CONDIÇÕES DO CONTRATO

9.1 O CEVIU se reserva o direito de alterar unilateralmente quaisquer condições do deste Contrato. Caso o Usuário não concorde com as alterações promovidas pelo CEVIU, deverá manifestar-se, expressamente, no prazo máximo de 30 (trinta) dias a contar da data da alteração. O silêncio do Usuário no prazo ora estipulado será entendido como aceitação aos novos termos e condições contratuais vigentes.

10. RESCISÃO

10.1 O Usuário poderá rescindir o Contrato a qualquer tempo, bastando para isso deixar de utilizar o acesso por período superior a 240 (duzentos e quarenta) dias.

10.2 O Usuário também poderá rescindir o este Contrato, manifestando-se, no prazo previsto, contrário aos novos termos contratuais propostos, ou ainda, a qualquer momento, mediante notificação enviada ao Ceviu comunicando sua intenção de rescindir a relação contratual. Em ambas as hipóteses o Contrato será considerado imediatamente rescindido, ficando o CEVIU isento de quaisquer responsabilidades posteriormente a tal data, especialmente em relaçãoàs mensagens enviadas e/ou recebidas pelo Usuário.

10.3 Caso o CEVIU pretenda rescindir o Contrato sem culpa do Usuário, deverá comunicar aos Usuários por e-mail com antecedência mínima de 45 (quarenta e cinco) dias.

10.3 O CEVIU poderá rescindir este Contrato a qualquer tempo e sem comunicação prévia se o Usuário descumprir os termos deste Contrato.

11. DISPOSIÇÕES GERAIS

11.1 O Contrato é regido pelas leis da República Federativa do Brasil e as partes elegem, para dirimir quaisquer controvérsias dele decorrentes, o Foro Central da Comarca de Belo Horizonte. Este Instrumento revoga e substitui todos e quaisquer Contratos anteriormente celebrados em relação ao seu objeto, orais ou escritos.
</pre>
<div class="check-termo-de-uso">
  <input type="checkbox"  <?php echo $dadosaluno[0]->termos_curriculo=='S'?'checked':''; ?> name="accept_termos_de_uso" id="accept_termos_de_uso">
  <span><label for="accept_termos_de_uso">Lí e concordo com os Termos e condições</label>.</span>
</div>
</div>

      <div>
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


