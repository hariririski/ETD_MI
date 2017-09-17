<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


   function __construct() {
       parent::__construct();
			 $this->load->helper('url');
			 $this->load->library('session');
			 $this->load->database();
			 $this->load->model('M_Login');
			 $this->load->model('M_Prodi');
			 $admin=$this->session->userdata('admin');


   }

	public function index()
	{
		if( empty($admin)==0 ){

		 redirect("home");
		}
		$this->load->view('login');
	}

	public function logout() {
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		redirect('login');
	}

  public function register() {
		$data['prodi'] = $this->M_Prodi->lihat();
		$this->load->view('Register',$data);
	}
	
	 public function proses_daftar() {
		$cek= $this->M_Login->daftar();
		if($cek){
           
           redirect('login');
         }else{
           $this->tambah_gagal();
           redirect('daftar');
         }
	}

	public function proses_login() {
		$cek=$this->M_Login->login();
		if($cek==true){
			$username= $cek[0]->username;
			$level= $cek[0]->level;
			session_save_path();
			$this->session->set_userdata('login',$username);
			$this->session->set_userdata('level',$level);
			redirect('home');

		}else{
			$data="document.getElementById('exampleTopFullWidth').click();";
			$this->session->set_flashdata('pesan', 'onload="'.$data.'"');
			redirect('login');
		}
	}
	
	
	
	
    function tambah_gagal(){
        $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Gagal!</strong> Proses Pendaftaran Gagal!.
                </div>');
     }
    

}
