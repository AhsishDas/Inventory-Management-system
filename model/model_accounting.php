<?php
  class Model_Accounting extends CI_Model {
    public function curSession() {
      $sql = "SELECT * FROM current_session;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $curSession = $row['session_id'];
        return $curSession;
      }
    }

    public function getStudentData() {
      $studentId = $this->studentIdAuthentication();
      if($studentId == False) return False;
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT student_id, rollno, student_name, father_name, class_id, section_id, hostel_facility, transport_facility FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $studentId = $row['student_id'];
        $rollno = $row['rollno'];
        $studentName = $row['student_name'];
        $fatherName = $row['father_name'];
        $classId = $row['class_id'];
        $sectionId = $row['section_id'];
        $hostelFacility = $row['hostel_facility'];
        $transportFacility = $row['transport_facility'];
      }
      $classTable = 'class'.$curSession;
      $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $className = $row['class_name'];
      }
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sectionName = $row['section_name'];
      }
      $data = array(
        'studentId'=>$studentId,
        'studentName'=>$studentName,
        'fatherName'=>$fatherName,
        'rollno'=>$rollno,
        'className'=>$className,
        'sectionName'=>$sectionName,
        'hostelFacility'=>$hostelFacility,
        'transportFacility'=>$transportFacility
      );
      return $data;
    }

    public function studentIdAuthentication() {
      if(!(isset($_GET['studentid']))) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $studentId;
      else return False;
    }

    public function recieptAction() {
      $studentId = $this->studentIdAuthentication();
      if($studentId == False) return False;
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $curDateDecimal = $year.$month.$day;

      $newAdmission = $this->input->post('newAdmissionAmount');
      if($newAdmission == '') $newAdmission = NULL;

      $newAdmissionDate = $this->input->post('newAdmissionDate');
      if($newAdmissionDate == '') $newAdmissionDateDec= NULL;
      else $newAdmissionDateDec = str_replace('-','',$newAdmissionDate);

      $reAdmission = $this->input->post('reAdmissionAmount');
      if($reAdmission == '') $reAdmission = NULL;

      $reAdmissionDate = $this->input->post('reAdmissionDate');
      if($reAdmissionDate == '') $reAdmissionDateDec = NULL;
      else $reAdmissionDateDec = str_replace('-','',$reAdmissionDate);

      $newHostel = $this->input->post('newHostelAmount');
      if($newHostel == '') $newHostel = NULL;

      $newHostelDate = $this->input->post('newHostelDate');
      if($newHostelDate == '') $newHostelDateDec = NULL;
      else $newHostelDateDec = str_replace('-','',$newHostelDate);

      $reHostel = $this->input->post('reHostelAmount');
      if($reHostel == '') $reHostel = NULL;

      $reHostelDate = $this->input->post('reHostelDate');
      if($reHostelDate == '') $reHostelDateDec = NULL;
      else $reHostelDateDec = str_replace('-','',$reHostelDate);

      $monthlyTuitionFees = $this->input->post('monthlyTuitionFeesAmount');
      if($monthlyTuitionFees == '') $monthlyTuitionFees = NULL;

      $monthlyTuitionFeesDate = $this->input->post('monthlyTuitionFeesDate');
      if($monthlyTuitionFeesDate == '') $monthlyTuitionFeesDateDec = NULL;
      else $monthlyTuitionFeesDateDec = str_replace('-','',$monthlyTuitionFeesDate);

      $hostelMonthlyFees = $this->input->post('hostelMonthlyFeesAmount');
      if($hostelMonthlyFees == '') $hostelMonthlyFees = NULL;

      $hostelMonthlyFeesDate = $this->input->post('hostelMonthlyFeesDate');
      if($hostelMonthlyFeesDate == '') $hostelMonthlyFeesDateDec = NULL;
      else $hostelMonthlyFeesDateDec = str_replace('-','',$hostelMonthlyFeesDate);

      $computer = $this->input->post('computerFeesAmount');
      if($computer == '') $computer = NULL;

      $computerFeesDate = $this->input->post('computerFeesDate');
      if($computerFeesDate == '') $computerFeesDateDec = NULL;
      else $computerFeesDateDec = str_replace('-','',$computerFeesDate);

      $monthlyTransport = $this->input->post('monthlyTransportFeesAmount');
      if($monthlyTransport == '') $monthlyTransport = NULL;

      $monthlyTransportFeesDate = $this->input->post('monthlyTransportFeesDate');
      if($monthlyTransportFeesDate == '') $monthlyTransportFeesDateDec = NULL;
      else $monthlyTransportFeesDateDec = str_replace('-','',$monthlyTransportFeesDate);

      $examination = $this->input->post('examinationFeesAmount');
      if($examination == '') $examination = NULL;

      $examinationFeesDate = $this->input->post('examinationFeesDate');
      if($examinationFeesDate == '') $examinationFeesDateDec = NULL;
      else $examinationFeesDateDec = str_replace('-','',$examinationFeesDate);

      $library = $this->input->post('libraryFeesAmount');
      if($library == '') $library = NULL;

      $libraryFeesDate = $this->input->post('libraryFeesDate');
      if($libraryFeesDate == '') $libraryFeesDateDec = NULL;
      else $libraryFeesDateDec = str_replace('-','',$libraryFeesDate);

      $game = $this->input->post('gameFeesAmount');
      if($game == '') $game = NULL;

      $gameFeesDate = $this->input->post('gameFeesDate');
      if($gameFeesDate == '') $gameFeesDateDec = NULL;
      else $gameFeesDateDec = str_replace('-','',$gameFeesDate);

      $diary = $this->input->post('diaryAmount');
      if($diary == '') $diary = NULL;

      $diaryDate = $this->input->post('diaryDate');
      if($diaryDate == '') $diaryDateDec = NULL;
      else $diaryDateDec = str_replace('-','',$diaryDate);

      $mis = $this->input->post('misAmount');
      if($mis == '') $mis = NULL;

      $misDate = $this->input->post('misDate');
      if($misDate == '') $misDateDec = NULL;
      else $misDateDec = str_replace('-','',$misDate);

      $total = $this->input->post('total');

      $newHostelDetails = $this->input->post('newHostelDetalis');
      if($newHostelDetails == '0') $newHostelDetails = '';

      $reHostelDetails = $this->input->post('reHostelDetails');
      if($reHostelDetails == '0') $reHostelDetails = '';

      $hostelMonthlyFeesDetails = $this->input->post('hostelMonthlyFeesDetails');
      if($hostelMonthlyFeesDetails == '0') $hostelMonthlyFeesDetails = '';

      $monthlyTransportFeesDetails = $this->input->post('monthlyTransportFeesDetails');
      if($monthlyTransportFeesDetails == '0') $monthlyTransportFeesDetails = '';

      $data = array(
        'reciept_id'=>NULL,
        'reciept_date'=>$curDate,
        'reciept_date_decimal'=>$curDateDecimal,
        'student_id'=>$studentId,

        'new_admission_d'=>$this->input->post('newAdmissionDetails'),
        'new_admission_v'=>$newAdmissionDateDec,
        'new_admission_val'=>$newAdmissionDate,
        'new_admission_a'=>$newAdmission,

        're_admission_d'=>$this->input->post('reAdmissionDetails'),
        're_admission_v'=>$reAdmissionDateDec,
        're_admission_val'=>$reAdmissionDate,
        're_admission_a'=>$reAdmission,

        'new_hostel_d'=>$newHostelDetails,
        'new_hostel_v'=>$newHostelDateDec,
        'new_hostel_val'=>$newHostelDate,
        'new_hostel_a'=>$newHostel,

        're_hostel_d'=>$reHostelDetails,
        're_hostel_v'=>$reHostelDateDec,
        're_hostel_val'=>$reHostelDate,
        're_hostel_a'=>$reHostel,

        'monthly_tuition_d'=>$this->input->post('monthlyTuitionFeesDetails'),
        'monthly_tuition_v'=>$monthlyTuitionFeesDateDec,
        'monthly_tuition_val'=>$monthlyTuitionFeesDate,
        'monthly_tuition_a'=>$monthlyTuitionFees,

        'hostel_monthly_d'=>$hostelMonthlyFeesDetails,
        'hostel_monthly_v'=>$hostelMonthlyFeesDateDec,
        'hostel_monthly_val'=>$hostelMonthlyFeesDate,
        'hostel_monthly_a'=>$hostelMonthlyFees,

        'computer_d'=>$this->input->post('computerFeesDetails'),
        'computer_v'=>$computerFeesDateDec,
        'computer_val'=>$computerFeesDate,
        'computer_a'=>$computer,

        'monthly_transport_d'=>$monthlyTransportFeesDetails,
        'monthly_transport_v'=>$monthlyTransportFeesDateDec,
        'monthly_transport_val'=>$monthlyTransportFeesDate,
        'monthly_transport_a'=>$monthlyTransport,

        'examination_d'=>$this->input->post('examinationFeesDetails'),
        'examination_v'=>$examinationFeesDateDec,
        'examination_val'=>$examinationFeesDate,
        'examination_a'=>$examination,

        'library_d'=>$this->input->post('libraryFeesDetails'),
        'library_v'=>$libraryFeesDateDec,
        'library_val'=>$libraryFeesDate,
        'library_a'=>$library,

        'game_d'=>$this->input->post('gameFeesDetails'),
        'game_v'=>$gameFeesDateDec,
        'game_val'=>$gameFeesDate,
        'game_a'=>$game,

        'diary_d'=>$this->input->post('diaryDetails'),
        'diary_v'=>$diaryDateDec,
        'diary_val'=>$diaryDate,
        'diary_a'=>$diary,

        'mis_d'=>$this->input->post('misDetails'),
        'mis_v'=>$misDateDec,
        'mis_val'=>$misDate,
        'mis_a'=>$mis,

        'total'=>$total
      );
      $curSession = $this->curSession();
      $recieptTable = 'reciept_student'.$curSession;
      $this->db->insert($recieptTable,$data);
      $recieptStudentTable = 'reciept_student'.$curSession;
      $sql = "SELECT reciept_id FROM $recieptStudentTable ORDER BY reciept_id DESC LIMIT 1;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $recieptId = $row['reciept_id'];
      $incomeTable = 'total_income'.$curSession;
      $sql = "SELECT * FROM $incomeTable;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $totalIncome = $row['total_income'];
      $totalIncome = $totalIncome + $total;
      $sql = "UPDATE $incomeTable SET total_income = $totalIncome;";
      $this->db->query($sql);
      return $recieptId;
    }

    public function getTotalIncomeExpense() {
      $curSession = $this->curSession();
      $table = 'total_income'.$curSession;
      $sql = "SELECT * FROM $table;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $income = $row['total_income'];
      $curSession = $this->curSession();
      $table = 'total_expense'.$curSession;
      $sql = "SELECT * FROM $table;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $expense = $row['total_expense'];
      $data = array(
        'income'=>$income,
        'expense'=>$expense
      );
      return $data;
    }

    public function newOtherIncome() {
      $curSession = $this->curSession();
      $recieptTable = 'reciept_other'.$curSession;
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $curDateDecimal = $year.$month.$day;
      $details = $this->input->post('details');
      $amount = $this->input->post('amount');
      $data = array(
        'reciept_id'=>NULL,
        'income_details'=>$details,
        'income_date'=>$curDate,
        'income_date_decimal'=>$curDateDecimal,
        'income_amount'=>$amount
      );
      $this->db->insert($recieptTable,$data);
      $totalIncomeTable = 'total_income'.$curSession;
      $sql = "SELECT * FROM $totalIncomeTable;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $totalIncome = $row['total_income'];
      $totalIncome = $totalIncome + $amount;
      $data = array(
        'total_income'=>$totalIncome
      );
      $this->db->update($totalIncomeTable,$data);
      return True;
    }

    public function newExpense() {
      $curSession = $this->curSession();
      $recieptTable = 'reciept_expense'.$curSession;
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $curDateDecimal = $year.$month.$day;
      $details = $this->input->post('details');
      $amount = $this->input->post('amount');
      $data = array(
        'reciept_id'=>NULL,
        'expense_details'=>$details,
        'expense_date'=>$curDate,
        'expense_date_decimal'=>$curDateDecimal,
        'expense_amount'=>$amount
      );
      $this->db->insert($recieptTable,$data);
      $totalExpenseTable = 'total_expense'.$curSession;
      $sql = "SELECT * FROM $totalExpenseTable;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $totalExpense = $row['total_expense'];
      $totalExpense = $totalExpense + $amount;
      $data = array(
        'total_expense'=>$totalExpense
      );
      $this->db->update($totalExpenseTable,$data);
      return True;
    }

    public function studentIncomeList() {
      $curSession = $this->curSession();
      $studentRecieptTable = 'reciept_student'.$curSession;
      if(isset($_POST['searchById'])) {
        $recieptId = $this->input->post('recieptId');
        if($recieptId == '') $sql = "SELECT * FROM $studentRecieptTable ORDER BY reciept_id DESC;";
        else $sql = "SELECT * FROM $studentRecieptTable WHERE reciept_id = $recieptId;";
      }
      elseif(isset($_POST['searchByDate'])) {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        if($startDate == '' && $endDate == '') $sql = "SELECT * FROM $studentRecieptTable ORDER BY reciept_id DESC;";
        elseif($startDate == '') {
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $studentRecieptTable WHERE reciept_date_decimal <= $endDateDecimal;";
        }
        elseif($endDate == '') {
          $startDateDecimal = str_replace('-','',$startDate);
          $sql = "SELECT * FROM $studentRecieptTable WHERE reciept_date_decimal >= $startDateDecimal;";
        }
        else {
          $startDateDecimal = str_replace('-','',$startDate);
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $studentRecieptTable WHERE reciept_date_decimal >= $startDateDecimal AND reciept_date_decimal <= $endDateDecimal;";
        }
      }
      else $sql = "SELECT * FROM $studentRecieptTable ORDER BY reciept_id DESC;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) $data = array('recieptInfo'=>$query->result_array());
      else $data = array('recieptInfo'=>array());
      return $data;
    }

    public function otherIncomeList() {
      $curSession = $this->curSession();
      $recieptOtherTable = 'reciept_other'.$curSession;
      if(isset($_POST['searchById'])) {
        $recieptId = $this->input->post('recieptId');
        if($recieptId == '') $sql = "SELECT * FROM $recieptOtherTable ORDER BY reciept_id DESC;";
        else $sql = "SELECT * FROM $recieptOtherTable WHERE reciept_id = $recieptId;";
      }
      elseif(isset($_POST['searchByDate'])) {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        if($startDate == '' && $endDate == '') $sql = "SELECT * FROM $recieptOtherTable ORDER BY reciept_id DESC;";
        elseif($startDate == '') {
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $recieptOtherTable WHERE income_date_decimal <= $endDateDecimal;";
        }
        elseif($endDate == '') {
          $startDateDecimal = str_replace('-','',$startDate);
          $sql = "SELECT * FROM $recieptOtherTable WHERE income_date_decimal >= $startDateDecimal;";
        }
        else {
          $startDateDecimal = str_replace('-','',$startDate);
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $recieptOtherTable WHERE income_date_decimal >= $startDateDecimal AND income_date_decimal <= $endDateDecimal;";
        }
      }
      else $sql = "SELECT * FROM $recieptOtherTable ORDER BY reciept_id DESC;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) $data = array('recieptInfo'=>$query->result_array());
      else $data = array('recieptInfo'=>array());
      return $data;
    }

    public function expenseList() {
      $curSession = $this->curSession();
      $expenseTable = 'reciept_expense'.$curSession;
      if(isset($_POST['searchById'])) {
        $recieptId = $this->input->post('recieptId');
        if($recieptId == '') $sql = "SELECT * FROM $expenseTable ORDER BY reciept_id DESC;";
        else $sql = "SELECT * FROM $expenseTable WHERE reciept_id = $recieptId;";
      }
      elseif(isset($_POST['searchByDate'])) {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        if($startDate == '' && $endDate == '') $sql = "SELECT * FROM $expenseTable ORDER BY reciept_id DESC;";
        elseif($startDate == '') {
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $expenseTable WHERE expense_date_decimal <= $endDateDecimal;";
        }
        elseif($endDate == '') {
          $startDateDecimal = str_replace('-','',$startDate);
          $sql = "SELECT * FROM $expenseTable WHERE expense_date_decimal >= $startDateDecimal;";
        }
        else {
          $startDateDecimal = str_replace('-','',$startDate);
          $endDateDecimal = str_replace('-','',$endDate);
          $sql = "SELECT * FROM $expenseTable WHERE expense_date_decimal >= $startDateDecimal AND expense_date_decimal <= $endDateDecimal;";
        }
      }
      else $sql = "SELECT * FROM $expenseTable ORDER BY reciept_id DESC;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) $data = array('recieptInfo'=>$query->result_array());
      else $data = array('recieptInfo'=>array());
      return $data;
    }

    public function recieptIdAuthentication() {
      if(!(isset($_GET['recieptid']))) return False;
      $recieptId = $this->input->get('recieptid');
      $curSession = $this->curSession();
      $recieptStudentTable = 'reciept_student'.$curSession;
      $sql = "SELECT * FROM $recieptStudentTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $recieptId;
      else return False;
    }

    public function fetchStudentRecieptData() {
      $recieptId = $this->recieptIdAuthentication();
      if($recieptId == False) return False;
      $curSession = $this->curSession();
      $recieptStudentTable = "reciept_student".$curSession;
      $sql = "SELECT * FROM $recieptStudentTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      $recieptInfo = $query->result_array();
      foreach($recieptInfo as $row) $studentId = $row['student_id'];
      $studentInfo = $this->fetchStudentData($studentId);
      $data = array(
        'recieptInfo'=>$recieptInfo,
        'studentInfo'=>$studentInfo
      );
      return $data;
    }

    public function fetchStudentData($studentId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT student_id, rollno, student_name, father_name, class_id, section_id FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $studentId = $row['student_id'];
        $rollno = $row['rollno'];
        $studentName = $row['student_name'];
        $fatherName = $row['father_name'];
        $classId = $row['class_id'];
        $sectionId = $row['section_id'];
      }
      $classTable = 'class'.$curSession;
      $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $className = $row['class_name'];
      }
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sectionName = $row['section_name'];
      }
      $data = array(
        'studentId'=>$studentId,
        'studentName'=>$studentName,
        'fatherName'=>$fatherName,
        'rollno'=>$rollno,
        'className'=>$className,
        'sectionName'=>$sectionName
      );
      return $data;
    }

    public function editReciept() {
      $recieptId = $this->recieptIdAuthentication();
      if($recieptId == False) return False;

      $newAdmission = $this->input->post('newAdmissionAmount');
      if($newAdmission == '') $newAdmission = NULL;

      $newAdmissionDate = $this->input->post('newAdmissionDate');
      if($newAdmissionDate == '') $newAdmissionDateDec= NULL;
      else $newAdmissionDateDec = str_replace('-','',$newAdmissionDate);

      $reAdmission = $this->input->post('reAdmissionAmount');
      if($reAdmission == '') $reAdmission = NULL;

      $reAdmissionDate = $this->input->post('reAdmissionDate');
      if($reAdmissionDate == '') $reAdmissionDateDec = NULL;
      else $reAdmissionDateDec = str_replace('-','',$reAdmissionDate);

      $newHostel = $this->input->post('newHostelAmount');
      if($newHostel == '') $newHostel = NULL;

      $newHostelDate = $this->input->post('newHostelDate');
      if($newHostelDate == '') $newHostelDateDec = NULL;
      else $newHostelDateDec = str_replace('-','',$newHostelDate);

      $reHostel = $this->input->post('reHostelAmount');
      if($reHostel == '') $reHostel = NULL;

      $reHostelDate = $this->input->post('reHostelDate');
      if($reHostelDate == '') $reHostelDateDec = NULL;
      else $reHostelDateDec = str_replace('-','',$reHostelDate);

      $monthlyTuitionFees = $this->input->post('monthlyTuitionFeesAmount');
      if($monthlyTuitionFees == '') $monthlyTuitionFees = NULL;

      $monthlyTuitionFeesDate = $this->input->post('monthlyTuitionFeesDate');
      if($monthlyTuitionFeesDate == '') $monthlyTuitionFeesDateDec = NULL;
      else $monthlyTuitionFeesDateDec = str_replace('-','',$monthlyTuitionFeesDate);

      $hostelMonthlyFees = $this->input->post('hostelMonthlyFeesAmount');
      if($hostelMonthlyFees == '') $hostelMonthlyFees = NULL;

      $hostelMonthlyFeesDate = $this->input->post('hostelMonthlyFeesDate');
      if($hostelMonthlyFeesDate == '') $hostelMonthlyFeesDateDec = NULL;
      else $hostelMonthlyFeesDateDec = str_replace('-','',$hostelMonthlyFeesDate);

      $computer = $this->input->post('computerFeesAmount');
      if($computer == '') $computer = NULL;

      $computerFeesDate = $this->input->post('computerFeesDate');
      if($computerFeesDate == '') $computerFeesDateDec = NULL;
      else $computerFeesDateDec = str_replace('-','',$computerFeesDate);

      $monthlyTransport = $this->input->post('monthlyTransportFeesAmount');
      if($monthlyTransport == '') $monthlyTransport = NULL;

      $monthlyTransportFeesDate = $this->input->post('monthlyTransportFeesDate');
      if($monthlyTransportFeesDate == '') $monthlyTransportFeesDateDec = NULL;
      else $monthlyTransportFeesDateDec = str_replace('-','',$monthlyTransportFeesDate);

      $examination = $this->input->post('examinationFeesAmount');
      if($examination == '') $examination = NULL;

      $examinationFeesDate = $this->input->post('examinationFeesDate');
      if($examinationFeesDate == '') $examinationFeesDateDec = NULL;
      else $examinationFeesDateDec = str_replace('-','',$examinationFeesDate);

      $library = $this->input->post('libraryFeesAmount');
      if($library == '') $library = NULL;

      $libraryFeesDate = $this->input->post('libraryFeesDate');
      if($libraryFeesDate == '') $libraryFeesDateDec = NULL;
      else $libraryFeesDateDec = str_replace('-','',$libraryFeesDate);

      $game = $this->input->post('gameFeesAmount');
      if($game == '') $game = NULL;

      $gameFeesDate = $this->input->post('gameFeesDate');
      if($gameFeesDate == '') $gameFeesDateDec = NULL;
      else $gameFeesDateDec = str_replace('-','',$gameFeesDate);

      $diary = $this->input->post('diaryAmount');
      if($diary == '') $diary = NULL;

      $diaryDate = $this->input->post('diaryDate');
      if($diaryDate == '') $diaryDateDec = NULL;
      else $diaryDateDec = str_replace('-','',$diaryDate);

      $mis = $this->input->post('misAmount');
      if($mis == '') $mis = NULL;

      $misDate = $this->input->post('misDate');
      if($misDate == '') $misDateDec = NULL;
      else $misDateDec = str_replace('-','',$misDate);

      $total = $this->input->post('total');

      $newHostelDetails = $this->input->post('newHostelDetalis');
      if($newHostelDetails == '0') $newHostelDetails = '';

      $reHostelDetails = $this->input->post('reHostelDetails');
      if($reHostelDetails == '0') $reHostelDetails = '';

      $hostelMonthlyFeesDetails = $this->input->post('hostelMonthlyFeesDetails');
      if($hostelMonthlyFeesDetails == '0') $hostelMonthlyFeesDetails = '';

      $monthlyTransportFeesDetails = $this->input->post('monthlyTransportFeesDetails');
      if($monthlyTransportFeesDetails == '0') $monthlyTransportFeesDetails = '';

      $data = array(

        'new_admission_d'=>$this->input->post('newAdmissionDetails'),
        'new_admission_v'=>$newAdmissionDateDec,
        'new_admission_val'=>$newAdmissionDate,
        'new_admission_a'=>$newAdmission,

        're_admission_d'=>$this->input->post('reAdmissionDetails'),
        're_admission_v'=>$reAdmissionDateDec,
        're_admission_val'=>$reAdmissionDate,
        're_admission_a'=>$reAdmission,

        'new_hostel_d'=>$newHostelDetails,
        'new_hostel_v'=>$newHostelDateDec,
        'new_hostel_val'=>$newHostelDate,
        'new_hostel_a'=>$newHostel,

        're_hostel_d'=>$reHostelDetails,
        're_hostel_v'=>$reHostelDateDec,
        're_hostel_val'=>$reHostelDate,
        're_hostel_a'=>$reHostel,

        'monthly_tuition_d'=>$this->input->post('monthlyTuitionFeesDetails'),
        'monthly_tuition_v'=>$monthlyTuitionFeesDateDec,
        'monthly_tuition_val'=>$monthlyTuitionFeesDate,
        'monthly_tuition_a'=>$monthlyTuitionFees,

        'hostel_monthly_d'=>$hostelMonthlyFeesDetails,
        'hostel_monthly_v'=>$hostelMonthlyFeesDateDec,
        'hostel_monthly_val'=>$hostelMonthlyFeesDate,
        'hostel_monthly_a'=>$hostelMonthlyFees,

        'computer_d'=>$this->input->post('computerFeesDetails'),
        'computer_v'=>$computerFeesDateDec,
        'computer_val'=>$computerFeesDate,
        'computer_a'=>$computer,

        'monthly_transport_d'=>$monthlyTransportFeesDetails,
        'monthly_transport_v'=>$monthlyTransportFeesDateDec,
        'monthly_transport_val'=>$monthlyTransportFeesDate,
        'monthly_transport_a'=>$monthlyTransport,

        'examination_d'=>$this->input->post('examinationFeesDetails'),
        'examination_v'=>$examinationFeesDateDec,
        'examination_val'=>$examinationFeesDate,
        'examination_a'=>$examination,

        'library_d'=>$this->input->post('libraryFeesDetails'),
        'library_v'=>$libraryFeesDateDec,
        'library_val'=>$libraryFeesDate,
        'library_a'=>$library,

        'game_d'=>$this->input->post('gameFeesDetails'),
        'game_v'=>$gameFeesDateDec,
        'game_val'=>$gameFeesDate,
        'game_a'=>$game,

        'diary_d'=>$this->input->post('diaryDetails'),
        'diary_v'=>$diaryDateDec,
        'diary_val'=>$diaryDate,
        'diary_a'=>$diary,

        'mis_d'=>$this->input->post('misDetails'),
        'mis_v'=>$misDateDec,
        'mis_val'=>$misDate,
        'mis_a'=>$mis,

        'total'=>$total
      );

      $curSession = $this->curSession();
      $recieptTable = 'reciept_student'.$curSession;
      $this->db->where('reciept_id',$recieptId);
      $this->db->update($recieptTable,$data);
      $recieptStudentTable = 'reciept_student'.$curSession;
      $sql = "SELECT reciept_id FROM $recieptStudentTable ORDER BY reciept_id DESC LIMIT 1;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $recieptId = $row['reciept_id'];
      $incomeTable = 'total_income'.$curSession;
      $sql = "SELECT * FROM $incomeTable;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $totalIncome = $row['total_income'];
      $totalIncome = $totalIncome + $total;
      $sql = "UPDATE $incomeTable SET total_income = $totalIncome;";
      $this->db->query($sql);
      return $recieptId;
    }

    public function incomeIdAuthentication() {
      if(!(isset($_GET['recieptid']))) return False;
      $recieptId = $this->input->get('recieptid');
      $curSession = $this->curSession();
      $incomeTable = 'reciept_other'.$curSession;
      $sql = "SELECT * FROM $incomeTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $recieptId;
      else return False;
    }

    public function incomeDetailsById() {
      $recieptId = $this->incomeIdAuthentication();
      if($recieptId == False) return False;
      $curSession = $this->curSession();
      $incomeTable = 'reciept_other'.$curSession;
      $sql = "SELECT * FROM $incomeTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      $data = array('incomeInfo'=>$query->result_array());
      return $data;
    }

    public function editIncome() {
      $recieptId = $this->incomeIdAuthentication();
      if($recieptId == False) return False;
      $curSession = $this->curSession();
      $incomeTable = 'reciept_other'.$curSession;
      $data = array(
        'income_details'=>$this->input->post('details'),
        'income_amount'=>$this->input->post('amount')
      );
      $this->db->where('reciept_id',$recieptId);
      $this->db->update($incomeTable, $data);
      return $recieptId;
    }

    public function expenseIdAuthentication() {
      if(!(isset($_GET['recieptid']))) return False;
      $recieptId = $this->input->get('recieptid');
      $curSession = $this->curSession();
      $expenseTable = 'reciept_expense'.$curSession;
      $sql = "SELECT * FROM $expenseTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $recieptId;
      else return False;
    }

    public function expenseDetialsById() {
      $recieptId = $this->expenseIdAuthentication();
      if($recieptId == False) return False;
      $curSession = $this->curSession();
      $expenseTable = 'reciept_expense'.$curSession;
      $sql = "SELECT * FROM $expenseTable WHERE reciept_id = $recieptId;";
      $query = $this->db->query($sql);
      $data = array(
        'expenseInfo'=>$query->result_array()
      );
      return $data;
    }

    public function editExpense() {
      $recieptId = $this->expenseIdAuthentication();
      if($recieptId == False) return False;
      $curSession = $this->curSession();
      $expenseTable = 'reciept_expense'.$curSession;
      $data = array(
        'expense_details'=>$this->input->post('details'),
        'expense_amount'=>$this->input->post('amount')
      );
      $this->db->where('reciept_id',$recieptId);
      $this->db->update($expenseTable, $data);
      return $recieptId;
    }

    public function createDaysheet() {
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $data = array(
        'daysheet_id'=>NULL,
        'daysheet_date'=>$curDate,
        'opening_balance'=>$this->input->post('openingBalance'),
        'closing_balance'=>$this->input->post('closingBalance')
      );
      $this->db->insert($daysheetTable,$data);
      $sql = "SELECT * FROM $daysheetTable ORDER BY daysheet_id DESC LIMIT 1;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $daysheetId = $row['daysheet_id'];
      return $daysheetId;
    }

    public function fetchDaysheetData() {
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      if(isset($_POST['daysheetDate']) && $_POST['daysheetDate'] != '') {
        $daysheetDate = $this->input->post('daysheetDate');
        $sql = "SELECT * FROM $daysheetTable WHERE daysheet_date = '$daysheetDate';";
      }
      else $sql = "SELECT * FROM $daysheetTable ORDER BY daysheet_id DESC;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) $data = array('daysheet'=>$query->result_array());
      else $data = array('daysheet'=>array());
      return $data;
    }

    public function daysheetIdAuthentication() {
      if(!(isset($_GET['daysheetid']))) return False;
      $daysheetId = $this->input->get('daysheetid');
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $sql = "SELECT * FROM $daysheetTable WHERE daysheet_id = $daysheetId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $daysheetId;
      else return False;
    }

    public function daysheetById() {
      $daysheetId = $this->daysheetIdAuthentication();
      if($daysheetId == False) return False;
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $sql = "SELECT * FROM $daysheetTable WHERE daysheet_id = $daysheetId;";
      $query = $this->db->query($sql);
      $data = array('daysheetInfo'=>$query->result_array());
      return $data;
    }

    public function editDaysheet() {
      $daysheetId = $this->daysheetIdAuthentication();
      if($daysheetId == False) return False;
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $data = array(
        'opening_balance'=>$this->input->post('openingBalance'),
        'closing_balance'=>$this->input->post('closingBalance')
      );
      $this->db->where('daysheet_id',$daysheetId);
      $this->db->update($daysheetTable, $data);
      return $daysheetId;
    }

    public function checkDaysheet() {
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $sql = "SELECT * FROM $daysheetTable WHERE daysheet_date = '$curDate';";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return True;
      else return False;
    }

    public function newDaysheetInfo() {
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $sql = "SELECT closing_balance FROM $daysheetTable ORDER BY daysheet_id DESC LIMIT 1;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) $closingBalance = $row['closing_balance'];
      }
      else $closingBalance = 0;
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.'-'.$month.'-'.$day;
      $expenseTable = 'reciept_expense'.$curSession;
      $sql = "SELECT expense_amount FROM $expenseTable WHERE expense_date = '$curDate';";
      $query = $this->db->query($sql);
      $total = 0;
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $total = $total + $row['expense_amount'];
        }
      }
      $data = array(
        'openingBalance'=>$closingBalance,
        'closingBalance'=>$closingBalance - $total
      );
      return $data;
    }
/*
    public function getEmployeeUrl() {
      if(!isset($_GET['employeeid'])) return False;
      $eimployeeId = $this->input->get('employeeid');
      $sql = "SELECT url FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        foreach($query->num_rows() as $row) {
          $url = $row['url'];
          if($url == '' || $url == NULL) $url = '/markazboys/index.php/assets/images/default/default_avatar.png';
        }
        return array('url'=>$url);
      }
      else return False;
    }*/
  }
?>
