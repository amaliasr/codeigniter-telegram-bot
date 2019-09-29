<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAdmin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('model_wisata2');
        $this->load->helper('url','form');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('login');
	}
	public function DoLogin()
	{

		$this->load->library('session');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$login = $this->model_wisata2->login($username,$password);

		if ($login->num_rows() == 1) {
			foreach ($login->result() as $sess) {
				$sess_data['logged_in'] = 'LogIn';
				$sess_data['username'] = $sess->username; 
			}
			$this->session->set_userdata('logged_in',$sess_data);
			redirect('wisata2','refresh');
		}
		else{
			$this->form_validation->set_message("Login Gagal Username dan Password tidak valid");
			redirect(site_url('loginadmin'),'refresh');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('loginadmin','refresh');
	}

}

/* End of file LoginAdmin.php */
/* Location: ./application/controllers/LoginAdmin.php */