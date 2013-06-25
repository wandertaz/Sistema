<html>
    <body>
        <div style="width:990px; height:100%; background:#fff; border:0; padding:0;">

            <div id="logo" style="padding:20px">
                <img src="<?php echo site_url('assets/img/logo-black.png'); ?>">
                <!--<h1><b>MB Consultoria</b></h1>-->
            </div>

            <div id="corpo" style="color:#333; padding:10px; font-size:14px; letter-spacing:1px;">
                <h2  align="CENTER"><?php echo ('ORÇAMENTO ON LINE'); ?> </h2>

                <img width="74" height="75" border="0" src="<?php echo site_url('assets/img/orcamento_atencao.jpg'); ?>">
                <?php echo ('<p>O Orçamento On Line é realizado através do site da MB Consultoria e possui valor estimado, utilizado muitas vezes para se ter um parâmetro inicial quanto ao investimento necessário para implantação de determinado projeto ou serviço realizado pela MB Consultoria.</p> 

<p>Recomendamos que, após decisão de implantação de algum projeto, seja solicitada da MB Consultoria, a visita de um consultor, para um diagnóstico mais preciso da situação e necessidades de sua empresa, quando em seguida, poderá ser apresentado um projeto mais detalhado e com investimento certo, também sem compromisso.</p>'); ?>


                <h2><?php echo ('<p>As seguintes informações abaixo foram fornecidas no site, como base para o orçamento estimado apresentado.</p>'); ?></h2>
                <?php
                $traducoes = array('segmento_empresa' => 'Segmento da Empresa', 'qt_participantes' => 'Quantidade de Colaboradores', 'desc_produtos_servicos' => 'Produtos/Serviços da Empresa',
                    'qtd_unidades_certificadas' => 'Quantidade de Unidades para certificação', 'localizacao_unidade' => 'Localização das Unidades',
                    'possui_departamento_qualidade' => 'Possui departamento/profissional da Qualidade?', 'sistema_auditado' => 'Qual sistema será auditado?',
                    'qual_occ_certificou' => 'Qual o Organismo Certificador (OCC)?', 'qts_nao_conformidades' => 'Quantidade de não-conformidades registradas na última auditoria',
                    'qtd_hds' => 'Quantidade de HDs para auditoria', 'qt_colaboradores_envolvidos' => 'Quantidade de Colaboradores diretamente envolvidos',
                    'form_orcamento_qual_auditoria' => 'Tipo de Auditoria', 'qtd_tempo_certificada' => 'Quanto tempo de certificação no sistema',
                    'prof_especializado' => 'Profissional Especializado', 'possui_alguma_certificacao' => 'Possue Certificação', 'possui_sala' => 'Possui Sala',
                    'expectativa_certificacao' => 'Expectativa Certificação', 'certificacoes_pretendidas' => 'Certificações Pretendidas', 'obras_atualmente' => 'Em Obras Atualmente',
                    'form_orcamento_iso9001' => 'Possui Iso 9001', 'trabalho_homeoffice' => 'Trabalho Home/Office', 'program_integracao_ao_mtrabalho' => 'Programa Integracao do Trabalho',
                    'regime_remuneracao' => 'Eegime Remuneração', 'form_orcamento_iso14001' => 'Possui Iso 14001', 'form_orcamento_ohsas18001' => 'Possui ohsas 18001', 'cod_conduta' => 'Possui código de conduta',
                    'programadas_mte' => 'Programamas do MTE', 'estrutura_sesmt' => 'Estrutura SESMT Existente', 'monitor_acidentes_trabalho' => 'Possui Monitoramento (acidentes de trabalho)',
                    'tipo_curso' => 'Tipo de Curso', 'nome_do_curso' => 'Nome do Curso', 'area_curso' => 'Àrea do Curso', 'objetivo_curso' => 'Objetivo do Curso', 'carga_horaria' => 'Carga Horária',
                    'publico_alvo' => 'Público Alvo', 'resultado_esperado' => 'Resultado Esperado', 'local_realizacao' => 'Local Realização', 'possui_em_sua_infraestrutura' => 'Possui Infraestrutura',
                    'data_inicio' => 'Data Início', 'data_fim' => 'Data Fim', 'horario_previsto' => 'Horário Previsto', 'residuos_solidos_gerados' => 'Resíduos Sólidos Gerados', 'outros_residuos' => 'Possui outros resíduos',
                    'coleta_seletiva' => 'Realiza Coleta Seletiva', 'tratamento_efluentes' => 'Possui Tratamento de Efluentes', 'possui_doc_legal' => 'documentação legal (licenças e registros, etc)',
                    'destinacao_tratamento_residuos' => 'Possui laudo de destinação (tratamento dos resíduos)', 'possui_assessoria_leg_ambiental' => 'Possui assessoria para atendimento legislação ambiental'
                );


                if ($dados_empresa->tipo_orcamento == 'AI'): //(AI) Auditoria Interna          
                    $nome_orcamento = 'Auditoria Interna';
                elseif ($dados_empresa->tipo_orcamento == 'PB'): //(PB) Orcamento On Line_PBQP-h        
                    $nome_orcamento = 'Orcamento On Line_PBQP-h';
                elseif ($dados_empresa->tipo_orcamento == 'GA'): //(GA) Sistema Gest�o Ambiental_ISO14001
                    $nome_orcamento = 'Sistema Gestão Ambiental ISO 14001';
                elseif ($dados_empresa->tipo_orcamento == 'SQ'): //(GQ) Sistema Gest�o da Qualidade_ISO9001
                    $nome_orcamento = 'Sistema Gestão da Qualidade ISO 9001';
                elseif ($dados_empresa->tipo_orcamento == 'GS'): //(GS) Sistema Gest�o Responsabilidade Social   
                    $nome_orcamento = 'Sistema Gestão Responsabilidade Social';
                elseif ($dados_empresa->tipo_orcamento == 'SS'): //(SS) Sistema Sa�de e Seguran�a        
                    $nome_orcamento = 'Sistema Saúde e Segurança ';
                elseif ($dados_empresa->tipo_orcamento == 'TR'): //(TR) Treinamento	
                    $nome_orcamento = 'Treinamento';
                endif;
                ?>


                <div class="input text">                
                    <label><b>data:</b></label>&nbsp;<?php echo br_date($dados_empresa->created); ?>               
                </div>

                <div class="input text">

                    <label><b>Nome da Empresa:</b></label>&nbsp;<?php echo $dados_empresa->nome_empresa; ?>

                </div>

<?php foreach ($dados_orcamento as $nome => $valor): ?>
                    <div class="input text">

    <?php if (isset($traducoes[$nome])): ?>
                            <label><b><?php echo ($traducoes[$nome]); ?>:</b></label>&nbsp;
                        <?php if (is_array($valor)): ?>
            <?php
            $x = 1;
            foreach ($valor as $valor_array):
                $virgula = ',&nbsp';
                echo ($valor_array . $virgula);
            endforeach;
            ?>
                            <?php else: ?>
                                <?php echo ($valor); ?>
                            <?php endif; ?> 
                        <?php endif; ?>

                    </div>
                    <?php endforeach; ?>



                <h2  align="CENTER"><?php echo ('ORÇAMENTO'); ?> </h2>





<?php echo ('Para o Projeto de Implantação do ' . $nome_orcamento . ', na empresa ' . $dados_empresa->nome_empresa . ', conforme todas as informações fornecidas via web, estimamos o investimento na faixa de'); ?> 


                <b>R$ <?php echo number_format($dados_empresa->valor_orcamento, 2); ?></b> 

                (<?php echo valorPorExtenso($dados_empresa->valor_orcamento) ?>)        

               <?php echo isset($dados_orcamento['expectativa_certificacao'])? 'e um prazo de execução entre <b>'.$dados_orcamento['expectativa_certificacao'].' meses</b>':''?>

<?php
//echo'<pre>';
//print_r($dados_empresa);
?>






                <!--<hr>-->

<?php
//echo'<pre>';
//print_r($dados_orcamento);
?>
                <!--<hr>-->

                <h4>Termos</h4>

                <?php if ($dados_empresa->tipo_orcamento == 'AI'): //(AI) Auditoria Interna ?>
    <?php echo ('A) Os valores de investimento não contemplam custos de viagem (passagem, hospedagem, alimentação e deslocamento) dos consultores, se porventura for necess�rio atuação dos consultores fora de Manaus.'); ?>

<?php elseif ($dados_empresa->tipo_orcamento == 'PB'): //(PB) Orcamento On Line_PBQP-h   ?>  
                    <?php echo ('<p>A) Os valores de investimento não contemplam custos de viagem (passagem, hospedagem, alimentação e deslocamento) dos consultores, se porventura for necessário atuação dos consultores fora de Manaus.</p>'); ?>
                    <?php echo ('B) O Organismo Certificador deve ser contratado à parte, ao final do projeto de implantação realizado pela MB, para Auditar, Avaliar e Recomendar a empresa á certificação.'); ?>


                <?php elseif ($dados_empresa->tipo_orcamento == 'GA'): //(GA) Sistema Gest�o Ambiental_ISO14001 ?> 
                    <?php echo ('<p>A) Os valores de investimento n�o contemplam custos de viagem (passagem, hospedagem, alimenta��o e deslocamento) dos consultores, se porventura for necess�rio atua��o dos consultores fora de Manaus.</p>'); ?>
                    <?php echo ('<p>B) Os valores de investimento n�o contemplam Assessoria Jur�dica Ambiental (esta deve ser contratada pela empresa)</p>'); ?>
    <?php echo ('C) O Organismo Certificador deve ser contratado � parte, ao final do projeto de implanta��o realizado pela MB, para Auditar, Avaliar e Recomendar a empresa � certifica��o.'); ?> 

                <?php elseif ($dados_empresa->tipo_orcamento == 'SQ'): //(GQ) Sistema Gest�o da Qualidade_ISO9001   ?>  
                    <?php echo ('<p>A) Os valores de investimento n�o contemplam custos de viagem (passagem, hospedagem, alimenta��o e deslocamento) dos consultores, se porventura for necess�rio atua��o dos consultores fora de Manaus.</p>'); ?>
                    <?php echo ('B) O Organismo Certificador deve ser contratado � parte, ao final do projeto de implanta��o realizado pela MB, para Auditar, Avaliar e Recomendar a empresa � certifica��o.'); ?> 

                <?php elseif ($dados_empresa->tipo_orcamento == 'GS'): //(GS) Sistema Gest�o Responsabilidade Social   ?>     
                    <?php echo ('<p>A) Os valores de investimento n�o contemplam custos de viagem (passagem, hospedagem, alimenta��o e deslocamento) dos consultores, se porventura for necess�rio atua��o dos consultores fora de Manaus.</p>'); ?>
                    <?php echo ('B) O Organismo Certificador deve ser contratado � parte, ao final do projeto de implanta��o realizado pela MB, para Auditar, Avaliar e Recomendar a empresa � certifica��o.'); ?> 

                <?php elseif ($dados_empresa->tipo_orcamento == 'SS'): //(SS) Sistema Sa�de e Seguran�a   ?>       
                    <?php echo ('<p>A) Os valores de investimento n�o contemplam custos de viagem (passagem, hospedagem, alimenta��o e deslocamento) dos consultores, se porventura for necess�rio atua��o dos consultores fora de Manaus.</p>'); ?>
                    <?php echo ('B) O Organismo Certificador deve ser contratado � parte, ao final do projeto de implanta��o realizado pela MB, para Auditar, Avaliar e Recomendar a empresa � certifica��o.'); ?> 

                <?php elseif ($dados_empresa->tipo_orcamento == 'TR'): //(TR) Treinamento    ?>					
                    <?php echo ('A) Os valores de investimento são apresentados por turma e as turmas devem ter o máximo de 40 pessoas. Acima disso, obrigatoriamente, deverá haver mais de uma turma.'); ?>

                <?php endif; ?>    


            </div>

            <div id="rodape" style="width:100%; height:80px; text-align:center; font-size:13px; background:#fff; position:relative; bottom:0px; color:#333;">

                <ul style="list-style:none; position:relative; top:5px;">
                    <li><b>MB Consultoria</b></li>
                    <li>Av. Constantino Nery , nº 2789 , sala 1006 a 1008 - Ed. Empire Center - CEP 69050 - 002 - Chapada / Manaus / Amazonas</li>
                    <li>Tel: +55 (92) 3656-2452 </li>
                    <li>Telefax: +55 (92) 3656-5184 </li>
                    <li>E-mail: mb@netmb.com.br</li>
                </ul>

            </div>
        </div>
    </body>
</html>





