<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Central_downloads extends MY_Controller {

	//Retira a proteção deste controller
	protected $_dontProtectMe = true;
	var $per_page = 6;

	public function __construct(){
		parent::__construct();

		//Carrega model e helpers
		$this->load->model("default_model");
        $this->load->helper('auxiliar_helper');
	}

	public function index($offset = 0){

		//Título
		$data['title'] = 'Central de Downloads';
		$data['url_pagina'] = 'central_downloads';

		// Pega 2 destaques e exibe no topo da seção
		$this->db->select('titulo, descricao, preco, downloads_categorias.nome_categoria')
				->from('downloads')
				->join('downloads_categorias','downloads.downloads_categorias_id_downloads_categorias = downloads_categorias.id_downloads_categorias','inner')
				->where('downloads.ativo', 's')
				->order_by('downloads.created', 'DESC')
				->limit(2);
		$query = $this->db->get();
		$data['query_destaques'] = $query;

		// Pega todos destaques e exibe com os detalhes de versão
		$this->db->select('downloads_versoes.*, titulo, descricao, preco, downloads.created, downloads_categorias.nome_categoria')
				->from('downloads')
				->join('downloads_categorias','downloads.downloads_categorias_id_downloads_categorias = downloads_categorias.id_downloads_categorias','inner')
				->join('downloads_versoes','downloads.id_downloads = downloads_versoes.downloads_id_downloads','inner')
				->where('downloads.ativo', 's')
				->order_by('downloads.created', 'DESC');
		$query = $this->db->get();
		$data['query_downloads'] = $query;


		// Pega todos destaques e exibe com os detalhes de versão
		$this->db->select('*')
				->from('downloads_versoes')
				->join('downloads','downloads.id_downloads = downloads_versoes.downloads_id_downloads','inner')
				->where('downloads_versoes.ativo', 's')
				->order_by('downloads_versoes.created', 'DESC')
				->group_by('downloads_id_downloads');
		$query = $this->db->get();
		$data['query_ultimas_versoes'] = $query;

		//Carrega view
		$this->loadView('central_downloads/central_downloads', $data);
	}
}
