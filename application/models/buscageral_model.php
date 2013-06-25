<?php
class buscageral_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

   
	function resultadobusca($busca,$offset='0',$per_page,$acao=1){ 

        
$where=" and (titulo like'%".$busca."%' or descricao like'%".$busca."%')";
            
$Sql =" SELECT id, 'Nossos serviços' as area, left(url,2) as tipo,trim(CONCAT('servicos/', replace(url,'-','_'))) as link, titulo,descricao";
$Sql.=" from paginas"; 
$Sql.=" where (url in ('estrategias','','processos','pessoas','governanca-corporativa')"; 
$Sql.=" and ativo='S')".$where;
$Sql.=" union";
$Sql.=" (SELECT id,'Educação Corporativa' as area,'AB' as tipo,CONCAT('educacao_corporativa/ver_curso_aberto/', cast(id as char)) as link,titulo, descricao";
$Sql.=" FROM (cursos_abertos)"; 
$Sql.=" WHERE (ativo = 'S')".$where.")"; 
$Sql.=" union";
$Sql.=" (SELECT id,'Educação Corporativa' as area,'IN' as tipo,CONCAT('educacao_corporativa/ver_curso_incompany/', cast(id as char)) as link,titulo, descricao";
$Sql.=" FROM (cursos_incompany)"; 
$Sql.=" WHERE (ativo = 'S')".$where.")";
$Sql.=" union";
$Sql.=" (SELECT id,'Educação Corporativa' as area,'EL' as tipo,CONCAT('educacao_corporativa/ver_elearning/', cast(id as char)) as link,titulo, descricao";
$Sql.=" FROM (elearning)"; 
$Sql.=" WHERE (ativo = 'S')".$where.")"; 
$Sql.=" union";
$Sql.=" (SELECT id,'Educação Corporativa' as area,'AL' as tipo,CONCAT('educacao_corporativa/ver_alta_performance/', cast(id as char)) as link,titulo, descricao";
$Sql.=" FROM (programas_alta_performance)"; 
$Sql.=" WHERE (ativo = 'S')".$where.")"; 
$Sql.=" union";
$Sql.=" (SELECT id,'Educação Corporativa' as area,'DE' as tipo,CONCAT('educacao_corporativa/ver_programa_desenvolvimento/', cast(id as char)) as link,titulo, descricao ";
$Sql.=" FROM (programas_desenvolvimento)";
$Sql.=" WHERE (ativo = 'S')".$where.")"; 
$Sql.=" union";
$Sql.=" (SELECT id_autodiagnostico as id,'Autodiagnóstico' as area,'AU' as tipo,CONCAT('autodiagnosticos/ver_autodiagnostico/', cast(id_autodiagnostico as char)) as link,nome as titulo, autodiagnosticos.texto as descricao";
$Sql.=" FROM (autodiagnosticos)"; 
$Sql.=" INNER JOIN tipos_autodiagnosticos ON tipos_autodiagnosticos.id_tipo_autodiagnostico = tipos_autodiagnosticos_id_tipo_autodiagnostico"; 
$Sql.=" WHERE (autodiagnosticos.ativo = 'S') and (autodiagnosticos.nome like'%".$busca."%' or autodiagnosticos.texto like'%".$busca."%'))"; 
$Sql.=" union";
$Sql.=" (SELECT id_vaga as id,'Banco de Talentos' as area,'VA' as tipo,CONCAT('banco_talentos_vagas/detalhes_vaga/', cast(id_vaga as char)) as link,titulo_cargo as titulo,descricao";
$Sql.=" FROM (vagas)"; 
$Sql.=" INNER JOIN inscritos ON inscritos.id = inscritos_id AND tipo_pessoa = 'J'"; 
$Sql.=" INNER JOIN niveis_de_atuacao ON niveis_de_atuacao.id_nivel = niveis_de_atuacao_id_nivel"; 
$Sql.=" WHERE (vagas.ativo = 'S' and vagas.status ='P') and (titulo_cargo like'%".$busca."%' or descricao like'%".$busca."%'))"; 
$Sql.=" union";
$Sql.=" (SELECT downloads_versoes.id_download_versoes as id,'Central de Downloads' as area,'CD' as tipo,";
$Sql.=" CONCAT('central_downloads/lista_downloads_aberto/', cast(downloads_versoes.id_download_versoes as char))"; 
$Sql.=" as link,titulo, descricao";
$Sql.=" FROM (downloads_versoes)"; 
$Sql.=" INNER JOIN downloads ON downloads_versoes.downloads_id_downloads = downloads.id_downloads"; 
$Sql.=" WHERE id_download_versoes in(select id_download_versoes from downloads_versoes"; 
$Sql.=" WHERE downloads_versoes.ativo = 'S'";
$Sql.=" group by downloads_id_downloads desc)";
$Sql.=" AND (downloads.ativo = 'S') and (titulo like'%".$busca."%' or descricao like'%".$busca."%'))"; 
$Sql.=" union";
$Sql.=" (SELECT id, case url when 'orcamento-on-line' then 'Orcamento on-line' else'Pesquisa on-line' end as area, left(url,2) as tipo,case url when 'orcamento-on-line' then 'orcamento_online/index/TR' else'pesquisa_online/index' end as link, titulo,descricao";
$Sql.=" from paginas"; 
$Sql.=" where (url in ('modulo-de-pesquisa','orcamento-on-line')"; 
$Sql.=" and ativo='S')".$where.")";
$Sql.=" union";
$Sql.=" (SELECT id,'Publicações' as area, 'RE' as tipo,'publicacoes/revistas' as link, titulo,descricao";
$Sql.=" from revistas where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id,'Publicações' as area, 'AR' as tipo, trim(CONCAT('publicacoes/ver_artigo/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from artigos  where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id,'Publicações' as area, 'PE' as tipo, trim(CONCAT('publicacoes/ver_pesquisas_estudos/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from pesquisas_estudos  where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id,'Multimídia' as area, 'VI' as tipo, trim(CONCAT('multimidia/ver_video/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from videos where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id,'Multimídia' as area, 'PO' as tipo, trim(CONCAT('multimidia/ver_podcast/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from podcasts where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id,'Multimídia' as area, 'GA' as tipo, trim(CONCAT('multimidia/ver_galeria/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from galerias where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id, 'Notícias' as area,tipo, trim(CONCAT('noticias/noticias_abertas?id_noticia=', cast(id as char))) as link, titulo,descricao";
$Sql.=" from noticias where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union";
$Sql.=" (SELECT id, 'Blog' as area,'BL' as tipo, trim(CONCAT('blog/ver_post/', cast(id as char))) as link, titulo,descricao";
$Sql.=" from posts where (titulo like'%".$busca."%' or descricao like'%".$busca."%'))";
$Sql.=" union"; 
$Sql.=" (SELECT id, 'Blog' as area,'CO' as tipo, trim(CONCAT('blog/index?colunista=', cast(id as char))) as link, nome as titulo,descricao";
$Sql.=" from posts_colunistas where (nome like'%".$busca."%' or descricao like'%".$busca."%'))";
if($acao!=2){
    if($offset>0)
        $Sql.=" LIMIT ".$offset.",".$per_page."";
    else
        $Sql.=" LIMIT ".$per_page;
}            
        $result = $this->db->query($Sql);
        $result2 =$result->result();

        if($acao!=2)
            return $result2;
        else
            return $result->num_rows;
	
	}
    
    function countbusca($busca,$offset,$per_page){ 

        $Sql="select *,CONVERT(VARCHAR(12),DataInicio,103) as DataIni, CONVERT(VARCHAR(12),DataTermino,103) as DataTerm from evento";
        $Sql.="  where ( FK_CodigoFiliado = ".$data->PK_CodigoFiliado."  or PK_CodigoEvento in (";
        $Sql.="  select FK_CodigoEvento from FiliadoEventoAdministrador where FK_CodigoFiliado = ".$data->PK_CodigoFiliado."  )"; 
        $Sql.="  or PK_CodigoEvento in ( select PK_CodigoEvento from FiliadoEvento where FK_CodigoFiliado = ".$data->PK_CodigoFiliado."  ) )";
        $Sql.="  and DataTermino > getdate()-1000";
        $Sql.="  order by DataInicio desc";
        $result = $this->db->query($Sql);
        $result2 =$result->result();
        return $result2;
	
	}
        
      
	
	
	
		
	
}

/* End of file usuarios_model.php */
/* Location: ./application/models/multitools/usuarios_model.php */
