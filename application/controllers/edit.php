<?php
class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Library and helper
		$this->load->library(array("session", "form_validation"));
		$this->load->helper("form");

		// load original config
		$this->config->load("form_data");

		// form_validation
		$this->form_validation->set_rules("title", "タイトル", "trim|required|xss_clean|strip_tags");
		$this->form_validation->set_rules("code_type", "言語", "required|xss_clean");
		$this->form_validation->set_rules("code", "コード", "trim|required");
	}

	function index()
	{
		// form settings
		$data["code_type_options"]  = $this->config->item("code_type_options");
		$data["code_type_selected"] = $this->config->item("code_type_selected");

		// one time ticket
		$this->ticket = md5(uniqid(mt_rand(), TRUE));
		$this->session->set_userdata("ticket", $this->ticket);

		$this->load->view("header_view");
		$this->load->view('edit_view', $data);
		$this->load->view('footer_view');

	}

	function confirm()
	{
		$this->ticket = $this->input->post("ticket");
		if(!isset($this->ticket) OR $this->ticket !== $this->session->userdata("ticket"))
		{
			echo "cookieを有効にしてください。cookieが有効な場合には不正な操作が行われました。";
			exit;
		}

		if($this->form_validation->run() === TRUE)
		{
			// 確認ページ
			$this->load->view('edit_confirm_view');
		}
		else
		{
			$data["code_type_options"]  = $this->config->item("code_type_options");
			$data["code_type_selected"] = $this->input->post("code_type");

			$this->load->view('header_view');
			$this->load->view("edit_view", $data);
			$this->load->view('footer_view');

		}

	}

	function update()
	{

	}
}

/* End of file edit.php */
/* Location: ./system/application/controllzrs/edit.php */
