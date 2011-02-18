<?php
/**
 * ci-snippets display controller
 * スニペット表示コントローラ
 *
 * @package		ci-snippets
 * @author		Yuya Terajima/e2esound.com
 * @copyright	Copyright (c) 2011 Yuya Terajima/e2esound.com
 * @license		MTI License?
 * @link		http://www.e2esound.com/
 * @since		Version 0.1β
 */

class Display extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array("snippets", "form"));
		$this->load->model("snippets_model");
	}

/**
 * Index action
 * スニペット一覧を表示
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function index($page = 0)
	{
		$this->load->library("pagination");

/*
 *	config/pagination.phpを設定しなかった場合
		// page
		$config["base_url"]   = base_url() . "/display/index";
		$config["total_rows"] = (int)$this->snippets_model->get_num_rows();
		$config["per_page"]   = 10;
		$this->pagination->initialize($config);
*/
		// Modelからデータ取得
		$data["list"]  = $this->snippets_model->select(10, (int)$page);

		// ページネーションが""を返した場合には常に"1"を表示
		$data["pager"] = ($this->pagination->create_links() === "") ? 1 : $this->pagination->create_links();

		$this->load->view("header_view");
		$this->load->view('display_view', $data);
		$this->load->view("footer_view");
	}

/**
 * code action
 * スニペット単独ページの表示
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function code($id)
	{
		$this->load->helper("form");

		$data["code"] = $this->snippets_model->select_one((int)$id);

		if(isset($data["code"]))
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

}

/* End of file display.php */
/* Location: /application/controllers/display.php */
