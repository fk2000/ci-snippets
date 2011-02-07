<?php
class Snippets extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('snippets_view');
	}
}

/* End of file snippets.php */
/* Location: ./system/application/controllers/snippets.php */
