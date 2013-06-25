<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class central_downloads extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;
	var $per_page = 6;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
        $this->load->helper('auxiliar_helper');
	}

	public function index($TipoAcesso=false,$offset = 0){

		//Título
		$data['title'] = 'Central de Downloads';
		$data['url_pagina'] = 'central-de-downloads';

          // aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
         if ($TipoAcesso=='J'){
            check_login_empresa();
            $usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
         }elseif ($TipoAcesso=='F'){
             check_login_aluno();
             $usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

         }elseif ($TipoAcesso =='FJ'){
             check_login_empresa(4);
            $usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

         }
         else{

             redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
         }
         $data['TipoAcesso']=$TipoAcesso;
                // este helper controla quem esta logado para exibir o menu da area restrita
                seleciona_menu_area_restrita($TipoAcesso);

		//Downloads do usuário
		$where = array('inscritos_id ' => $usuario_id, 'compras.status' => 'AP', 'downloads_versoes.ativo' => 'S', 'downloads.ativo' => 'S');
		$join = array('downloads_versoes' => array('where' => 'downloads.id_downloads = downloads_versoes.downloads_id_downloads', 'type' => 'inner'));
		$join += array('downloads_categorias' => array('where' => 'downloads_categorias.id_downloads_categorias = downloads.downloads_categorias_id_downloads_categorias', 'type' => 'inner'));
		$join += array('downloads_compras' => array('where' => 'downloads_compras.downloads_versoes_id_download_versoes = downloads_versoes.id_download_versoes', 'type' => 'inner'));
		$join += array('compras' => array('where' => 'compras.id = downloads_compras.compras_id', 'type' => 'inner'));
		$data['query_downloads'] = $this->default_model->get_all('downloads', array('downloads.*, downloads_compras.*, downloads_versoes.*, downloads_categorias.nome_categoria'), 0, NULL, $where, $join, 'data_inscricao', 'DESC', 'id_downloads');

		//Atualizações
		foreach($data['query_downloads'] as $key => $download){

			$where = 'id_download_versoes <> '.$download->id_download_versoes.' AND numero_versao > '.$download->numero_versao.' AND downloads_id_downloads = '.$download->id_downloads.' AND ativo = "S"';
			$versoes = $this->default_model->get_all('downloads_versoes', array('downloads_versoes.*'), 0, 1, $where, NULL, 'numero_versao', 'DESC');

			if($versoes){
				$data['downloads_atualizacoes'][$key] = $versoes[0];
				$data['downloads_atualizacoes'][$key]->titulo = $download->titulo;
			}

		}

		//Ultimos downloads (destaques)
		$join  = array('downloads_versoes' => array('where' => ' downloads_versoes.downloads_id_downloads = downloads.id_downloads', 'type' => 'inner'));
		$join += array('downloads_categorias' => array('where' => ' downloads_categorias.id_downloads_categorias = downloads.downloads_categorias_id_downloads_categorias', 'type' => 'inner'));
		$data['destaques'] = $this->default_model->get_all('downloads', array('downloads.*, downloads_categorias.nome_categoria'), 0, 2, array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S'), $join, 'id_downloads', 'DESC', 'id_downloads');

		// Popula as ABAS de categorias de downloads
		$this->db->select('id_downloads_categorias,nome_categoria')
				->from('downloads_categorias')
				->where(array('ativo' => 's', 'downloads_categorias_id_downloads_categorias' => NULL))
				->order_by('ordem','ASC');
		$query = $this->db->get();
		$data['query_categorias'] = $query;
		$primeira_categoria = $query->row(0);

		//Carrega view
		$this->loadView('central_downloads/central_downloads', $data);

	}

	//esta função faz download direto sem estar logado
	public function functionUp_($id_download=false,$chave=false){

		if($id_download==false || $chave==false) {
			return false;
		}
		$this->db->select('*');
		$this->db->from('downloads_versoes');
		$this->db->where(array('id_download_versoes'=>$id_download,'chave'=>$chave));
		$query=  $this->db->get();

		if ($query->num_rows>0) {
			$result= $query->result();

			//Define o cabeçalho para download
			header('Content-type: application/'.$result[0]->formato_arquivo);
			header('Content-Disposition: attachment; filename="'.$result[0]->nome_arquivo_original.'"');
			header("Content-Transfer-Encoding: binary");
			header('Expires: 0');
			header('Pragma: no-cache');
			readfile('assets/uploads/downloads/'.$result[0]->nome_arquivo_servidor);

		}else{
			return false;
		}

	}

	public function teste(){
         $this->loadView('orcamento_online/orcamento_formulario');
    }



    // Lista as subcategorias daquela categoria
	public function get_subcategorias($id){
		$this->db->select('id_downloads_categorias,nome_categoria')
				->from('downloads_categorias')
				->where(array('ativo' => 's', 'downloads_categorias_id_downloads_categorias' => $id));
		$query = $this->db->get();
		$data['query_subcategorias'] = $query;
		$data['exibir_todos_downloads'] = TRUE;
		$this->loadView('central_downloads/includes/subcategorias',$data);
	}


	// Pega todos DOWNLOADS COMPRADOS pelo usuário naquela subcategoria
	public function get_downloads($id, $TipoAcesso){

		// aqui verifica aonde fica o gerenciamento de permissoes da area ele pe
		if ($TipoAcesso=='J'){
			check_login_empresa();
			$usuario_id= $this->session->userdata('SessionIdEmpresa'); //Id do usu�rio logado e selecionado
		}elseif ($TipoAcesso=='F'){
			check_login_aluno();
			$usuario_id=$this->session->userdata('SessionIdAluno'); //Id do usu�rio logado e selecionado

		}elseif ($TipoAcesso =='FJ'){
			check_login_empresa(4);
			$usuario_id= $this->session->userdata('SessionEmpresaPermissoes'); //Id do usu�rio logado e selecionado

		}
		else{

			redirect(site_url());// redireciona para a home caso nenhuma opção seja selecionada
		}
		$data['TipoAcesso']=$TipoAcesso;

		//Where com id da categoria
		$where = 'inscritos_id = '.$usuario_id.' AND compras.status = "AP" AND downloads_versoes.ativo = "S" AND downloads.ativo = "S"';
		if($id)
			$where .= ' AND (downloads.downloads_categorias_id_downloads_categorias = '.$id.' OR downloads_categorias.downloads_categorias_id_downloads_categorias = '.$id.')';

		//Downloads do usuário
		$join = array('downloads_versoes' => array('where' => 'downloads.id_downloads = downloads_versoes.downloads_id_downloads', 'type' => 'inner'));
		$join += array('downloads_categorias' => array('where' => 'downloads_categorias.id_downloads_categorias = downloads.downloads_categorias_id_downloads_categorias', 'type' => 'inner'));
		$join += array('downloads_compras' => array('where' => 'downloads_compras.downloads_versoes_id_download_versoes = downloads_versoes.id_download_versoes', 'type' => 'inner'));
		$join += array('compras' => array('where' => 'compras.id = downloads_compras.compras_id', 'type' => 'inner'));
		$data['query_downloads'] = $this->default_model->get_all('downloads', array('downloads.*, downloads_compras.*, downloads_versoes.*, downloads_categorias.nome_categoria'), 0, NULL, $where, $join, 'id_downloads_compras', 'DESC', 'id_downloads');

		//Carrega view
		$this->loadView('central_downloads/includes/downloads',$data);
	}



    public function lista_downloads($offset = 0){
		//Título
		$data['title'] = 'Central de Downloads';
		$data['url_pagina'] = 'central-de-downloads';

		//Verifica se existe busca
		$busca = $this->input->get('busca');
    	$data['busca'] = $busca;

		//downloads
    	$join = array('downloads_versoes' => array('where' => ' downloads_versoes.downloads_id_downloads = downloads.id_downloads', 'type' => 'inner'));
		if($busca){
			$offset = $this->input->get('per_page');
			$data['central_downloads'] = $this->default_model->get_by_search('downloads', array('downloads.*'), array('downloads.ativo'=>'S','downloads.Destaque'=>'S', 'downloads_versoes.ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca, 'numero_versao' => $busca), $join, 'id_downloads', 'DESC', 'id_downloads');
			$data['paginacao'] = $this->_pagination('downloads', $busca, '/central_downloads/lista_downloads?busca='.$busca);
		}
		else{
			$data['central_downloads'] = $this->default_model->get_all('downloads', $campos = array('downloads.*'), $offset, $this->per_page, array('downloads.ativo'=>'S','downloads.Destaque'=>'S', 'downloads_versoes.ativo' => 'S'), $join, $order_by = 'id_downloads', $dir = 'DESC', 'id_downloads');
			$data['paginacao'] = $this->_pagination('downloads', false, '/central_downloads/lista_downloads');
		}

		//Menu de categorias
                $data['menu'][]=array('id'=>'0','nome'=>'Em Destaque','selected'=>'1');
                $where_menu = array('ativo' =>'S','downloads_categorias_id_downloads_categorias is Null'=>null);
                $menu=   $this->default_model->get_all('downloads_categorias', array('*'),  NULL,null, $where_menu, NULL, 'ordem', 'ASC');
                
                foreach ($menu as $item){
                     $data['menu'][]=array('id'=>$item->id_downloads_categorias,'nome'=>$item->nome_categoria,'selected'=>'0');
                    
                }
                 
               
                //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'modulo-de-pesquisa'";   
                //$where_cursos = "url = 'cursos-in-company' OR url = 'programas-de-desenvolvimento' OR url = 'programa-alta-performance'";
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

		//Carrega view
		$this->loadView('central_downloads/central_downloads_business_store', $data);
	}
        
        public function selecao_downloads_categorias($tipo_categoria){
            
                $dados = array(                 
                 'SessionSelecaoCategorias'=> $tipo_categoria
                 );
                $this->session->set_userdata($dados);
            
                //return $this->lista_downloads_categorias();
                
              redirect('central_downloads/lista_downloads_categorias');
            
        }
        
        public function lista_downloads_categorias($offset = 0){
                 $tipo_categoria= $this->session->userdata('SessionSelecaoCategorias');  
                 
                 $data['nome_categoria']=$this->default_model->get_all('downloads_categorias', $campos = array('downloads_categorias.*'), null,null, array('downloads_categorias.ativo'=>'S','id_downloads_categorias'=>$tipo_categoria), null, $order_by = null, $dir =null);
                 
                 
                //Título
		$data['title'] = 'Central de Downloads';
		$data['url_pagina'] = 'central-de-downloads';

		//Verifica se existe busca
		$busca = $this->input->get('busca');
                $data['busca'] = $busca;
                    
		//downloads
                $join = array('downloads_versoes' => array('where' => ' downloads_versoes.downloads_id_downloads = downloads.id_downloads', 'type' => 'inner'));
		if($busca){
                    //array('titulo' => $busca, 'descricao' => $busca, 'numero_versao' => $busca)
			$offset = $this->input->get('per_page');
			$data['central_downloads'] = $this->default_model->get_by_search('downloads', array('downloads.*'), "(downloads.ativo = 'S' AND downloads_versoes.ativo ='S' AND downloads_categorias_id_downloads_categorias ='".$tipo_categoria."') AND (titulo like '%".$busca."%' or descricao like '%".$busca."%' or numero_versao like '%".$busca."%')", $offset, $this->per_page, array(), $join, 'id_downloads', 'DESC', 'id_downloads');
                                               
                        
			$data['paginacao'] = $this->_pagination('downloads', $busca, '/central_downloads/lista_downloads?busca='.$busca);
		}
		else{
			$data['central_downloads'] = $this->default_model->get_all('downloads', $campos = array('downloads.*'), $offset, $this->per_page, array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S','downloads_categorias_id_downloads_categorias'=>$tipo_categoria), $join, $order_by = 'id_downloads', $dir = 'DESC', 'id_downloads');
			$data['paginacao'] = $this->_pagination('downloads', false, '/central_downloads/lista_downloads');
		}

		//Menu de categorias
                $data['menu'][]=array('id'=>'0','nome'=>'Em Destaque','selected'=>'0');
                $where_menu = array('ativo' =>'S','downloads_categorias_id_downloads_categorias is Null'=>null);
                $menu=   $this->default_model->get_all('downloads_categorias', array('*'),  NULL,null, $where_menu, NULL, 'ordem', 'ASC');
                
                foreach ($menu as $item){
                     $data['menu'][]=array('id'=>$item->id_downloads_categorias,'nome'=>$item->nome_categoria,'selected'=>$item->id_downloads_categorias==$tipo_categoria?'1':'0');
                    
                }
                 
               
                //Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'modulo-de-pesquisa'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

		//Carrega view
		$this->loadView('central_downloads/central_downloads_business_store_categorias', $data);
	}
        
        
        
        
        
        
        
        
        
        
        
        public function lista_downloads_aberto($id= 0){
		
		//Título
		$data['title'] = 'Central de Downloads';
		$data['url_pagina'] = 'central-de-downloads';

		//Verifica se existe busca
		$busca = $this->input->get('busca');
    	$data['busca'] = $busca;

		//downloads
            $join = array('downloads_versoes' => array('where' => ' downloads_versoes.downloads_id_downloads = downloads.id_downloads', 'type' => 'inner'));
		if($busca){
			//$offset = $this->input->get('per_page');
			//$data['central_downloads'] = $this->default_model->get_by_search('downloads', array('downloads.*'), array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S'), $offset, $this->per_page, array('titulo' => $busca, 'descricao' => $busca, 'numero_versao' => $busca), $join, 'id_downloads', 'DESC', 'id_downloads');
			//$data['paginacao'] = $this->_pagination('downloads', $busca, '/central_downloads/lista_downloads?busca='.$busca);
		}
		else{
			$data['central_downloads'] = $this->default_model->get_all('downloads', $campos = array('downloads.*'), null, null, array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S', 'downloads_versoes.id_download_versoes' =>$id), $join, $order_by = 'id_downloads', $dir = 'DESC', 'id_downloads');
			//$data['paginacao'] = $this->_pagination('downloads', false, '/central_downloads/lista_downloads');
		}

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Box blog e multimidia
		$data['box_blog'] = $this->default_model->get_all('posts', array('*'),  NULL, 1, $where, NULL, 'data', 'DESC');
		$data['box_multimidia'] = $this->default_model->get_all('podcasts', array('*'),  NULL, 1, NULL, NULL, 'data', 'DESC');

		//Veja também- páginas de cursos
		$where_cursos = "url = 'banco-de-talentos' or url = 'autodiagnosticos' or url = 'modulo-de-pesquisa'";   
		$data['paginas_cursos'] = $this->default_model->get_all('paginas', array('*'),  NULL, 3, $where_cursos, NULL, 'RAND()', '');

		//Carrega view
		$this->loadView('central_downloads/central_downloads_business_store_aberto', $data);
	}
        
        
        
        
        
        
        
        
        
        

        private function _pagination($table, $search = FALSE, $url){

		//Carrega library de paginação
		$this->load->library('pagination');
		$config['per_page']   = $this->per_page;
		$config['last_link']  = '';
		$config['first_link'] = '';

        $join = array('downloads_versoes' => array('where' => ' downloads_versoes.downloads_id_downloads = downloads.id_downloads', 'type' => 'inner'));

		//Parâmetro
		if($search){
			$config['page_query_string'] = TRUE;
			$config['total_rows']        = $this->default_model->count_by_search($table, array('titulo' => $search, 'descricao' => $search, 'numero_versao' => $search), array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S'), $join, 'id_downloads');
			$config['base_url']          = site_url().$url;
		}
		else{
			$config['uri_segment'] = 3;
			$config['total_rows']  = $this->default_model->count($table, array('downloads.ativo'=>'S', 'downloads_versoes.ativo' => 'S'), $join, 'id_downloads');
			$config['base_url']    = site_url().$url;
		}

		//Inicializa e retorna paginação
		$this->pagination->initialize($config);
		return $this->pagination->create_links();

	}

}