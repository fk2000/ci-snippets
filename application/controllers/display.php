<?php
class Display extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("snippets_model");
	}

	function index($page = 0)
	{
		$this->load->library("pagination");

		// page
		$config["base_url"]   = base_url() . "/display/index";
		$config["total_rows"] = (int)$this->snippets_model->get_num_rows();
		$config["per_page"]   = 10;
		$this->pagination->initialize($config);

		$data["list"]  = $this->snippets_model->select(10, (int)$page);
		$data["pager"] = $this->pagination->create_links();

		$this->load->view("header_view");
		$this->load->view('display_view', $data);
		$this->load->view("footer_view");
	}

	function code($id)
	{
		$this->load->library("session");
		$this->load->helper("form");
		// 削除用ticketの発行
		$this->ticket = md5(uniqid(mt_rand(), TRUE));
		$this->session->set_userdata("ticket", $this->ticket);

		$data["code"] = $this->snippets_model->select_one((int)$id);

		if($data["code"] !== NULL)
		{
			$this->load->view("header_view");
			$this->load->view("display_code_view", $data);
			$this->load->view("footer_view");
		}
		else
		{
			show_404();
		}
	}

	function category($code_type)
	{

	}
}

/* End of file snippets.php */
/* Location: ./system/application/controllers/snippets.php */
