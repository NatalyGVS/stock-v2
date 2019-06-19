class Model_Caja extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	/* get datos de Caja */
	public function getActiveCategory()
	{
		$sql = "SELECT * FROM Caja WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	public function getCajaData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Caja WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM Caja";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getCajaName($id = null)
	{
		if($id) {
			$sql = "SELECT name FROM Caja WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT name FROM Caja";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function update($data)
	{
		if($data && $id) {
			$this->db->where('id', 1);
			$update = $this->db->update('Caja', $data);
			return ($update == true) ? true : false;
		}
	}
} 

