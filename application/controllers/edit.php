<?php
class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// ライブラリ、ヘルパーのload
		$this->load->library(array("session", "form_validation"));
		$this->load->helper("form");

		// form関連設定ファイルのload
		$this->config->load("form_data");

		// form_validation
		$this->form_validation->set_rules("title", "タイトル", "trim|required|xss_clean|strip_tags");
		$this->form_validation->set_rules("code_type", "言語", "required|xss_clean");
		$this->form_validation->set_rules("code", "コード", "trim|required");
	}

	function index()
	{
		//言語選択ドロップダウン情報を設定ファイルから取得
		$data["code_type_options"]  = $this->config->item("code_type_options");
		$data["code_type_selected"] = $this->config->item("code_type_selected");

		// ワンタイムチケット発行
		$this->ticket = md5(uniqid(mt_rand(), TRUE));
		$this->session->set_userdata("ticket", $this->ticket);

		// 各viewを表示
		$this->load->view("header_view");
		$this->load->view('edit_view', $data);
		$this->load->view('footer_view');

	}

	function confirm()
	{
		// ワンタイムチケット照合
		$this->ticket = $this->input->post("ticket");
		if(!isset($this->ticket) OR $this->ticket !== $this->session->userdata("ticket"))
		{
			echo "cookieを有効にしてください。cookieが有効な場合には不正な操作が行われました。";
			exit;
		}

		if($this->form_validation->run() === TRUE)
		{
			// confirmページを表示
			$this->load->view("header_view");
			$this->load->view('edit_confirm_view');
			$this->load->view("footer_view");
		}
		else
		{
			// 言語選択ドロップダウン情報を再取得
			$data["code_type_options"]  = $this->config->item("code_type_options");
			// optionのselectedの状態は$)POSTより設定
			$data["code_type_selected"] = $this->input->post("code_type");

			// editページを再表示
			$this->load->view('header_view');
			$this->load->view("edit_view", $data);
			$this->load->view('footer_view');

		}

	}

	function complete()
	{
		var_dump($_POST);
	}
}

/* End of file edit.php */
/* Location: ./system/application/controllzrs/edit.php */
