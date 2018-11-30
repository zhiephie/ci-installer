<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	function _installer($content, $data = NULL)
	{
		$datas = array(
			'head'		=> $this->load->view('installer/header', $data, TRUE),
      'content'	=> $this->load->view($content, $data, TRUE),
			'footer'	=> $this->load->view('installer/footer', $data, TRUE),
			);
		$this->load->view('installer/media', $datas);
	}
}
