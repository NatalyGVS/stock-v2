<?php 
class Model_client extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	/* get datos de Clientes */
	public function getActiveCategory()
	{
		$sql = "SELECT * FROM mesas WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getClientesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM mesas WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM Cliente";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getClientesName($id = null)
	{
		if($id) {
			$sql = "SELECT name FROM mesas WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT name FROM mesas";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getClientesActive($id = null)
	{
		if($id) {
			$sql = "SELECT active FROM mesas WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT active FROM mesas";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('Cliente', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Cliente', $data);
			return ($update == true) ? true : false;
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Cliente');
			return ($delete == true) ? true : false;
		}
	}
} 