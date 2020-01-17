<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_users_model');
        $this->load->library('form_validation');
          if((!$this->session->userdata('ses_email')) ){ 
            redirect('auth');
        } 
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_users/index.html';
            $config['first_url'] = base_url() . 'data_users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_users_model->total_rows($q);
        $data_users = $this->Data_users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_users_data' => $data_users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('layout/header');
        $this->load->view('data_users/data_users_list', $data);
        $this->load->view('layout/footer');
    }

    public function read($id) 
    {
        $row = $this->Data_users_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nama' => $row->nama,
		'email' => $row->email,
		'username' => $row->username,
		'password' => $row->password,
		// 'akses_level' => $row->akses_level,
        'akses_level' => $row->akses_level,
		'tanggal_update' => $row->tanggal_update,
	    );
            $this->load->view('layout/header');
            $this->load->view('data_users/data_users_read', $data);
            $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_users'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_users/create_action'),
	    'id_user' => set_value('id_user'),
	    'nama' => set_value('nama'),
	    'email' => set_value('email'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'akses_level' => set_value('akses_level'),

	    'tanggal_update' => set_value('tanggal_update'),
	);
        $this->load->view('layout/header');
        $this->load->view('data_users/data_users_form', $data);
        $this->load->view('layout/header');

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'email' => $this->input->post('email',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		// 'akses_level' => $this->input->post('akses_level',TRUE),
        'akses_level' => 1,
		'tanggal_update' => $this->input->post('tanggal_update',TRUE),
	    );

            $this->Data_users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_users/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'nama' => set_value('nama', $row->nama),
		'email' => set_value('email', $row->email),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'akses_level' => set_value('akses_level', $row->akses_level),
		'tanggal_update' => set_value('tanggal_update', $row->tanggal_update),
	    );
            $this->load->view('layout/header');
            $this->load->view('data_users/data_users_form', $data);
            $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_users'));
        }
    }
    
    public function update_action() 
    {
        $password_baru = $this->input->post('password',TRUE);
      
        if($password_baru == null){
            $password = $this->input->post('password_lama',TRUE);
        }else {
            $password = md5($this->input->post('password',TRUE));
        }
        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'email' => $this->input->post('email',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $password,
		// 'akses_level' => $this->input->post('akses_level',TRUE),
        'akses_level' => 1,
		'tanggal_update' => $this->input->post('tanggal_update',TRUE),
	    );

            $this->Data_users_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_users_model->get_by_id($id);

        if ($row) {
            $this->Data_users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[data_users.email]');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]');
	// $this->form_validation->set_rules('akses_level', 'akses level', 'trim|required');
	$this->form_validation->set_rules('tanggal_update', 'tanggal update', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_users.php */
/* Location: ./application/controllers/Data_users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-07 18:48:57 */
/* http://harviacode.com */