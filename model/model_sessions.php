<?php
	class Model_Sessions extends CI_Model {
		public function addSession() {
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$data = array(
				'session_id'=>NULL,
				'starting_date'=>$startDate,
				'ending_date'=>$endDate
			);
			$this->db->insert('session',$data);
			$sql = "SELECT session_id FROM session WHERE starting_date='$startDate' AND ending_date='$endDate';";
			$query = $this->db->query($sql);
			foreach($query->result_array() as $row) $sessionId = $row['session_id'];
			$data = array('session_id'=>$sessionId);
			$sql = "UPDATE current_session SET session_id=$sessionId;";
			$this->db->query($sql);
			$classTable = "class".$sessionId;
			$sql = "CREATE TABLE $classTable(
				class_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				class_name VARCHAR(30)
			);";
			$this->db->query($sql);
			$sectionTable = "section".$sessionId;
			$sql = "CREATE TABLE $sectionTable(
				section_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				section_name VARCHAR(1),
				class_id INT UNSIGNED
			);";
			$this->db->query($sql);
			$studentTable = "student".$sessionId;
			$sql = "CREATE TABLE $studentTable(
				student_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				student_name VARCHAR(100),
				dob VARCHAR(10),
				nationality VARCHAR(20),
				religion VARCHAR(20),
				caste VARCHAR(20),
				last_school VARCHAR(200),
				hostel_facility ENUM('Y','N'),
				transport_facility ENUM('Y','N'),
				boarding_point VARCHAR(200),
				section_id INT UNSIGNED,
				class_id INT UNSIGNED,
				rollno INT UNSIGNED,
				father_name VARCHAR(100),
				father_qualification VARCHAR(50),
				father_occupation VARCHAR(50),
				father_anual_income DECIMAL UNSIGNED,
				father_contact_no VARCHAR(10),
				father_whatsapp_no VARCHAR(10),
				mother_name VARCHAR(100),
				mother_qualification VARCHAR(50),
				mother_occupation VARCHAR(50),
				mother_contact_no VARCHAR(10),
				family_anual_income DECIMAL UNSIGNED,
				village_town VARCHAR(50),
				ward_mahalla VARCHAR(50),
				post_office VARCHAR(50),
				police_station VARCHAR(50),
				district VARCHAR(50),
				pincode INT UNSIGNED,
				address_line1 VARCHAR(200),
				address_line2 VARCHAR(200),
				sib_name VARCHAR(100),
				sib_class VARCHAR(30),
				sib_section VARCHAR(1),
				sib_rollno INT UNSIGNED,
				studentImgUrl VARCHAR(200),
				fatherImgUrl VARCHAR(200),
				motherImgUrl VARCHAR(200)
			);";
			$this->db->query($sql);
			$sql = "UPDATE current_session SET session_id=$sessionId;";
			$this->db->query($sql);
			$tableName = 'reciept_student'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				reciept_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				reciept_date VARCHAR(10),
				reciept_date_decimal DECIMAL UNSIGNED,
				student_id INT UNSIGNED,

				new_admission_d VARCHAR(200),
				new_admission_val VARCHAR(10),
				new_admission_v DECIMAL,
				new_admission_a DECIMAL UNSIGNED,

				re_admission_d VARCHAR(200),
				re_admission_val VARCHAR(10),
				re_admission_v DECIMAL,
				re_admission_a DECIMAL UNSIGNED,

				new_hostel_d VARCHAR(200),
				new_hostel_val VARCHAR(10),
				new_hostel_v DECIMAL,
				new_hostel_a DECIMAL UNSIGNED,

				re_hostel_d VARCHAR(200),
				re_hostel_val VARCHAR(10),
				re_hostel_v DECIMAL,
				re_hostel_a DECIMAL UNSIGNED,

				monthly_tuition_d VARCHAR(200),
				monthly_tuition_val VARCHAR(10),
				monthly_tuition_v DECIMAL,
				monthly_tuition_a DECIMAL UNSIGNED,

				hostel_monthly_d VARCHAR(200),
				hostel_monthly_val VARCHAR(10),
				hostel_monthly_v DECIMAL,
				hostel_monthly_a DECIMAL UNSIGNED,

				computer_d VARCHAR(200),
				computer_val VARCHAR(10),
				computer_v DECIMAL,
				computer_a DECIMAL UNSIGNED,

				monthly_transport_d VARCHAR(200),
				monthly_transport_val VARCHAR(10),
				monthly_transport_v DECIMAL,
				monthly_transport_a DECIMAL UNSIGnED,

				examination_d VARCHAR(200),
				examination_val VARCHAR(10),
				examination_v DECIMAL,
				examination_a DECIMAL UNSIGnED,

				library_d VARCHAR(200),
				library_val VARCHAR(10),
				library_v DECIMAL,
				library_a DECIMAL UNSIGNED,

				game_d VARCHAR(200),
				game_val VARCHAR(10),
				game_v DECIMAL,
				game_a DECIMAL UNSIGNED,

				diary_d VARCHAR(200),
				diary_val VARCHAR(10),
				diary_v DECIMAL,
				diary_a DECIMAL UNSIGNED,

				mis_d VARCHAR(200),
				mis_val VARCHAR(10),
				mis_v DECIMAL,
				mis_a DECIMAL UNSIGNED,

				total DECIMAL UNSIGNED
			);";
			$this->db->query($sql);
			$tableName = 'reciept_other'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				reciept_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				income_details VARCHAR(1000),
				income_date VARCHAR(10),
				income_date_decimal DECIMAL UNSIGNED,
				income_amount DECIMAL UNSIGNED
			);";
			$this->db->query($sql);
			$tableName = 'reciept_expense'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				reciept_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				expense_details VARCHAR(1000),
				expense_date VARCHAR(10),
				expense_date_decimal DECIMAL UNSIGNED,
				expense_amount DECIMAL UNSIGNED
			);";
			$this->db->query($sql);
			$tableName="income".$sessionId;
			$sql = "CREATE TABLE $tableName(
				income_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				income_date VARCHAR(10),
				inocme_amount DECIMAL,
				reciept_id INT UNSIGNED
			);";
			$this->db->query($sql);
			$tableName = 'expense'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				expense_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				expense_date VARCHAR(10),
				expense_amount DECIMAL,
				reciept_id INT UNSIGNED
			);";
			$this->db->query($sql);
			$tableName = 'total_income'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				total_income DECIMAL
			);";
			$this->db->query($sql);
			$data = array('total_income'=>0);
			$this->db->insert($tableName,$data);
			$tableName = 'total_expense'.$sessionId;
			$sql = "CREATE TABLE $tableName(
				total_expense DECIMAL
			);";
			$this->db->query($sql);
			$data = array('total_expense'=>0);
			$this->db->insert($tableName,$data);
			$daysheetTable = 'daysheet'.$sessionId;
			$sql = "CREATE TABLE $daysheetTable(
				daysheet_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
				daysheet_date VARCHAR(10),
				opening_balance DECIMAL,
				closing_balance DECIMAL
			);";
			$this->db->query($sql);
			return True;
		}

		public function fetchSessionData() {
			$sql = "SELECT * FROM session ORDER BY session_id DESC;";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				$data = array(
					'curSessionId'=>$this->currentSessionId(),
					'readmissionSessionId'=>$this->readmissionSessionId(),
					'noOfStudents'=>$this->noOfStudents(),
					'income'=>$this->income(),
					'expense'=>$this->expense(),
					'sessions'=>$query->result_array()
				);
				return $data;
			}
			else return False;
		}

		public function readmissionSessionId() {
			$sql = "SELECT * FROM readmission;";
			$query = $this->db->query($sql);
			foreach($query->result_array() as $row) $readmissionSessionId = $row['session_id'];
			return $readmissionSessionId;
		}

		public function currentSessionId() {
			$sql = "SELECT * FROM current_session;";
			$query = $this->db->query($sql);
			foreach($query->result_array() as $row) $curSessionId = $row['session_id'];
			return $curSessionId;
		}

		public function noOfStudents() {
			$sql = "SELECT session_id FROM session;";
			$query = $this->db->query($sql);
			$noOfStudents = array();
			foreach($query->result_array() as $row) {
				$sessionId = $row['session_id'];
				$studentTable = "student".$sessionId;
				$sql = "SELECT * FROM $studentTable;";
				$q = $this->db->query($sql);
				$noOfStudents[$sessionId] = $q->num_rows();
			}
			return $noOfStudents;
		}

		public function income() {
			$sql = "SELECT session_id FROM session;";
			$query = $this->db->query($sql);
			$income = array();
			foreach($query->result_array() as $row) {
				$sessionId = $row['session_id'];
				$incomeTable = 'total_income'.$sessionId;
				$sql = "SELECT * FROM $incomeTable;";
				$q = $this->db->query($sql);
				foreach($q->result_array() as $row) $income[$sessionId] = $row['total_income'];
			}
			return $income;
		}

		public function expense() {
			$sql = "SELECT session_id FROM session;";
			$query = $this->db->query($sql);
			$expense = array();
			foreach($query->result_array() as $row) {
				$sessionId = $row['session_id'];
				$expenseTable = 'total_expense'.$sessionId;
				$sql = "SELECT * FROM $expenseTable;";
				$q = $this->db->query($sql);
				foreach($q->result_array() as $row) $income[$sessionId] = $row['total_expense'];
			}
			return $income;
		}

		public function getStartDate($startDate) {
			$sql = "SELECT * FROM session WHERE starting_date = '$startDate';";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) return True;
			else return False;
		}

		public function getEndDate($endDate) {
			$sql = "SELECT * FROM session WHERE ending_date = '$endDate';";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) return True;
			else return False;
		}

		public function setCurrentSession() {
			$sessionId = $this->checkSessionId();
			if($sessionId == False) return False;
			else {
				$readmissionSessionId = $this->readmissionSessionId();
				if($sessionId == $readmissionSessionId) $this->db->update('readmission',array('session_id'=>0));
				$sql = "UPDATE current_session SET session_id = $sessionId;";
				$this->db->query($sql);
				return True;
			}
		}

		public function editSession() {
			$sessionId = $this->checkSessionId();
			if($sessionId == False) return False;
			else {
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				$data = array(
					'starting_date'=>$startDate,
					'ending_date'=>$endDate
				);
				$this->db->where('session_id',$sessionId);
				$this->db->update('session',$data);
				return True;
			}
		}

		public function checkSessionId() {
			if(!isset($_GET['sessionid'])) return False;
			else {
				$sessionId = $this->input->get('sessionid');
				$sql = "SELECT * FROM session WHERE session_id = $sessionId;";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0) return $sessionId;
				else return False;
			}
		}

		public function removeSession() {
			$sessionId = $this->checkSessionId();
			if($sessionId == False) return False;
			else {
				$readmissionSessionId = $this->readmissionSessionId();
				if($sessionId == $readmissionSessionId) $this->db->update('readmission',array('session_id'=>0));
				$this->db->where('session_id',$sessionId);
				$this->db->delete('session');
				$classTable = "class".$sessionId;
				$sql = "DROP TABLE $classTable;";
				$this->db->query($sql);
				$sectionTable = "section".$sessionId;
				$sql = "DROP TABLE $sectionTable;";
				$this->db->query($sql);
				$studentTable = "student".$sessionId;
				$sql = "DROP TABLE $studentTable;";
				$this->db->query($sql);
				$incomeTable = 'income'.$sessionId;
				$sql = "DROP TABLE $incomeTable;";
				$this->db->query($sql);
				$expenseTable = "expense".$sessionId;
				$sql = "DROP TABLE $expenseTable;";
				$this->db->query($sql);
				$totalIncomeTable = 'total_income'.$sessionId;
				$sql = "DROP TABLE $totalIncomeTable;";
				$this->db->query($sql);
				$totalExpenseTable = 'total_expense'.$sessionId;
				$sql = "DROP TABLE $totalExpenseTable;";
				$this->db->query($sql);
				$recieptStudentTable = 'reciept_student'.$sessionId;
				$sql = "DROP TABLE $recieptStudentTable;";
				$this->db->query($sql);
				$recieptOtherTable = 'reciept_other'.$sessionId;
				$sql = "DROP TABLE $recieptOtherTable;";
				$this->db->query($sql);
				$recieptExpenseTable = 'reciept_expense'.$sessionId;
				$sql = "DROP TABLE $recieptExpenseTable;";
				$this->db->query($sql);
				$daysheetTable = 'daysheet'.$sessionId;
				$sql = "DROP TABLE $daysheetTable;";
				$this->db->query($sql);
				return True;
			}
		}

		public function setReadmission() {
			if(!(isset($_GET['sessionid']))) return False;
			$sessionId = $this->input->get('sessionid');
			$sql = "SELECT * FROM session WHERE session_id = $sessionId;";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				$data = array('session_id'=>$sessionId);
				$this->db->update('readmission',$data);
				return True;
			}
			else return False;
		}
	}
?>
