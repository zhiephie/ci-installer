<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function _generate($content, $data = NULL)
	{
		if ($this->session->userdata('role_id') == 1 OR $this->session->userdata('role_id') == 2) {
			$menu['data_menu'] = $this->menu->get_tree_admin();
		} else {
			$menu['data_menu'] = $this->menu->get_tree();
		}
		$datas = array(
			'head'		=> $this->load->view('template/header', $data, TRUE),
      'sidemenu'	=> $this->load->view('template/sidemenu', $menu, TRUE),
      // 'sidemenu'	=> $this->load->view('template/sidemenu', $data, TRUE),
			'content'	=> $this->load->view($content, $data, TRUE),
			'footer'	=> $this->load->view('template/footer', $data, TRUE),
			);
		$this->load->view('template/media', $datas);
	}

	function _installer($content, $data = NULL)
	{
		$datas = array(
			'head'		=> $this->load->view('installer/header', $data, TRUE),
      'content'	=> $this->load->view($content, $data, TRUE),
			'footer'	=> $this->load->view('installer/footer', $data, TRUE),
			);
		$this->load->view('installer/media', $datas);
	}

	function _to_excel($content, $data = NULL)
	{
		$this->load->view($content, $data);
	}
}
