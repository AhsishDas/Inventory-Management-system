<?php
  class Model_Classes extends CI_Model {
    public function addNewClass() {
      $className = strtoupper($this->input->post('newClassName'));
      $sessionId = $this->curSession();
      $classTable = "class".$sessionId;
      $data = array(
        'class_id'=>NULL,
        'class_name'=>$className
      );
      $this->db->insert($classTable,$data);
      return True;
    }

    public function checkClass($className) {
      $sessionId = $this->curSession();
      $classTable = "class".$sessionId;
      $sql = "SELECT * FROM $classTable WHERE class_name = '$className';";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return True;
      else return False;
    }

    public function curSession() {
      $sql = "SELECT * FROM current_session;";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row) {
        $sessionId = $row['session_id'];
      }
      return $sessionId;
    }

    public function fetchClassData() {
      $sessionId = $this->curSession();
      $classTable = 'class'.$sessionId;
      $sql = "SELECT * FROM $classTable;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $data = array(
          'classes'=>$query->result_array(),
          'noOfSections'=>$this->noOfSections(),
          'noOfStudents'=>$this->noOfStudents()
        );
      }
      else $data = array('classes'=>array());
      return $data;
    }

    public function noOfSections() {
      $sessionId = $this->curSession();
      $sectionTable = 'section'.$sessionId;
      $classTable = 'class'.$sessionId;
      $sql = "SELECT class_id FROM $classTable;";
      $query = $this->db->query($sql);
      $noOfSections = array();
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $classId = $row['class_id'];
          $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId;";
          $q = $this->db->query($sql);
          $noOfSections[$classId] = $q->num_rows();
        }
      }
      return $noOfSections;
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

    public function editClass() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return Fasle;
      else {
        $className = strtoupper($this->input->post('newClassName'));
        $data = array(
          'class_name'=>$className
        );
        $curSession = $this->curSession();
        $classTable = 'class'.$curSession;
        $this->db->where('class_id',$classId);
        $this->db->update($classTable,$data);
        return True;
      }
    }

    public function classIdAuthentication() {
      if(!(isset($_GET['classid']))) return False;
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

    public function firstClassId() {
      $sessionId = $this->curSession();
      $classTable = 'class'.$sessionId;
      $sql = "SELECT class_id FROM $classTable LIMIT 1;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $classId = $row['class_id'];
        }
        $data = array(
          'firstClassId'=>$classId
        );
      }
      else $data = array(
        'firstClassId'=>-1
      );
      return $data;
    }

    public function fetchSectionData() {
      $classId = $this->classIdAuthentication();
      if($classId == False) $data = array('sectionData'=>array(),
                                           'noOfStudentsSection'=>array());
      else {
        $curSession = $this->curSession();
        $sectionTable = 'section'.$curSession;
        $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) $data = array(
          'sectionData'=>$query->result_array(),
          'noOfStudentsSection'=>$this->noOfStudentsSection()
        );
        else $data = array('sectionData'=>array(),
                           'noOfStudentsSection'=>array());
      }
      return $data;
    }

    public function checkSection($sectionName) {
      $classId = $this->input->get('classid');
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sectionName = strtoupper($sectionName);
      $sql = "SELECT * FROM $sectionTable WHERE class_id = $classId AND section_name = '$sectionName';";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return True;
      else return False;
    }

    public function addSection() {
      $classId = $this->input->get('classid');
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sectionName = $this->input->post('sectionName');
      $sectionName = strtoupper($sectionName);
      $data = array(
        'section_id'=>NULL,
        'section_name'=>$sectionName,
        'class_id'=>$classId
      );
      $this->db->insert($sectionTable, $data);
      return True;
    }

    public function noOfStudentsSection() {
      $classId = $this->input->get('classid');
      $curSession = $this->curSession();
      $studentTable = 'student'.$curSession;
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT section_id FROM $sectionTable WHERE class_id = $classId;";
      $query = $this->db->query($sql);
      $noOfStudentsSection = array();
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $sectionId = $row['section_id'];
          $sql = "SELECT * FROM $studentTable WHERE section_id = $sectionId;";
          $q = $this->db->query($sql);
          $noOfStudentsSection[$sectionId] = $q->num_rows();
        }
      }
      return $noOfStudentsSection;
    }

    public function editSection() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      else {
        $sectionId = $this->sectionIdAuthentication($classId);
        if($sectionId == False) return False;
        else {
          $sectionName = $this->input->post('sectionName');
          $sectionName = strtoupper($sectionName);
          $curSession = $this->curSession();
          $sectionTable = 'section'.$curSession;
          $sql = "UPDATE $sectionTable SET section_name = '$sectionName' WHERE section_id = $sectionId AND class_id = $classId;";
          $this->db->query($sql);
          return True;
        }
      }
    }

    public function sectionIdAuthentication($classId) {
      $sectionId = $this->input->get('sectionid');
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "SELECT * FROM $sectionTable WHERE section_id = $sectionId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $sectionId;
      else return False;
    }

    public function removeClass() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $curSession = $this->curSession();
      $classTable = 'class'.$curSession;
      $sql = "DELETE FROM $classTable WHERE class_id = $classId;";
      $this->db->query($sql);
      $sectionTable = 'section'.$curSession;
      $sql = "DELETE FROM $sectionTable WHERE class_id = $classId;";
      $this->db->query($sql);
      $studentTable = 'student'.$curSession;
      $sql = "DELETE FROM $studentTable WHERE class_id = $classId;";
      $this->db->query($sql);
      return True;
    }

    public function removeSection() {
      $classId = $this->classIdAuthentication();
      if($classId == False) return False;
      $sectionId = $this->sectionIdAuthentication();
      if($sectionId == False) return False;
      $curSession = $this->curSession();
      $sectionTable = 'section'.$curSession;
      $sql = "DELETE FROM $sectionTable WHERE section_id = $sectionId;";
      $this->db->query($sql);
      $studentTable = 'student'.$curSession;
      $sql = "DELETE FROM $studentTable WHERE section_id = $sectionId;";
      $this->db->query($sql);
      return $classId;
    }
  }
?>
