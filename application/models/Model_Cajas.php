<?php 

class Model_cajas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get datos de cajas */
	public function getActiveCategory()
	{
		$sql = "SELECT * FROM caja WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getCajasData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM caja WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM caja";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getCajasName($id = null)
	{
		if($id) {
			$sql = "SELECT name FROM caja WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT name FROM caja";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getCajasActive($id = null)
	{
		if($id) {
			$sql = "SELECT active FROM caja WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT active FROM caja";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('caja', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('caja', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('caja');
			return ($delete == true) ? true : false;
		}
	}

}