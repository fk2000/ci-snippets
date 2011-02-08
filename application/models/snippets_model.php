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
		$sql = "INSERT INTO sn_snippets(title, code_type, code) VALUES(?, ?, ?)";
		return $this->db->query($sql, array($title, $code_type, $code));
	}

	function update($id,$title,$code_type,$code)
	{
		$sql = "UPDATE sn_snippets SET title = ?, code_type = ?, code = ?, updated = NOW() WHERE id = ?";
		return $this->db->query($sql, array($title, $code_type, $code, $id));
	}

	function delete($id)
	{
		//論理削除
		$sql = "UPDATE sn_snippets SET invalid = 1, updated = NOW() WHERE id = ?";
		return $this->db->query($sql, $id);
	}

	function select()
	{
		$sql = "SLECT id, title, code_type, code FROM sn_snippets WHERE invalid = 0 ORDER BY ASC LIMIT 5";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row)
			{
				$result = array($row);
			}
		}
		else
		{
			return NULL;
		}
	}

	function select_one($id)
	{
		$sql = "SELECT title, code_type, code FROM sn_snippets WHERE id=? AND invalid = 0";
		$query = $this->db->query($sql, array($id));

		if($query->num_row() > 0){
			return $query->row;
		}
		else
		{
			return NULL;
		}
	}
}

/* End of file snippets_model.php */
/* Location: ./system/application/models/snippets_model.php */
