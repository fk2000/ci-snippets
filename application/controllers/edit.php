<?php
/**
 * ci-snippets edit controller
 * スニペット編集コントローラ
 *
 * @package		ci-snippets
 * @author		Yuya Terajima/e2esound.com
 * @copyright	Copyright (c) 2011 Yuya Terajima/e2esound.com
 * @license		MTI License
 * @link		http://www.e2esound.com/
 * @since		Version 0.1β
 */

class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// ライブラリ、ヘルパーのload
		$this->load->library(array("form_validation"));
		$this->load->helper(array("form", "snippets"));

		// form関連設定ファイルのload
		$this->config->load("form_data");

		// form_validationのルールを設定
		$this->form_validation->set_rules("title", "タイトル", "trim|required|max_length[200]|strip_tags|xss_clean");
		$this->form_validation->set_rules("code_type", "言語", "required|max_length[20]|callback_code_type_exists");
		$this->form_validation->set_rules("code", "コード", "trim|required|xss_clean");
	}

/**
 * Index action
 * 編集開始ページの表示
 * 確認ページからの修正
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
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
			$data["code_type_selected"] = set_value("code_type");
		}

		// 各viewを表示
		$this->load->view("header_view");
		$this->load->view('edit_view', $data);
		$this->load->view('footer_view');

	}

/**
 * confirm action
 * 入力内容確認ページの表示
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function confirm()
	{
		if(empty($_POST))
		{
			// エラーページ表示
			show_error('The action you have requested is not allowed.');
		}


		if($this->form_validation->run() === TRUE)
		{
			// confirmページを表示
			$this->load->view("header_view");
			$this->load->view("edit_confirm_view");
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

/**
 * complete action
 * 編集完了ページの表示
 * dbへのデータinsert
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function complete()
	{
		if(empty($_POST))
		{
			// エラーページ表示
			show_error('The action you have requested is not allowed.');
		}

		$this->load->model("snippets_model");

		// insert完了時に成功ページを表示
		if($this->snippets_model->insert(
																				$this->input->post("title"),
																				$this->input->post("code_type"),
																				str_replace("\r\n\n", "\n", $this->input->post("code"))
																			))
			{
				$data["message"]   = "Edit Completed!!";
				$data["paragraph"] = "新しいスニペットの登録が完了しました。";
			}
			else
			{
				$data["message"]   = "Edit Error!!";
				$data["paragraph"] = "エラーが発生しました。再度登録し直してください。";
			}

			// completeページ表示
			$this->load->view("header_view");
			$this->load->view("edit_complete_view", $data);
			$this->load->view("footer_view");

	}

/**
 * delete action
 * スニペット論理削アクション
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function delete()
	{
		$this->load->model("snippets_model");

		// 論理削除実行
		$result = $this->snippets_model->delete((int)$this->input->post("id"));

		// 削除完了時はdisplay/indexへ
		if($result === TRUE)
		{
			header("Location: " . base_url(), TRUE, 303);
		}
		else
		{
			show_error("Failure: Could not delete this data");
		}
	}

/**
 * code_type_exists method
 * form_validation用の検証メソッド
 *
 * @package		ci-snippets
 * @category	Controller
 * @author	  Yuya Terajima/e2esound.com
 */
	function code_type_exists($type)
	{
		if( ! is_string($type))
		{
			return FALSE;
		}

		// 設定ファイルからcode_typeの配列取得
		$type_list = $this->config->item("code_type_options");

		if(array_key_exists($type, $type_list))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('code_type_exists', '指定された %s には対応していません。');
			return FALSE;
		}
	}

}

/* End of file edit.php */
/* Location: /application/controllers/edit.php */
