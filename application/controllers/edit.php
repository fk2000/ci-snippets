<?php
class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Library and helper
		$this->load->library("form_validation");
		$this->load->helper("form");
	}

	function index()
	{
		// form settings
		$data["form_title_attr"] = array('name'=> 'title',
																'id' => 'title',
																'value' => '',
																'maxlength'=> '100',
																'size' => '50');
		$data["form_code_attr"] = array("name" => "code",
															"id" => "code",
															"value" => "",
															"cols" => "90",
															"rows" => "20");
		$data["code_type_options"] = array("text" => "Plain Text",
																			 "php" => "PHP",
																			 "js"  => "JavaScript");
		$data["ticket"] = md5(uniqid(mt_rand(), TRUE));

		$this->load->view('edit_view', $data);
	}

	function confirm()
	{

	}

	function update()
	{

	}
}

/* End of file edit.php */
/* Location: ./system/application/controllers/edit.php */
