<?php
class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// ライブラリ、ヘルパーのload
		$this->load->library(array("session", "form_validation","security"));
		$this->load->helper("form");

		// form関連設定ファイルのload
		$this->config->load("form_data");

		// form_validationのルールを設定
		$this->form_validation->set_rules("title", "タイトル", "trim|required|xss_clean|strip_tags");
		$this->form_validation->set_rules("code_type", "言語", "required|xss_clean");
		$this->form_validation->set_rules("code", "コード", "trim|required");
	}

	function index()
	{

		//言語選択ドロップダウン情報を取得
		$data["code_type_options"]  = $this->config->item("code_type_options");

		// confirmページからPOSTデータがない場合
		if(empty($_POST))
		{
			// code_typeの設定状態を初期値へ
			$data["code_type_selected"] = $this->config->item("code_type_selected");
		}
		else // confirmページからの遷移の場合
		{
			// form_validationを走らせてset_value()の値を引き継がす
			$this->form_validation->run();

			// code_typeの設定状態を引継ぐ
			$data["code_type_selected"] = set_value("code_type_options");
		}

		// 各viewを表示
		$this->load->view("header_view");
		$this->load->view('edit_view', $data);
		$this->load->view('footer_view');

	}

	function confirm()
	{
		var_dump($_POST);
		// $this->security->csrf_verify();

		$this->load->helper("code_type");
		if($this->form_validation->run() === TRUE)
		{
			// 同一のset_value()を複数回呼び出した場合の対応
			$data["title"]     = set_value("title");
			$data["code_type"] = set_value("code_type");
			$data["code"]      = str_replace("\r\n\n", "\n", set_value("code"));
			// confirmページを表示
			$this->load->view("header_view");
			$this->load->view('edit_confirm_view', $data);
			$this->load->view("footer_view");
		}
		else
		{
			// 言語選択ドロップダウン情報を再取得
			$data["code_type_options"]  = $this->config->item("code_type_options");
			$data["code_type_selected"] = set_value("code_type");

			// editページを再表示
			$this->load->view('header_view');
			$this->load->view("edit_view", $data);
			$this->load->view('footer_view');

		}

	}

	function complete()
	{

		$this->load->model("snippets_model");
		// $this->load->database();

		if($this->snippets_model->insert($this->input->post("title"),$this->input->post("code_type"), str_replace("\r\n\n", "\n", $this->input->post("code"))))
		{
			$data["title"]     = "Edit Completed!!";
			$data["paragraph"] = "新しいスニペットの登録が完了しました。";
		}
		else
		{
			$data["title"]     = "Edit Error!!";
			$data["paragraph"] = "エラーが発生しました。再度登録し直してください。";
		}

		// completeページ表示
		$this->load->view("header_view");
		$this->load->view("edit_complete_view", $data);
		$this->load->view("footer_view");

	}

	function delete()
	{
		$this->load->model("snippets_model");
		$result = $this->snippets_model->delete((int)$this->input->post("id"));
		if($result === TRUE)
		{
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: " . base_url());
		}
		else
		{
			echo "削除に失敗しました。";
		}
	}

}

/* End of file edit.php */
/* Location: ./system/application/controllzrs/edit.php */
