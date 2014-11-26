<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Animal_add extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model'); 
    }
    
	public function index()
	{
	    $data['features'] = $this->html_helper->build_select_boxes($this->model->get_all_features());	    
	    $this->__load_view($data);
	}
	
	//functionallity to add new animal
	public function add()
	{
	    $this->load->library('form_validation');
	    $this->load->database();	    
	    $this->form_validation->set_rules('new_animal', 'Animal name', 'required|xss_clean|trim|is_unique[animals.animal]');
	    
	    if ($this->form_validation->run() == TRUE)
	    {	
	        //validation passed - add new animal
	        $this->model->add_new_animal($this->input->post('new_animal'), $this->input->post('features[]'));
	        $data['status'] = 'Added new animal';	     
	    }
	    
	    $data['features'] = $this->html_helper->build_select_boxes($this->model->get_all_features());
	    $this->__load_view($data);
	}
	
	private function __load_view($data)
	{
	    $this->load->view('header');
	    $this->load->view('add_animal', $data);
	    $this->load->view('footer');   
	}
	
}
