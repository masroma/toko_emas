<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Produk_model','Kategori_model'));
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
            $config['base_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'produk/index.html';
            $config['first_url'] = base_url() . 'produk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Produk_model->total_rows($q);
        $produk = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('layout/header');
        $this->load->view('produk/produk_list', $data);
        $this->load->view('layout/footer');
    }

    public function read($id) 
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk' => $row->id_produk,
		'nama_produk' => $row->nama_produk,
		'kategori' => $row->kategori,
		'kode' => $row->kode,
		'keterangan' => $row->keterangan,
		'gambar1' => $row->gambar1,
		'gambar2' => $row->gambar2,
		'gambar3' => $row->gambar3,
		'gambar4' => $row->gambar4,
		'gambar5' => $row->gambar5,
		'status' => $row->status,
	    );
            $this->load->view('layout/header');
            $this->load->view('produk/produk_read', $data);
            $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
	    'id_produk' => set_value('id_produk'),
        'data_kategori' => $this->Kategori_model->get_all(),
	    'nama_produk' => set_value('nama_produk'),
	    'kategori' => set_value('kategori'),
	    'kode' => set_value('kode'),
	    'keterangan' => set_value('keterangan'),
	    'gambar1' => set_value('gambar1'),
	    'gambar2' => set_value('gambar2'),
	    'gambar3' => set_value('gambar3'),
	    'gambar4' => set_value('gambar4'),
	    'gambar5' => set_value('gambar5'),
	    'status' => set_value('status'),
	);
        $this->load->view('layout/header');
        $this->load->view('produk/produk_form', $data);
        $this->load->view('layout/footer');
    }
    
    public function create_action() 
    {

        $config['upload_path']        = './assets/produk';
        $config['allowed_types']    = 'jpg|png|gif|jpeg';
        $config['max_size']            = 40000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $this->upload->do_upload("gambar1");
        $data1 = $this->upload->data();
        $gambar1 = $data1['file_name'];

        $this->upload->do_upload("gambar2");
        $data2 = $this->upload->data();
        $gambar2 = $data2['file_name'];

        $this->upload->do_upload("gambar3");
        $data3 = $this->upload->data();
        $gambar3 = $data3['file_name'];

        $this->upload->do_upload("gambar4");
        $data4 = $this->upload->data();
        $gambar4 = $data4['file_name'];

        $this->upload->do_upload("gambar5");
        $data5 = $this->upload->data();
        $gambar5 = $data5['file_name'];

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'kode' => $this->input->post('kode',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'gambar1' => $gambar1,
		'gambar2' => $gambar2,
		'gambar3' => $gambar3,
		'gambar4' => $gambar4,
		'gambar5' => $gambar5,
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function update($id) 
    {

        $gambar1 =$this->input->post('gambar1_lama');
        $gambar2 = $this->input->post('gambar2_lama');
        $gambar3 =$this->input->post('gambar3_lama');
        $gambar4 =$this->input->post('gambar4_lama');
        $gambar5 =$this->input->post('gambar5_lama');
        
        $config['upload_path']        = './assets/produk';
        $config['allowed_types']    = 'jpg|png|gif|jpeg';
        $config['max_size']            = 40000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $this->upload->do_upload("gambar1");
        $data1 = $this->upload->data();
        if ($this->upload->do_upload("gambar1")){
            $gambar1 = $data1['file_name'];
        }
        

        $this->upload->do_upload("gambar2");
        $data2 = $this->upload->data();
        if ($this->upload->do_upload("gambar2")){
             $gambar2 = $data2['file_name'];
        }

        $this->upload->do_upload("gambar3");
        $data3 = $this->upload->data();
        if ($this->upload->do_upload("gambar3")){
             $gambar3 = $data3['file_name'];
        }

        $this->upload->do_upload("gambar4");
        $data4 = $this->upload->data();
        if ($this->upload->do_upload("gambar4")){
             $gambar4 = $data4['file_name'];
        }

        $this->upload->do_upload("gambar5");
        $data5 = $this->upload->data();
        if ($this->upload->do_upload("gambar5")){
              $gambar5 = $data5['file_name'];
        }
        

        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'nama_produk' => set_value('nama_produk', $row->nama_produk),
		'kategori' => set_value('kategori', $row->kategori),
		'kode' => set_value('kode', $row->kode),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'gambar1' => $gambar1,
		'gambar2' => $gambar2,
		'gambar3' => $gambar3,
		'gambar4' => $gambar4,
		'gambar5' => $gambar5,
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('layout/header');
            $this->load->view('produk/produk_form', $data);
            $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'kode' => $this->input->post('kode',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'gambar1' => $this->input->post('gambar1',TRUE),
		'gambar2' => $this->input->post('gambar2',TRUE),
		'gambar3' => $this->input->post('gambar3',TRUE),
		'gambar4' => $this->input->post('gambar4',TRUE),
		'gambar5' => $this->input->post('gambar5',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('gambar1', 'gambar1', 'trim|required');
	$this->form_validation->set_rules('gambar2', 'gambar2', 'trim|required');
	$this->form_validation->set_rules('gambar3', 'gambar3', 'trim|required');
	$this->form_validation->set_rules('gambar4', 'gambar4', 'trim|required');
	$this->form_validation->set_rules('gambar5', 'gambar5', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-16 23:47:17 */
/* http://harviacode.com */