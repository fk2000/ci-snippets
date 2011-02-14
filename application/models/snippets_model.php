<?php
/**
 * ci-snippets model
 * スニペット編集用model
 *
 * @package		ci-snippets
 * @author		Yuya Terajima/e2esound.com
 * @copyright	Copyright (c) 2011 Yuya Terajima/e2esound.com
 * @license		MTI License?
 * @link		http://www.e2esound.com/
 * @since		Version 0.1β
 */

class Snippets_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

/**
 * insert method
 * データinsertメソッド
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function Insert($title, $code_type, $code)
	{
		if(empty($title) || empty($code_type) || empty($code))
		{
			return FALSE;
		}

		$sql = "INSERT INTO " .
						$this->db->protect_identifiers("snippets", TRUE) . "(title, code_type, code, created)
						VALUES(?, ?, ?, NOW())";

		return $this->db->query($sql, array($title, $code_type, $code));
	}

/**
 * update method
 * データ更新メソッド
 * // 今回は使いません
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function update($id,$title,$code_type,$code)
	{
		if(!is_int($id) || empty($title) || empty($code) || empty($code_type))
		{
			return FALSE;
		}

		$sql = "UPDATE " . $this->db->protect_identifiers("snippets", TRUE) .
					" SET
							title = ?,
							code_type = ?,
							code = ?,
							updated = NOW()
						WHERE
							id = ?";

		return $this->db->query($sql, array($title, $code_type, $code, $id));
	}


/**
 * delete method
 * データ論理削除メソッド
 *
 * invalid = 1へupdateし、削除状態に
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function delete($id)
	{
		if(!is_int($id))
		{
			return FALSE;
		}

		//論理削除
		$sql = "UPDATE " . $this->db->protect_identifiers("snippets", TRUE) .
						" SET
							invalid = 1,
							updated = NOW()
						WHERE
							id = ?";

		return $this->db->query($sql, $id);
	}

/**
 * select method
 * データ一覧表示メソッド
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function select($display = 5, $page = 0, $invalid = 0)
	{
		if(!is_int($display)
			|| !is_int($page)
			|| !is_int($invalid)
			|| $display < 0
			|| $page < 0)
		{
			return NULL;
		}

/*
		$sql = "SELECT
							id,
							title,
							code_type,
							code
						FROM " .
							$this->db->protect_identifiers("snippets", TRUE) .
							" WHERE
								invalid = ?
						ORDER BY
								updated DESC,  created DESC
								LIMIT ?, ?";

		$query = $this->db->query($sql, array($invalid, $page, $display));
 */
		// Active Recordクラスを使用する場合
		$this->db->select("id, title, code_type, code");
		$this->db->where("invalid", $invalid);
		$this->db->order_by("updated desc, created desc");
		$this->db->limit($display, $page);

		$query = $this->db->get("snippets");

		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row)
			{
				$result[] = $row;
			}
				return $result;
		}
		else
		{
			return NULL;
		}
	}

/**
 * select_one method
 * 単独ページ用表示メソッド
 *
 * idによってスニッペトを表示
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function select_one($id)
	{
		if(!is_int($id))
		{
			return NULL;
		}

		$sql = "SELECT
							title,
							code_type,
							code
						FROM " .
							$this->db->protect_identifiers("snippets", TRUE) .
						" WHERE
								id=? AND invalid = 0";

		$query = $this->db->query($sql, array($id));

		if($query->num_rows() > 0){
			return $query->row_array();
		}
		else
		{
			return NULL;
		}
	}

/**
 * get_num_rows method
 * 有効スニペット数取得関数
 *
 *
 * @package		ci-snippets
 * @category	Model
 * @author	  Yuya Terajima/e2esound.com
 */
	function get_num_rows($invalid = 0)
	{
		if(!is_int($invalid) || $invalid < 0 || $invalid > 1)
		{
			return 0;
		}

		$sql   = "SELECT id FROM " .
							$this->db->protect_identifiers("snippets", TRUE) .
							" WHERE
								invalid = ?";

		$count = $this->db->query($sql, array($invalid));

		return $count->num_rows();
	}
}

/* End of file snippets_model.php */
/* Location: /application/models/snippets_model.php */
