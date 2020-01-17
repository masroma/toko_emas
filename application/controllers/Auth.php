<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->library('Form_validation','database');
        $this->load->helper(array('Form', 'Cookie', 'String','url'));
    }

	public function index()
	{

		if($this->session->userdata('ses_id') != NULL){
         redirect('dashboard');
     }else {
     	
		$this->load->view('auth/login');
		 
		
     }
		
	}

	public function proses_login()
	{
		 $username=htmlspecialchars($this->input->post('email',TRUE),ENT_QUOTES);
	  $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
	  //echo $password; exit;
	  $remember = $this->input->post('remember');
	  
		$sql = $this->db->query("SELECT * FROM data_users where email='$username'");
		 
		$cek_email = $sql->num_rows();

		if($cek_email == null)
		    {
		       $this->session->set_flashdata('msge', 
                '<div class="alert alert-danger">
                	<h5>login gagal</h5>
                    <p class="text-alert">status belum aktif, silahkan cek email untuk verifikasi atau daftar ulang</p>
                </div>');    
			 redirect('auth');
			}
     
 
        $cek_user=$this->m_auth->checkAdmin($username,$password);
         if($cek_user->num_rows() > 0){ //jika login sebagai dosen
				 $data=$cek_user->row_array();
				 if($data['akses_level']=='1'){ 
                $this->session->set_userdata('masuk',TRUE);
				$this->session->set_userdata('akses_level','1');
				$this->session->set_userdata('ses_id',$data['id_user']);
				$this->session->set_userdata('ses_username',$data['username']);
				$this->session->set_userdata('ses_email',$data['email']);
				$this->session->set_userdata('ses_nama',$data['nama']);
				 $this->session->set_userdata('ses_akses',$data['akses_level']);
			   redirect('dashboard');
				 }
				//  }else if($data['akses_level']=='2'){
				// 	 $this->session->set_userdata('masuk',TRUE);
				// $this->session->set_userdata('akses_level','2');
				// $this->session->set_userdata('ses_id',$data['id_user']);
				// $this->session->set_userdata('ses_username',$data['username']);
				// $this->session->set_userdata('ses_email',$data['email']);
				// $this->session->set_userdata('ses_nama',$data['nama']);
				//  $this->session->set_userdata('ses_akses',$data['akses_level']);
				//    redirect('dashboard');
				//  }
				//    else if($data['akses_level']=='3'){
				// 	 $this->session->set_userdata('masuk',TRUE);
				// $this->session->set_userdata('akses_level','3');
				// $this->session->set_userdata('ses_id',$data['id_user']);
				// $this->session->set_userdata('ses_username',$data['username']);
				// $this->session->set_userdata('ses_email',$data['email']);
				// $this->session->set_userdata('ses_nama',$data['nama']);
				//  $this->session->set_userdata('ses_akses',$data['akses_level']);
				//   redirect('dashboard');
				//  }
				//   else if($data['akses_level']=='4'){
				// 	 $this->session->set_userdata('masuk',TRUE);
				// $this->session->set_userdata('akses_level','4');
				// $this->session->set_userdata('ses_id',$data['id_user']);
				// $this->session->set_userdata('ses_username',$data['username']);
				// $this->session->set_userdata('ses_email',$data['email']);
				// $this->session->set_userdata('ses_nama',$data['nama']);
				//  $this->session->set_userdata('ses_akses',$data['akses_level']);
				//   redirect('dashboard');
				//  }
				//   else if($data['akses_level']=='5'){
				// 	 $this->session->set_userdata('masuk',TRUE);
				// $this->session->set_userdata('akses_level','5');
				// $this->session->set_userdata('ses_id',$data['id_user']);
				// $this->session->set_userdata('ses_username',$data['username']);
				// $this->session->set_userdata('ses_email',$data['email']);
				// $this->session->set_userdata('ses_nama',$data['nama']);
				//  $this->session->set_userdata('ses_akses',$data['akses_level']);
				//   redirect('dashboard');
				//  }
               
             }else {
				$this->session->set_flashdata('msge', 
                '<div class="alert alert-danger">
                	<h5>login gagal</h5>
                    <p class="text-alert">username / password salah</p>
                </div>'); 
             	redirect('auth');
             }
               
	 }
 

	public function _daftarkan_session($row) 
		{
        // 1. Daftarkan Session
        $sess = array(
            'logged' => TRUE,
            'id_user' => $row->id_user,
            'username' => $row->username,
        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        redirect('home');        
    }

	public function register()
	{
		
		$this->load->view('auth/register');
		
	}

	public function proses_register()
	{
    //passing post data dari view
		   
		    $nama = $this->input->post('nama');
		    $whatsapp = $this->input->post('whatsapp');
		    $password = md5($this->input->post('password'));
			$email = $this->input->post('email');
			$akses = 'donatur';
			
			$sql = $this->db->query("SELECT * FROM user where email='$email' OR whatsapp = '$whatsapp' ");
			$cek_email = $sql->num_rows();
			
			if($cek_email > 0)
		    {
		       $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                	<h4>pendagtaran gagal</h4>
                    <p class="text-alert">email atau no whatsapp sudah terdaftar, silahkan LOGIN</p>
                </div>');    
			 redirect('auth/register');
			}
		    //memasukan ke array
		    $data = array(
		     'nama' => $nama,
		     'password' => $password,
		     'whatsapp' => $whatsapp,
			 'email' => $email,
			 'saldo' => 0,
			 'active' => 0,
			 'akses'=>$akses
		     );

		    $id = $this->m_auth->add_account($data);
		  
		    //enkripsi id
		    $encrypted_id = md5($id);
		  
		    $this->load->library('email');
		    $config = array();
		    $config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
		    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
		    $config['smtp_port']= "465";
		    $config['smtp_timeout']= "400";
		    $config['smtp_user']= "mromadhon75@gmail.com"; // isi dengan email kamu
		    $config['smtp_pass']= "Amanah@123"; // isi dengan password kamu
		    $config['crlf']="\r\n"; 
		    $config['newline']="\r\n"; 
		    $config['wordwrap'] = TRUE;
		    //memanggil library email dan set konfigurasi untuk pengiriman email
		   
		    $this->email->initialize($config);
		    //konfigurasi pengiriman
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject("Verifikasi Akun");
		    $this->email->message(
		     "terimakasih telah melakuan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
		      site_url("auth/verification/$encrypted_id")
		    );
		  
		    if($this->email->send())
		    {
		       $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                	<h4>pendagtaran berhasil</h4>
					<p class="text-alert">silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth/register');
		    }else
		    {
		     $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                	<h4>pendagtaran berhasil</h4>
                    <p class="text-alert">silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth/register');
		    }
		  
		  
		}

		public function proses_lupa_password()
		{
			  $email = $this->input->post('email');
		  
		   
        	$cek_email=$this->m_auth->checkEmail($email);
        	 if($cek_email->num_rows() > 0){ //jika login sebagai dosen
                $data=$cek_email->row_array();
		    //$id = $this->m_auth->add_account($data);
		 	 }
		    //enkripsi id
		    $encrypted_id = md5($data['id_user']);
		    $this->load->library('email');
		    $config = array();
		    $config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
		    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
		    $config['smtp_port']= "465";
		    $config['smtp_timeout']= "400";
		    $config['smtp_user']= "mromadhon75@gmail.com"; // isi dengan email kamu
		    $config['smtp_pass']= "Amanah@123"; // isi dengan password kamu
		    $config['crlf']="\r\n"; 
		    $config['newline']="\r\n"; 
		    $config['wordwrap'] = TRUE;
		    //memanggil library email dan set konfigurasi untuk pengiriman email
		   
		    $this->email->initialize($config);
		    //konfigurasi pengiriman
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject("Verifikasi Akun");
		    $this->email->message(
		     "anda telah melakukan permintaan untuk reset password, silahkan klik tautan di bawah ini untuk ganti password<br><br>".
		      site_url("auth/form_password_baru/$encrypted_id")
		    );

		     if($this->email->send())
		    {
		       $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                	<h4>pendagtaran berhasil
                    <p>silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth');
		    }else
		    {
		     $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                	<h4>pendagtaran berhasil
                    <p>silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth');
		    }
		}

		public function proses_lupa_username()
		{
			  $email = $this->input->post('email');
		  
		   
        	$cek_email=$this->m_auth->checkEmail($email);
        	 if($cek_email->num_rows() > 0){ //jika login sebagai dosen
                $data=$cek_email->row_array();
		    //$id = $this->m_auth->add_account($data);
		 	 }
		    //enkripsi id
		    $username = $data['username'];
		    $this->load->library('email');
		    $config = array();
		    $config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
		    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
		    $config['smtp_port']= "465";
		    $config['smtp_timeout']= "400";
		    $config['smtp_user']= "mromadhon75@gmail.com"; // isi dengan email kamu
		    $config['smtp_pass']= "Amanah@123"; // isi dengan password kamu
		    $config['crlf']="\r\n"; 
		    $config['newline']="\r\n"; 
		    $config['wordwrap'] = TRUE;
		    //memanggil library email dan set konfigurasi untuk pengiriman email
		   
		    $this->email->initialize($config);
		    //konfigurasi pengiriman
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject("permintaan username");
		    $this->email->message(
		     "anda telah melakukan permintaan untuk kirim username, ini adalah username anda<br><br>".$username
		    );

		     if($this->email->send())
		    {
		       $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                	<h4>pendagtaran berhasil
                    <p>silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth');
		    }else
		    {
		     $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                	<h4>pendagtaran berhasil
                    <p>silahkan lakukan verifikasi di email anda</p>
                </div>');    
			 redirect('auth');
		    }
		}


		public function verification($key)
		{
			 $this->load->helper('url');
			 $this->load->model('m_auth');
			 $this->m_auth->changeActiveState($key);
			 $this->session->set_flashdata('msge', 
                '<div class="alert alert-success">
                	<h4>pendaftaran berhasil</h4>
                    <p>silhkan login dengan akun anda</p>
                </div>');    
			 
			 redirect('auth');
			
			
		}

		public function reset_password()
		{
			$id_user = $this->input->post('id_user');
			$password = md5($this->input->post('password'));

			
		  	$this->db->set('password', $password);
			$this->db->where('md5(id_user)', $id_user);
			$this->db->update('user'); 
			redirect('auth');

		}

		public function form_password_baru($encrypted_id)
		{
			if($encrypted_id == null){
				redirect('Auth');
			}
			
			$data = array(
		        'id_user' =>$encrypted_id
		      
			  );
			  
			
    
			$this->load->view('front/header');
			$this->load->view('front/form_password_baru',$data);
			$this->load->view('front/footer');
		}

		public function lupa_password()
		{
			$this->load->view('front/header');
			$this->load->view('front/lupa_password');
			$this->load->view('front/footer');
		}

		public function lupa_username()
		{
			$this->load->view('header');
			$this->load->view('lupa_username');
			$this->load->view('footer');
		}

		public function logout() 
		{
		    $this->session->sess_destroy();
		    redirect('auth');
	  	}
}
