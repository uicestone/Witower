<?php

class Piece extends WT_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('piece_model', 'piece');
	}
	
	function index() {
		$pieces = $this->piece->query();
		$this->load->view('piece/list', compact('pieces'));
	}
	
	function detail($id) {
		$this->load->model('project_model', 'project');
		$this->load->model('wit_model', 'wit');
		
		$piece = $this->piece->get($id);
		
		$piece['project'] && $piece['project'] = $this->project->fetch($piece['project']);
		$piece['wit'] && $piece['wit'] = $this->wit->fetch($piece['wit']);
		
		$this->load->view('piece/detail', compact('piece'));
	}
	
	function edit($id = null) {
		
		$this->load->model('project_model', 'project');
		
		$piece = $this->piece->get($id);
		
		if($this->input->post('submit') !== false){
			if(is_null($id)){
				$id = $this->piece->create($this->input->post());
				redirect('piece/edit/' . $id);
			}
			else{
				if($this->user->id !== $piece['user']){
					show_error('You have no permission to edit this piece.');
				}
				$this->piece->update($id, $this->input->post());
			}
		}
		
		if($this->input->post('remove') !== false && ($this->user->id === $piece['user'] || $this->user->isLogged('piece'))){
			$this->piece->remove($piece['id']);
			redirect('piece');
		}
		
		if(!is_null($id)){
			$piece = $this->piece->get($id);
			$piece['project_name'] = $this->project->fetch($piece['project'])['name'];
		}
		
		$this->load->view('piece/edit', compact('piece'));
	}
	
}
