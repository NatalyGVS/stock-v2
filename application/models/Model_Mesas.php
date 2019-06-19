<?php 
class Model_mesas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	/* get datos de mesas */
	public function getActiveMesas()
	{
		$sql = "SELECT * FROM mesas ";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getMesasData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM mesas WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM mesas";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getMesasName($id = null)
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
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('mesas', $data);
			return ($insert == true) ? true : false;
		}
	}
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('mesas', $data);
			return ($update == true) ? true : false;
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('mesas');
			return ($delete == true) ? true : false;
		}
	}
}