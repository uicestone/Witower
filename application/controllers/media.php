<?php

class Media extends WT_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function upload() {
		$this->load->library('upload', array(
			'upload_path'=>'./uploads/images',
			'allowed_types'=>'*',
			'encrypt_name'=>true,
		));

		if(!$_FILES['files']['error'] && !$this->upload->do_upload('files')){
			throw new Exception($this->upload->display_errors());
		}

		$upload_data = $this->upload->data();

		$this->load->library('image_lib',array(
			'source_image'=>$upload_data['full_path'],
			'maintain_ratio'=>true,
			'width'=>1024,
			'height'=>768,
			'new_image'=>'./uploads/images/' . $upload_data['raw_name'] . '-1024.jpg'
		));

		$this->image_lib->resize();

		$this->image_lib->clear();
		
		$upload_data['url'] = site_url() . 'uploads/images/' . $upload_data['file_name'];
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($upload_data));

	}
	
}