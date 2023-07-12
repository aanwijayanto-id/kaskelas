<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Act extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	function UseData(){
		$role = $this->session->userdata('id');
		return $this->db->query("SELECT * FROM db_users INNER JOIN db_role ON db_users.role_id = db_role.id_role WHERE db_users.id = '$role'");
	}

	function viewAll(){
		return $this->db->query("SELECT * FROM db_users ORDER BY id");
	}

	function sekretarisAll(){
		return $this->db->query("SELECT * FROM db_users WHERE role_id = 2");

	}

	function siswaAll(){
		return $this->db->query("SELECT * FROM db_users WHERE role_id = 3");
	}

	function userView($id){
		$this->db->SELECT('*');
		$this->db->FROM('db_users');
		$this->db->WHERE('id', $id);
		return $this->db->get();
	}

	function delUser($id){
		$this->db->delete('db_users', ['id' => $id]);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	function income(){
		return $this->db->query("SELECT * FROM db_balance INNER JOIN db_users ON db_balance.id_user = db_users.id INNER JOIN db_category ON db_balance.id_category = db_category.id_category WHERE db_balance.type = 1 ORDER BY db_balance.id_balance DESC");
	}

	function expense(){
		return $this->db->query("SELECT * FROM db_balance INNER JOIN db_category ON db_balance.id_category = db_category.id_category WHERE db_balance.type = 2 ORDER BY db_balance.id_balance DESC");
	}

	function incomeMon(){
		return $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 1 AND date_input >= '".date('Y-m-01')."' AND date_input <= '".date('Y-m-31')."'");
	}

	function expenseMon(){
		return $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 2 AND date_input >= '".date('Y-m-01')."' AND date_input <= '".date('Y-m-31')."'");
	}

	function sumIncome(){
		$income = $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 1")->row_array();
		$expense = $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 2")->row_array();
		$sisa = $income['SUM(nominal)'] - $expense['SUM(nominal)'];
		return $sisa;
	}

	function persentase(){
		$income = $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 1")->row_array();
		$expense = $this->db->query("SELECT SUM(nominal) FROM db_balance WHERE type = 2")->row_array();
		if (empty($income['SUM(nominal)']) && empty($expense['SUM(nominal)'])) {
			$persentase = 0;
		} else {
			$persentase = ($expense['SUM(nominal)']*100)/$income['SUM(nominal)'];
		}
		
		return ceil($persentase);
	}

	function balanceView($id){
		$this->db->SELECT('*');
		$this->db->WHERE('id_balance', $id);
		return $this->db->get('db_balance');
	}
	
	function delBalance($id){
		$this->db->delete('db_balance', ['id_balance' => $id]);
		return ($this->db->affected_rows() > 0)?TRUE : FALSE;
	}

	function type(){
		return $this->db->query("SELECT * FROM db_category WHERE type_cat = 1 ORDER BY id_category DESC");
	}

	function category(){
		return $this->db->query("SELECT * FROM db_category WHERE type_cat = 2 ORDER BY id_category DESC");
	}

	function categoryView($id){
		$this->db->SELECT('*');
		$this->db->FROM('db_category');
		$this->db->WHERE('id_category', $id);
		return $this->db->get();
	}

	function delCategory($id){
		$this->db->delete('db_category', ['id_category' => $id]);
		return ($this->db->affected_rows() > 0)?TRUE : FALSE;
	}

	function januari(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-01-01'));
		$this->db->where('date_input <=', date('Y-01-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function februari(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-02-01'));
		$this->db->where('date_input <=', date('Y-02-d',strtotime('last day of this February')));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function maret(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-03-01'));
		$this->db->where('date_input <=', date('Y-03-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function april(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-04-01'));
		$this->db->where('date_input <=', date('Y-04-30'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function mei(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-05-01'));
		$this->db->where('date_input <=', date('Y-05-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function juni(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-06-01'));
		$this->db->where('date_input <=', date('Y-06-30'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function juli(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-07-01'));
		$this->db->where('date_input <=', date('Y-07-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function agustus(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-08-01'));
		$this->db->where('date_input <=', date('Y-08-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function september(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-09-01'));
		$this->db->where('date_input <=', date('Y-09-30'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function oktober(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-10-01'));
		$this->db->where('date_input <=', date('Y-10-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function november(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-11-01'));
		$this->db->where('date_input <=', date('Y-11-30'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function desember(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-12-01'));
		$this->db->where('date_input <=', date('Y-12-31'));
		$this->db->where('type', 1);
		return $this->db->get('db_balance');
	}

	function ejanuari(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-01-01'));
		$this->db->where('date_input <=', date('Y-01-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function efebruari(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-02-01'));
		$this->db->where('date_input <=', date('Y-02-d',strtotime('last day of this February')));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function emaret(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-03-01'));
		$this->db->where('date_input <=', date('Y-03-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function eapril(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-04-01'));
		$this->db->where('date_input <=', date('Y-04-30'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function emei(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-05-01'));
		$this->db->where('date_input <=', date('Y-05-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function ejuni(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-06-01'));
		$this->db->where('date_input <=', date('Y-06-30'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function ejuli(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-07-01'));
		$this->db->where('date_input <=', date('Y-07-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function eagustus(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-08-01'));
		$this->db->where('date_input <=', date('Y-08-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function eseptember(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-09-01'));
		$this->db->where('date_input <=', date('Y-09-30'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function eoktober(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-10-01'));
		$this->db->where('date_input <=', date('Y-10-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function enovember(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-11-01'));
		$this->db->where('date_input <=', date('Y-11-30'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}

	function edesember(){
		$this->db->SELECT('SUM(nominal)');
		$this->db->where('date_input >=', date('Y-12-01'));
		$this->db->where('date_input <=', date('Y-12-31'));
		$this->db->where('type', 2);
		return $this->db->get('db_balance');
	}
}
?>