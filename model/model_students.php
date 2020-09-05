<?php
  class Model_Students extends CI_Model {
    public function curSession() {
      $sql = "SELECT * FROM current_session;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $curSession = $row['session_id'];
      }
      return $curSession;
    }

    public function fetchClassData() {
      $sessionId = $this->curSession();
      $classTable = 'class'.$sessionId;
      $sql = "SELECT * FROM $classTable;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $data = array(
          'classes'=>$query->result_array(),
          'noOfStudents'=>$this->noOfStudents(),
          'totalStudents'=>$this->totalStudents()
        );
      }
      else $data = array('classes'=>array());
      return $data;
    }

    public function noOfStudents() {
      $sessionId = $this->curSession();
      $studentTable = 'student'.$sessionId;
      $classTable = 'class'.$sessionId;
      $sql = "SELECT class_id FROM $classTable;";
      $query = $this->db->query($sql);
      $noOfStudents = array();
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $classId = $row['class_id'];
          $sql = "SELECT * FROM $studentTable WHERE class_id = $classId;";
          $q = $this->db->query($sql);
          $noOfStudents[$classId] = $q->num_rows();
        }
      }
      return $noOfStudents;
    }

    public function totalStudents() {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT * FROM $studentTable;";
      $query = $this->db->query($sql);
      return $query->num_rows();
    }

    public function classIdAuthentication() {
      if(!isset($_GET['classid'])) return False;
      else {
        $classId = $this->input->get('classid');
        $curSession = $this->curSession();
        $classTable = 'class'.$curSession;
        $sql = "SELECT * FROM $classTable WHERE class_id = $classId;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) return $classId;
        else return False;
      }
    }

    public function sectionData($classId) {
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $data = array(
          'sections'=>$query->result_array()
        );
      }
      else {
        $data = array(
          'sections'=>array()
        );
      }
      return $data;
    }

    public function addStudent() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      if(isset($_POST['hostel'])) $hostelFacility = 'Y';
      else $hostelFacility = 'N';
      if(isset($_POST['transport'])) $transportFacility = 'Y';
      else $transportFacility = 'N';
      $sectionName = $this->input->post('section');
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_id FROM $sectionTable WHERE section_name = '$sectionName' AND class_id = $classId;";
      echo $sql;
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sectionId = $row['section_id'];
      }
      $fatherAnualIncome = $this->input->post('anualIncomeFather');
      if($fatherAnualIncome == '') $fatherAnualIncome = NULL;
      $familyAnualIncome = $this->input->post('familyAnualIncome');
      if($familyAnualIncome == '') $familyAnualIncome = NULL;
      $pincode = $this->input->post('pincode');
      if($pincode == '') $pincode = NULL;
      $sibRollno = $this->input->post('sibRollNo');
      if($sibRollno == '') $sibRollno = NULL;
      $data = array(
        'student_id'=>NULL,
        'student_name'=>$this->input->post('studentName'),
        'dob'=>$this->input->post('dob'),
        'nationality'=>$this->input->post('nationality'),
        'religion'=>$this->input->post('religion'),
        'caste'=>$this->input->post('caste'),
        'last_school'=>$this->input->post('lastSchool'),
        'hostel_facility'=>$hostelFacility,
        'transport_facility'=>$transportFacility,
        'boarding_point'=>$this->input->post('boardingPoint'),
        'section_id'=>$sectionId,
        'class_id'=>$classId,
        'rollno'=>$this->input->post('rollno'),
        'father_name'=>$this->input->post('fatherName'),
        'father_qualification'=>$this->input->post('qualificationFather'),
        'father_occupation'=>$this->input->post('occupationFather'),
        'father_anual_income'=>$fatherAnualIncome,
        'father_contact_no'=>$this->input->post('contactNoFather'),
        'father_whatsapp_no'=>$this->input->post('whatsappNoFather'),
        'mother_name'=>$this->input->post('motherName'),
        'mother_qualification'=>$this->input->post('qualificationMother'),
        'mother_occupation'=>$this->input->post('occupationMother'),
        'family_anual_income'=>$familyAnualIncome,
        'village_town'=>$this->input->post('villageTown'),
        'ward_mahalla'=>$this->input->post('wardMahalla'),
        'post_office'=>$this->input->post('postOffice'),
        'police_station'=>$this->input->post('policeStation'),
        'district'=>$this->input->post('district'),
        'pincode'=>$pincode,
        'address_line1'=>$this->input->post('presentAddressLine1'),
        'address_line2'=>$this->input->post('presentAddressLine2'),
        'sib_name'=>$this->input->post('sibName'),
        'sib_class'=>$this->input->post('sibClass'),
        'sib_section'=>$this->input->post('sibSection'),
        'sib_rollno'=>$sibRollno
      );
      $this->db->insert($studentTable,$data);
      return True;
    }

    public function getTrClass($filter, $q) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $recieptTable = 'reciept_student'.$curSession;
      if($filter == 'None') {
        $query = $this->db->query($q);
        $data = array();
        if($query->num_rows() > 0) {
          foreach($query->result_array() as $row) $data[$row['student_id']] = '';
        }
        return $data;
      }
      elseif($filter == 'New-Admission') $column = 'new_admission_v';
      elseif($filter == 'Re-Admission') $column = 're_admission_v';
      elseif($filter == 'New-Hostel-Admission') $column = 'new_admission_v';
      elseif($filter == 'Re-Hostel-Admission') $column = 're_admission_v';
      elseif($filter == 'Tuition') $column = 'monthly_tuition_v';
      elseif($filter == 'Hostel') $column = 'hostel_monthly_v';
      elseif($filter == 'Computer') $column = 'computer_v';
      elseif($filter == 'Transport') $column = 'monthly_transport_v';
      elseif($filter == 'Examination') $column = 'examination_v';
      elseif($filter == 'Library') $column = 'library_v';
      elseif($filter == 'Game') $column = 'game_v';
      elseif($filter == 'Diary-Notebook') $column = 'diary_v';
      $day = date('j');
      if($day < 10) $day = '0'.$day;
      $month = date('n');
      if($month < 10) $month = '0'.$month;
      $year = date('Y');
      $curDate = $year.$month.$day;
      $curDate = (int)$curDate;

      $query = $this->db->query($q);
      $data = array();
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $studentId = $row['student_id'];
          $sql = "SELECT $column FROM $recieptTable WHERE student_id = $studentId ORDER BY $column DESC LIMIT 1;";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0) {
            foreach($query->result_array() as $row) $validity = $row[$column];
            if($validity == NULL) $data[$studentId] = 'info';
            elseif($validity < $curDate) $data[$studentId] = 'danger';
            else $data[$studentId] = '';
          }
          else $data[$studentId] = 'warning';
        }
      }
      return $data;
    }

    public function fetchAllStudents() {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      if(isset($_GET['filter'])) {
        $filter = $this->input->get('filter');
      }
      else $filter = 'None';
      $sql = "SELECT student_id, student_name, rollno, hostel_facility, transport_facility FROM $studentTable;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $d = $this->fetchClassAndSectionNames();
        $q = "SELECT student_id FROM $studentTable;";
        $data = array(
          'students'=>$query->result_array(),
          'classNames'=>$d['classNames'],
          'sectionNames'=>$d['sectionNames'],
          'class'=>$this->getTrClass($filter, $q)
        );
      }
      else {
        $data = array(
          'students'=>array(),
          'class'=>array()
        );
      }
      return $data;
    }

    public function fetchClassAndSectionNames() {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $classTable = 'class'.$curSession;
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT student_id, class_id, section_id FROM $studentTable;";
      $query = $this->db->query($sql);
      $classNames = array();
      $sectionNames = array();
      foreach($query->result_array() as $row) {
        $studentId = $row['student_id'];
        $classId = $row['class_id'];
        $sectionId = $row['section_id'];
        $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
        $q = $this->db->query($sql);
        foreach($q->result_array() as $row) {
          $classNames[$studentId] = $row['class_name'];
        }
        $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
        $q = $this->db->query($sql);
        foreach($q->result_array() as $row) {
          $sectionNames[$studentId] = $row['section_name'];
        }
      }
      $data = array(
        'classNames'=>$classNames,
        'sectionNames'=>$sectionNames
      );
      return $data;
    }

    public function fetchSections() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        return array('sectionInfo'=>$query->result_array());
      }
      else return array('sectionInfo'=>array());
    }

    public function fetchClassStudents() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      if(isset($_POST['filter'])) $filter = $this->input->post('filter');
      else $filter = 'None';
      $sql = "SELECT student_id, rollno, student_name, transport_facility, hostel_facility FROM $studentTable WHERE class_id = $classId ORDER BY rollno;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $q = $sql = "SELECT student_id FROM $studentTable WHERE class_id = $classId;";
        $data = array(
          'students'=>$query->result_array(),
          'class'=>$this->getTrClass($filter, $q)
        );
      }
      else {
        $data = array(
          'students'=>array(),
          'class'=>array()
        );
      }
      return $data;
    }

    public function fetchSectionStudents() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $sectionId = $this->sectionIdAuthentication($classId);
      if($sectionId == False) return False;
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      if(isset($_POST['filter'])) $filter = $this->input->post('filter');
      else $filter = 'None';
      $sql = "SELECT student_name, student_id, rollno, hostel_facility, transport_facility FROM $studentTable WHERE class_id = $classId AND section_id = $sectionId ORDER BY rollno;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $q = $sql = "SELECT student_id FROM $studentTable WHERE class_id = $classId AND section_id = $sectionId;";
        $data = array(
          'students'=>$query->result_array(),
          'class'=>$this->getTrClass($filter, $q)
        );
      }
      else {
        $data = array(
          'students'=>array(),
          'class'=>array()
        );
      }
      return $data;
    }

    public function sectionIdAuthentication($classId) {
      if(!isset($_GET['sectionid'])) return False;
      $sectionId = $this->input->get('sectionid');
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId AND section_id = $sectionId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $sectionId;
      else return False;
    }

    public function removeStudent() {
      if(!isset($_GET['studentid'])) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "DELETE FROM $studentTable WHERE student_id = $studentId;";
      $this->db->query($sql);
      return True;
    }

    public function fetchProfileData() {
      if(!isset($_GET['studentid'])) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $sectionData = $this->fetchSectionNames($studentId);
        $data = array(
          'profileData'=>$query->result_array(),
          'sectionName'=>$sectionData['sectionName'],
          'sections'=>$sectionData['sections']
        );
        return $data;
      }
      else return False;
    }

    public function fetchSectionNames($studentId) {
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $studentTable = 'student'.$curSession;
      $sql = "SELECT class_id, section_id FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $classId = $row['class_id'];
        $sectionId = $row['section_id'];
      }
      $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $sectionName = $row['section_name'];
      $sql = "SELECT section_name FROM $sectionTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      $sections = $query->result_array();
      $data = array(
        'sectionName'=>$sectionName,
        'sections'=>$sections
      );
      return $data;
    }

    public function editProfile() {
      if(!(isset($_GET['studentid']))) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT class_id FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      if($query->num_rows() == 0) return False;
      foreach($query->result_array() as $row) $classId = $row['class_id'];
      if(isset($_POST['hostel'])) $hostelFacility = 'Y';
      else $hostelFacility = 'N';
      if(isset($_POST['transport'])) $transportFacility = 'Y';
      else $transportFacility = 'N';
      $sectionName = $this->input->post('section');
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_id FROM $sectionTable WHERE section_name = '$sectionName' AND class_id = $classId;";
      echo $sql;
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sectionId = $row['section_id'];
      }
      $fatherAnualIncome = $this->input->post('anualIncomeFather');
      if($fatherAnualIncome == '') $fatherAnualIncome = NULL;
      $familyAnualIncome = $this->input->post('familyAnualIncome');
      if($familyAnualIncome == '') $familyAnualIncome = NULL;
      $pincode = $this->input->post('pincode');
      if($pincode == '') $pincode = NULL;
      $sibRollno = $this->input->post('sibRollNo');
      if($sibRollno == '') $sibRollno = NULL;
      $data = array(
        'student_name'=>$this->input->post('studentName'),
        'dob'=>$this->input->post('dob'),
        'nationality'=>$this->input->post('nationality'),
        'religion'=>$this->input->post('religion'),
        'caste'=>$this->input->post('caste'),
        'last_school'=>$this->input->post('lastSchool'),
        'hostel_facility'=>$hostelFacility,
        'transport_facility'=>$transportFacility,
        'boarding_point'=>$this->input->post('boardingPoint'),
        'section_id'=>$sectionId,
        'class_id'=>$classId,
        'rollno'=>$this->input->post('rollno'),
        'father_name'=>$this->input->post('fatherName'),
        'father_qualification'=>$this->input->post('qualificationFather'),
        'father_occupation'=>$this->input->post('occupationFather'),
        'father_anual_income'=>$fatherAnualIncome,
        'father_contact_no'=>$this->input->post('contactNoFather'),
        'father_whatsapp_no'=>$this->input->post('whatsappNoFather'),
        'mother_name'=>$this->input->post('motherName'),
        'mother_qualification'=>$this->input->post('qualificationMother'),
        'mother_occupation'=>$this->input->post('occupationMother'),
        'family_anual_income'=>$familyAnualIncome,
        'village_town'=>$this->input->post('villageTown'),
        'ward_mahalla'=>$this->input->post('wardMahalla'),
        'post_office'=>$this->input->post('postOffice'),
        'police_station'=>$this->input->post('policeStation'),
        'district'=>$this->input->post('district'),
        'pincode'=>$pincode,
        'address_line1'=>$this->input->post('presentAddressLine1'),
        'address_line2'=>$this->input->post('presentAddressLine2'),
        'sib_name'=>$this->input->post('sibName'),
        'sib_class'=>$this->input->post('sibClass'),
        'sib_section'=>$this->input->post('sibSection'),
        'sib_rollno'=>$sibRollno
      );
      $this->db->where('student_id',$studentId);
      $this->db->update($studentTable,$data);
      return True;
    }

    public function getImageUrl() {
      if(!(isset($_GET['studentid']))) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT studentimgurl, fatherimgurl, motherimgurl, student_name, father_name, mother_name FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      if($query->num_rows()) {
        foreach($query->result_array() as $row) {
          $studentImg = $row['studentimgurl'];
          $fatherImg = $row['fatherimgurl'];
          $motherImg = $row['motherimgurl'];
          $studentName = $row['student_name'];
          $fatherName = $row['father_name'];
          $motherName = $row['mother_name'];
        }
        if($studentImg == NULL) $studentImg = '/markazboys/assets/images/default/default_avatar.png';
        if($fatherImg == NULL) $fatherImg = '/markazboys/assets/images/default/default_avatar.png';
        if($motherImg == NULL) $motherImg = '/markazboys/assets/images/default/default_avatar.png';
        $data = array(
          'studentImg'=>$studentImg,
          'fatherImg'=>$fatherImg,
          'motherImg'=>$motherImg,
          'studentName'=>$studentName,
          'fatherName'=>$fatherName,
          'motherName'=>$motherName
        );
        return $data;
      }
      else return False;
    }

    public function feeInfo() {
      $studentId = $this->studentIdAuthentication();
      if($studentId == False) return False;
      $curSession = $this->curSession();
      $recieptTable = 'reciept_student'.$curSession;
      $sql = "SELECT * FROM $recieptTable WHERE student_id = $studentId ORDER BY reciept_id DESC;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $feeInfo = $query->result_array();
      }
      else $feeInfo = array();
      $data = array(
        'studentName'=>$this->studentNameById($studentId),
        'className'=>$this->studentClassById($studentId),
        'sectionName'=>$this->studentSectionById($studentId),
        'rollno'=>$this->studentRollnoById($studentId),
        'feeInfo'=>$feeInfo
      );
      return $data;
    }

    public function studentNameById($studentId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT student_name FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $studentName = $row['student_name'];
      return $studentName;
    }

    public function studentRollnoById($studentId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT rollno FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $rollno = $row['rollno'];
      return $rollno;
    }

    public function studentClassById($studentId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT class_id FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $classId = $row['class_id'];
      }
      $classTable = 'class'.$curSession;
      $sql = "SELECT class_name FROM $classTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $className = $row['class_name'];
      return $className;
    }

    public function studentSectionById($studentId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT section_id FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sectionId = $row['section_id'];
      }
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_name FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $sectionName = $row['section_name'];
      return $sectionName;
    }

    public function studentIdAuthentication() {
      if(!isset($_GET['studentid'])) return False;
      $studentId = $this->input->get('studentid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $studentId;
      else return False;
    }

    public function readmissionSessionId() {
      $sql = "SELECT * FROM readmission;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $readmissionSessionId = $row['session_id'];
      return $readmissionSessionId;
    }

    public function readmissionClass() {
      $readmissionSessionId = $this->readmissionSessionId();
      if($readmissionSessionId == 0) return -1;
      $classTable = 'class'.$readmissionSessionId;
      $sql = "SELECT * FROM $classTable;";
      $query = $this->db->query($sql);
      $data = array('classInfo'=>array());
      if($query->num_rows() > 0) $data = array('classInfo'=>$query->result_array());
      return $data;
    }

    public function readmissionSectionNames() {
      $classId = $this->readmissionClassIdAuthentication();
      if($classId == False) return False;
      $readmissionSessionId = $this->readmissionSessionId();
      $sectionTable = "section".$readmissionSessionId;
      $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      $data = array('sectionInfo'=>array());
      if($query->num_rows() > 0) $data['sectionInfo'] = $query->result_array();
      return $data;
    }

    public function readmissionClassIdAuthentication() {
      if(!isset($_GET['reclassid'])) return False;
      $classId = $this->input->get('reclassid');
      $readmissionSessionId = $this->readmissionSessionId();
      $classTable = 'class'.$readmissionSessionId;
      $sql = "SELECT * FROM $classTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $classId;
      else return False;
    }

    public function reAdmissionStudent() {
      $studentId = $this->studentIdAuthentication();
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sectionName = $this->input->post('sectionName');
      $rollno = $this->input->post('rollno');
      $sessionId = $this->readmissionSessionId();
      $studentTableRe = 'student'.$sessionId;
      $sectionTable = 'section'.$sessionId;
      $classId = $this->readmissionClassIdAuthentication();
      $sql = "SELECT section_id FROM $sectionTable WHERE class_id = $classId AND section_name = '$sectionName';";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $sectionId = $row['section_id'];
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $data = array(
          'student_id'=>NULL,
          'student_name'=>$row['student_name'],
          'dob'=>$row['dob'],
          'nationality'=>$row['nationality'],
          'religion'=>$row['religion'],
          'caste'=>$row['caste'],
          'last_school'=>$row['last_school'],
          'hostel_facility'=>$row['hostel_facility'],
          'transport_facility'=>$row['transport_facility'],
          'boarding_point'=>$row['boarding_point'],
          'section_id'=>$sectionId,
          'class_id'=>$classId,
          'rollno'=>$rollno,
          'father_name'=>$row['father_name'],
          'father_qualification'=>$row['father_qualification'],
          'father_occupation'=>$row['father_occupation'],
          'father_anual_income'=>$row['father_anual_income'],
          'father_contact_no'=>$row['father_contact_no'],
          'father_whatsapp_no'=>$row['father_whatsapp_no'],
          'mother_name'=>$row['mother_name'],
          'mother_qualification'=>$row['mother_qualification'],
          'mother_occupation'=>$row['mother_occupation'],
          'family_anual_income'=>$row['family_anual_income'],
          'village_town'=>$row['village_town'],
          'ward_mahalla'=>$row['ward_mahalla'],
          'post_office'=>$row['post_office'],
          'police_station'=>$row['police_station'],
          'district'=>$row['district'],
          'pincode'=>$row['pincode'],
          'address_line1'=>$row['address_line1'],
          'address_line2'=>$row['address_line2'],
          'sib_name'=>$row['sib_name'],
          'sib_class'=>$row['sib_class'],
          'sib_section'=>$row['sib_section'],
          'sib_rollno'=>$row['sib_rollno'],
          'studentImgUrl'=>$row['studentImgUrl'],
          'fatherImgUrl'=>$row['fatherImgUrl'],
          'motherImgUrl'=>$row['motherImgUrl']
        );
      }
      $this->db->insert($studentTableRe,$data);
      return True;
    }

    public function readmissionTableData() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $readmissionClassId = $this->readmissionClassIdAuthentication();
      if($readmissionClassId == False) return False;

      $data = array(
        'students'=>$this->fetchClassStudents(),
        'sections'=>$this->readmissionSectionNames()
      );
      return $data;
    }

    public function bulkReadmissionAction() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;

      $reClassId = $this->readmissionClassIdAuthentication();
      if($reClassId == False) return False;
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sql = "SELECT student_id FROM $studentTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {

        foreach($query->result_array() as $row) {
          $sectionName = $this->input->post('section'.$row['student_id']);
          $rollno = $this->input->post('rollno'.$row['student_id']);
          if($sectionName != '' && $rollno != '') {
            $this->reAdmitStudent($sectionName, $rollno, $row['student_id'], $reClassId);
          }
        }
        return True;
      }

      else {
        return False;
      }
    }

    public function reAdmitStudent($sectionName, $rollno, $studentId, $classId) {
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sessionId = $this->readmissionSessionId();
      $studentTableRe = 'student'.$sessionId;
      $sectionTable = 'section'.$sessionId;
      $sql = "SELECT section_id FROM $sectionTable WHERE class_id = $classId AND section_name = '$sectionName';";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) $sectionId = $row['section_id'];
      $sql = "SELECT * FROM $studentTable WHERE student_id = $studentId;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $data = array(
          'student_id'=>NULL,
          'student_name'=>$row['student_name'],
          'dob'=>$row['dob'],
          'nationality'=>$row['nationality'],
          'religion'=>$row['religion'],
          'caste'=>$row['caste'],
          'last_school'=>$row['last_school'],
          'hostel_facility'=>$row['hostel_facility'],
          'transport_facility'=>$row['transport_facility'],
          'boarding_point'=>$row['boarding_point'],
          'section_id'=>$sectionId,
          'class_id'=>$classId,
          'rollno'=>$rollno,
          'father_name'=>$row['father_name'],
          'father_qualification'=>$row['father_qualification'],
          'father_occupation'=>$row['father_occupation'],
          'father_anual_income'=>$row['father_anual_income'],
          'father_contact_no'=>$row['father_contact_no'],
          'father_whatsapp_no'=>$row['father_whatsapp_no'],
          'mother_name'=>$row['mother_name'],
          'mother_qualification'=>$row['mother_qualification'],
          'mother_occupation'=>$row['mother_occupation'],
          'family_anual_income'=>$row['family_anual_income'],
          'village_town'=>$row['village_town'],
          'ward_mahalla'=>$row['ward_mahalla'],
          'post_office'=>$row['post_office'],
          'police_station'=>$row['police_station'],
          'district'=>$row['district'],
          'pincode'=>$row['pincode'],
          'address_line1'=>$row['address_line1'],
          'address_line2'=>$row['address_line2'],
          'sib_name'=>$row['sib_name'],
          'sib_class'=>$row['sib_class'],
          'sib_section'=>$row['sib_section'],
          'sib_rollno'=>$row['sib_rollno'],
          'studentImgUrl'=>$row['studentImgUrl'],
          'fatherImgUrl'=>$row['fatherImgUrl'],
          'motherImgUrl'=>$row['motherImgUrl']
        );
      }
      $this->db->insert($studentTableRe,$data);
    }
  }
?>
