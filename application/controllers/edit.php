<?php
class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('edit_view');
	}
}

/* End of file edit.php */
/* Location: ./system/application/controllers/edit.php */
