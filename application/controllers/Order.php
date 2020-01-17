<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
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
            $config['base_url'] = base_url() . 'order/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'order/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'order/index.html';
            $config['first_url'] = base_url() . 'order/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Order_model->total_rows($q);
        $order = $this->Order_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'order_data' => $order,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('layout/header');
        $this->load->view('order/order_list', $data);
         $this->load->view('layout/footer');
    }

    public function read($id) 
    {
        $row = $this->Order_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_order' => $row->id_order,
		'link_produk' => $row->link_produk,
		'nama' => $row->nama,
		'no_whatsapp' => $row->no_whatsapp,
		'status' => $row->status,
		'no_undian' => $row->no_undian,
		'tanggal' => $row->tanggal,
		'jam' => $row->jam,
		'tahun' => $row->tahun,
	    );
              $this->load->view('layout/header');
            $this->load->view('order/order_read', $data);
              $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('order/create_action'),
	    'id_order' => set_value('id_order'),
	    'link_produk' => set_value('link_produk'),
	    'nama' => set_value('nama'),
	    'no_whatsapp' => set_value('no_whatsapp'),
	    'status' => set_value('status'),
	    'no_undian' => set_value('no_undian'),
	    'tanggal' => set_value('tanggal'),
	    'jam' => set_value('jam'),
	    'tahun' => set_value('tahun'),
	);
          $this->load->view('layout/header');
        $this->load->view('order/order_form', $data);
          $this->load->view('layout/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'link_produk' => $this->input->post('link_produk',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'no_whatsapp' => $this->input->post('no_whatsapp',TRUE),
		'status' => $this->input->post('status',TRUE),
		'no_undian' => $this->input->post('no_undian',TRUE),
		'tanggal' => date('Y-m-d'),
		'jam' =>date('H:i:s a'),
		'tahun' => date('Y'),
	    );

            $this->Order_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('order'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Order_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('order/update_action'),
		'id_order' => set_value('id_order', $row->id_order),
		'link_produk' => set_value('link_produk', $row->link_produk),
		'nama' => set_value('nama', $row->nama),
		'no_whatsapp' => set_value('no_whatsapp', $row->no_whatsapp),
		'status' => set_value('status', $row->status),
		'no_undian' => set_value('no_undian', $row->no_undian),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jam' => set_value('jam', $row->jam),
		'tahun' => set_value('tahun', $row->tahun),
	    );
              $this->load->view('layout/header');
            $this->load->view('order/order_form', $data);
              $this->load->view('layout/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_order', TRUE));
        } else {
            $data = array(
		'link_produk' => $this->input->post('link_produk',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'no_whatsapp' => $this->input->post('no_whatsapp',TRUE),
		'status' => $this->input->post('status',TRUE),
		'no_undian' => $this->input->post('no_undian',TRUE),
		'tanggal' => date('Y-m-d'),
        'jam' =>date('H:i:s a'),
        'tahun' => date('Y'),
	    );

            $this->Order_model->update($this->input->post('id_order', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('order'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Order_model->get_by_id($id);

        if ($row) {
            $this->Order_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('order'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('link_produk', 'link produk', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('no_whatsapp', 'no whatsapp', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('no_undian', 'no undian', 'trim|required');
	

	$this->form_validation->set_rules('id_order', 'id_order', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-16 23:47:17 */
/* http://harviacode.com */