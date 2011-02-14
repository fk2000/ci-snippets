<?php
class Snippets_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function Insert($title, $code_type, $code)
	{
		if($title === "" || $code_type === "" || $code === "")
		{
			return FALSE;
		}

		$sql = "INSERT INTO " .
						$this->db->protect_identifiers("snippets", TRUE) . "(title, code_type, code, created)
						VALUES(?, ?, ?, NOW())";

		return $this->db->query($sql, array($title, $code_type, $code));
	}

	function update($id,$title,$code_type,$code)
	{
		if(is_int($id) === FALSE || $title === "" || $code === "" || $code_type === "")
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

	function select($display = 5, $page = 0, $invalid = 0)
	{
		if(!is_int($display) || !is_int($invalid))
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
		$this->db->where("invalid", "0");
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

	function get_num_rows($invalid = 0)
	{
		$sql   = "SELECT id FROM " .
							$this->db->protect_identifiers("snippets", TRUE) .
							" WHERE
								invalid = ?";

		$count = $this->db->query($sql, array($invalid));

		return $count->num_rows();
	}
}

/* End of file snippets_model.php */
/* Location: ./system/application/models/snippets_model.php */
