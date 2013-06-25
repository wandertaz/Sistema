<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('br_date');
                $this->load->helper('auxiliar_helper');
               
	}

	public function index(){

		$data['msg'] =0;
                if($_GET){
                   $data['msg'] = $_GET['msg'];
                }
                //Título
		$data['title'] = 'Home';

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Busca os banners
		$data['banners'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = NULL, $where + array('tipo' => 'T', 'ativo' => 'S'), $join = NULL, $order_by = NULL, $dir = 'ASC');

		//Banner lateral (cursos)
		$data['banner_lateral'] = $this->default_model->get_all('banners', array('*'),  NULL, 1, $where + array('tipo' => 'L', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Publicações (último de cada categoria
		$data['revista']  = $this->default_model->get_all('revistas', array('*'), NULL, 1, $where,NULL, 'id', 'DESC');
		$data['artigo']   = $this->default_model->get_all('artigos', array('*'), NULL, 1, $where, NULL, 'id', 'DESC');
		$data['pesquisa'] = $this->default_model->get_all('pesquisas_estudos', array('*'), NULL, 1, $where, NULL, 'id', 'DESC');

		//Enquete
		$data['enquete']  = $this->default_model->get_all('enquetes', array('*'), NULL, 1, array('ativo' => 'S'), NULL, 'id', 'DESC');
		if($data['enquete'])
			$data['enquete'][0]->alternativas = $this->default_model->get_all('enquetes_alternativas', array('*'), NULL, NULL, array('enquete_id' => $data['enquete'][0]->id), NULL, 'id', 'ASC');

		//Busca banner publicitário (enquete)
		$data['banner_enquete'] = $this->default_model->get_all('banners', $campos = array('*'), $offset = NULL, $limit = 1, $where + array('tipo' => 'E', 'ativo' => 'S'), $join = NULL, $order_by = 'id', $dir = 'DESC');

		//Destaques
		$data['destaques'] = $this->default_model->get_all('noticias', array('*'), NULL, 2, $where + array('tipo' => 'D'),  NULL, 'data', 'DESC');

		//Blog
		$data['posts_home'] = $this->default_model->get_all('posts', array('*'), NULL, 2, $where,  NULL, 'data', 'DESC');

		//News
		$data['news'] = $this->default_model->get_all('noticias', array('*'), NULL, 2, $where + array('tipo' => 'N'),  NULL, 'data', 'DESC');

		//Multimidia
		$data['podcast'] = $this->default_model->get_all('podcasts', array('*'), NULL, 1, NULL,  NULL, 'data', 'DESC');
		$data['video']   = $this->default_model->get_all('videos', array('*'), NULL, 1, NULL,  NULL, 'data', 'DESC');

		//Carrega view
		$this->loadView('index', $data);
	}

	/**
	 * english
	 *
	 * Troca o site para o idioma inglês
	 *
	 * @access public
	 * @author Luana Castilho
	 * @return void
	 */
	public function english() {

		//Seta a linguagem e devolve para a index
		$this->setLanguage("english");
		return $this->index();
		//redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * portugues
	 *
	 * Troca o site para o idioma português
	 *
	 * @access public
	 * @author Luana Castilho
	 * @return void
	 */
	public function portugues() {

		//Seta a linguagem e devolve para a index
		$this->setLanguage("portugues");
		return $this->index();
		//redirect($_SERVER['HTTP_REFERER']);
	}

	public function votar_enquete(){

		//Título
		$data['title'] = 'Home';

		//dados do post
		$enquete = $this->input->post('enquete_id');
		$resposta = $this->input->post('resposta_id');

		//Insere voto
		$this->default_model->insert('enquetes_votos', array('enquete_id' => $enquete, 'alternativa_id' => $resposta));

		//Retorno
		$this->session->set_flashdata('msg', '<script>alert("Enviado com sucesso. Agradecemos a participação!");</script>');
		redirect(site_url().'home');
	}

	public function rss(){

		//Define where com id do idioma
		$where = array('idioma_id' => $this->session->userdata('idioma_id'));

		//Busca os itens
		$posts = $this->default_model->get_all('posts', array('*'), 0, NULL, $where, NULL, 'data', 'DESC');
		foreach($posts as $key => $post){
			$posts[$key]->categoria = 'BLOG';
			$posts[$key]->link = site_url('blog/ver_post/').'/'.$post->id.'/'.$post->url;
		}
		$videos = $this->default_model->get_all('videos', array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($videos as $key => $video){
			$videos[$key]->categoria = 'VÍDEO';
			$videos[$key]->link = site_url('multimidia/ver_video/').'/'.$video->id.'/'.$video->url;
		}
		$fotos = $this->default_model->get_all('galerias',  array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($fotos as $key => $foto){
			$fotos[$key]->categoria = 'GALERIA';
			$fotos[$key]->link = site_url('multimidia/ver_galeria/').'/'.$foto->id.'/'.$foto->url;
		}
		$audios = $this->default_model->get_all('podcasts',  array('*'), 0, NULL, NULL, NULL, 'data', 'DESC');
		foreach($audios as $key => $audio){
			$audios[$key]->categoria = 'PODCAST';
			$audios[$key]->link = site_url('multimidia/ver_podcast/').'/'.$audio->id.'/'.$audio->url;
		}

		//Mescla registros, por data
		$itens = array_merge($posts,$videos, $fotos,$audios);
		foreach($itens as $item)
			$registros[$item->data][] = $item;
		krsort($registros);

		//Inicia xml
		$conteudo  = '<?xml version="1.0" encoding="iso-88859-1"?>';
		$conteudo .= '<rss versao="2.0"><channel>';
		$conteudo .= '<title>MB Consultoria</title>
					  <link>'.site_url().'</link>
					  <description>Site - MB Consultoria</description>';

		//Adiciona os dados dos registros
		if($registros){
			foreach($registros as $registro){
				foreach($registro as $item){
					$conteudo .= '<item>';
					$conteudo .= '<title>'.$item->titulo.'</title>';
					$conteudo .= '<link>'.$item->link.'</link>';
					$conteudo .= '<pubDate>'.$item->data.'</pubDate>';
					$conteudo .= '<category>'.$item->categoria.'</category>';
					$conteudo .= '<description><![CDATA['.$item->descricao.']]></description>';
					$conteudo .= '<content><![CDATA['.$item->texto.']]></content>';
					$conteudo .= '</item>';
				}
			}
		}
		$conteudo .= '</channel></rss>';

		//Salva xml
		$xml = fopen('rss/rss.xml', "w");
		fwrite($xml, $conteudo);
		fclose($xml);

		//Redireciona
		header('Location: '. base_url().'rss/rss.xml');
	}
}
