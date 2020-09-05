<?php
  class Model_Printdoc extends CI_Model {
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
     public function curSession() {
       $sql = "SELECT * FROM current_session;";
       $query = $this->db->query($sql);
       foreach($query->result_array() as $row) $sessionId = $row['session_id'];
       return $sessionId;
     }

     public function fetchRecieptData() {
       $recieptId = $this->recieptIdAuthentication();
       if($recieptId == False) return False;
       $curSession = $this->curSession();
       $recieptStudentTable = 'reciept_student'.$curSession;
       $sql = "SELECT student_id FROM $recieptStudentTable WHERE reciept_id = $recieptId;";
       $query = $this->db->query($sql);
       foreach($query->result_array() as $row) {
         $studentId = $row['student_id'];
       }
       $studentInfo = $this->studentInfo($studentId);
       $sql = "SELECT * FROM $recieptStudentTable WHERE reciept_id = $recieptId;";
       $query = $this->db->query($sql);
       $data = array(
         'studentInfo'=>$studentInfo,
         'recieptInfo'=>$query->result_array()
       );
       return $data;
     }

     public function studentInfo($studentId) {
       $curSession = $this->curSession();
       $studentTable = 'student'.$curSession;
       $sql = "SELECT student_name, father_name, rollno, class_id, section_id, studentImgUrl FROM $studentTable WHERE student_id = $studentId;";
       $query = $this->db->query($sql);
       if($query->num_rows() > 0) {
         foreach($query->result_array() as $row) {
           $studentName = $row['student_name'];
           $fatherName = $row['father_name'];
           $rollno = $row['rollno'];
           $classId = $row['class_id'];
           $sectionId = $row['section_id'];
           $url = $row['studentImgUrl'];
         }
         $classTable = 'class'.$curSession;
         $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
         $query = $this->db->query($sql);
         foreach($query->result_array() as $row) $className = $row['class_name'];
         $sectionTable = 'section'.$curSession;
         $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
         $query = $this->db->query($sql);
         foreach($query->result_array() as $row) $sectionName = $row['section_name'];
         $data = array(
           'studentName'=>$studentName,
           'fatherName'=>$fatherName,
           'rollno'=>$rollno,
           'className'=>$className,
           'sectionName'=>$sectionName,
           'url'=>$url
         );
         return $data;
       }
       else {
         $data = array(
           'studentName'=>'',
           'fatherName'=>'',
           'rollno'=>'',
           'className'=>'',
           'sectionName'=>''
         );
         return $data;
       }
     }

     public function salaryInfo() {
       $sql = "SELECT * FROM employee";
       $query = $this->db->query($sql);
       if($query->num_rows() > 0) return array('data'=>$query->result_array());
       else return array('data'=>array());
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

    public function daysheetData () {
      $daysheetId = $this->daysheetIdAuthentication();
      if($daysheetId == False) return False;
      $curSession = $this->curSession();
      $daysheetTable = 'daysheet'.$curSession;
      $sql = "SELECT * FROM $daysheetTable WHERE daysheet_id = $daysheetId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $daysheetDate = $row['daysheet_date'];
        $openingBalance = $row['opening_balance'];
        $closingBalance = $row['closing_balance'];
      }
      $studentTable = 'reciept_student'.$curSession;
      $sql = "SELECT total FROM $studentTable WHERE reciept_date = '$daysheetDate';";
      $query = $this->db->query($sql);
      $studentTotal = 0;
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) $studentTotal = $studentTotal + $row['total'];
      }
      $otherTable = 'reciept_other'.$curSession;
      $sql = "SELECT * FROM $otherTable WHERE income_date = '$daysheetDate';";
      $query = $this->db->query($sql);
      $otherIncomeTotal = 0;
      if($query->num_rows() > 0) {
        $otherIncome = $query->result_array();
        foreach($otherIncome as $row) {
          $otherIncomeTotal = $otherIncomeTotal + $row['income_amount'];
        }
      }
      else $otherIncome = array();
      $expenseTable = 'reciept_expense'.$curSession;
      $sql = "SELECT * FROM $expenseTable WHERE expense_date = '$daysheetDate';";
      $query = $this->db->query($sql);
      $expenseTotal = 0;
      if($query->num_rows() > 0) {
        $expense = $query->result_array();
        foreach($expense as $row) {
          $expenseTotal = $expenseTotal + $row['expense_amount'];
        }
      }
      else $expense = array();
      $totalCredit = $openingBalance + $studentTotal + $otherIncomeTotal;
      $totalDebit = $expenseTotal + $closingBalance;
      $data = array(
        'daysheetDate'=>$daysheetDate,
        'openingBalance'=>$openingBalance,
        'closingBalance'=>$closingBalance,
        'studentIncomeTotal'=>$studentTotal,
        'otherIncome'=>$otherIncome,
        'incomeTotal'=>$otherIncomeTotal + $studentTotal,
        'expense'=>$expense,
        'expenseTotal'=>$expenseTotal,
        'totalCredit'=>$totalCredit,
        'totalDebit'=>$totalDebit
      );
      return $data;
    }

    public function getStudentInfo() {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $studentId = $this->input->get('studentid');
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $classId = $row['class_id'];
        $sectionId = $row['section_id'];
        $data = array(
          'studentName' => $row['student_name'],
          'className' => $this->classNameById($classId),
          'sectionName' => $this->sectionNameById($sectionId),
          'rollno' => $row['rollno'],
          'dob' => $row['dob'],
          'nationality' => $row['nationality'],
          'religion' => $row['religion'],
          'caste' => $row['caste'],
          'lastSchool' => $row['last_school'],
          'hostelFacility' => $row['hostel_facility'],
          'transportFacility' => $row['transport_facility'],
          'boardingPoint' => $row['boarding_point'],
          'fatherName' => $row['father_name'],
          'fatherQualification' => $row['father_qualification'],
          'fatherOccupation' => $row['father_occupation'],
          'fatherAnualIncome'=>$row['father_anual_income'],
          'fatherContactNo' => $row['father_contact_no'],
          'fatherWhatsappNo' => $row['father_whatsapp_no'],
          'motherName' => $row['mother_name'],
          'motherQualification' => $row['mother_qualification'],
          'motherOccupation' => $row['mother_occupation'],
          'motherContactNo' => $row['mother_contact_no'],
          'familyAnualIncome' => $row['family_anual_income'],
          'villageTown' => $row['village_town'],
          'wardMahalla' => $row['ward_mahalla'],
          'postOffice' => $row['post_office'],
          'policeStation' => $row['police_station'],
          'district' => $row['district'],
          'pincode' => $row['pincode'],
          'addressLine1' => $row['address_line1'],
          'addressLine2' => $row['address_line2'],
          'sibName' => $row['sib_name'],
          'sibClass' => $row['sib_class'],
          'sibSection' => $row['sib_section'],
          'sibRollno' => $row['sib_rollno'],
          'studentUrl'=>$row['studentImgUrl'],
          'fatherUrl'=>$row['fatherImgUrl'],
          'motherUrl'=>$row['motherImgUrl']
        );
        return $data;
      }
    }

    public function classNameById($classId) {
      $curSession = $this->curSession();
      $classTable = 'class'.$curSession;
      $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $className = $row['class_name'];
      return $className;
    }

    public function sectionNameById($sectionId) {
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $sectionName = $row['section_name'];
      return $sectionName;
    }

    public function getEmployeeInfo() {
      if(!isset($_GET['employeeid'])) return False;
      $employeeId = $this->input->get('employeeid');
      $sql = "SELECT * FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $data = array(
            'employeeName'=>$row['employee_name'],
            'designation'=>$row['designation'],
            'qualification'=>$row['qualification'],
            'workExperience'=>$row['work_experience'],
            'doj'=>$row['doj'],
            'url'=>$row['url']
          );
          return $data;
        }
      }
      else return False;
    }
  }
?>
