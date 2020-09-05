<?php
  class Model_Employee extends CI_Model {
    public function addEmployee() {
      $data = array(
        'employee_id'=>NULL,
        'employee_name'=>$this->input->post('employeeName'),
        'designation'=>$this->input->post('designation'),
        'qualification'=>$this->input->post('qualification'),
        'work_experience'=>$this->input->post('workExperience'),
        'doj'=>$this->input->post('doj'),
        'gross_before_leave'=>0,
        'leave_without_pay_day'=>0,
        'leave_without_pay_amount'=>0,
        'gross_after_leave'=>0,
        'pf_deduction'=>0,
        'p_tax'=>0,
        'house_rent'=>0,
        'transport_fees'=>0,
        'mess_deduction'=>0,
        'electricity'=>0,
        'salary_advance_deduction'=>0,
        'net_salary'=>0
      );
      $this->db->insert('employee',$data);
      return True;
    }

    public function fetchEmployeeData() {
      $sql = "SELECT employee_id, employee_name, designation, doj FROM employee;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $data = array(
          'employee'=>$query->result_array()
        );
      }
      else {
        $data = array(
          'employee'=>array()
        );
      }
      return $data;
    }

    public function fetchEmployeeAccountInfo() {
      $employeeId = $this->employeeIdAuthentication();
      if($employeeId == False) return False;
      $sql = "SELECT * FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      return array('employee'=>$query->result_array());
    }

    public function employeeIdAuthentication() {
      if(!isset($_GET['employeeid'])) return False;
      $employeeId = $this->input->get('employeeid');
      $sql = "SELECT * FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $employeeId;
      else return False;
    }

    public function salaryAccountEdit() {
      $employeeId = $this->employeeIdAuthentication();
      if($employeeId == False) return False;
      $data = array(
        'gross_before_leave'=>$this->input->post('grossBeforeLeave'),
        'leave_without_pay_day'=>$this->input->post('leaveDays'),
        'leave_without_pay_amount'=>$this->input->post('leaveDeduction'),
        'gross_after_leave'=>$this->input->post('grossAfterLeave'),
        'pf_deduction'=>$this->input->post('pfDeduction'),
        'p_tax'=>$this->input->post('pTax'),
        'house_rent'=>$this->input->post('houseRent'),
        'transport_fees'=>$this->input->post('transportFees'),
        'mess_deduction'=>$this->input->post('messDeduction'),
        'electricity'=>$this->input->post('electricity'),
        'salary_advance_deduction'=>$this->input->post('advanceSalary'),
        'net_salary'=>$this->input->post('netSalary')
      );
      $this->db->where('employee_id',$employeeId);
      $this->db->update('employee',$data);
      return $employeeId;
    }

    public function removeEmployee() {
      $employeeId = $this->employeeIdAuthentication();
      if($employeeId == False) return False;
      $sql = "DELETE FROM employee WHERE employee_id = $employeeId;";
      $this->db->query($sql);
      return True;
    }

    public function fetchEmployeeProfileData() {
      $employeeId = $this->employeeIdAuthentication();
      if($employeeId == False) return False;
      $sql = "SELECT * FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      $data = array('employee'=>$query->result_array());
      return $data;
    }

    public function editEmployeeProfile() {
      $employeeId = $this->employeeIdAuthentication();
      if($employeeId == False) return False;
      $data = array(
        'employee_name'=>$this->input->post('employeeName'),
        'designation'=>$this->input->post('designation'),
        'qualification'=>$this->input->post('qualification'),
        'work_experience'=>$this->input->post('workExperience'),
        'doj'=>$this->input->post('doj'),
      );
      $this->db->where('employee_id',$employeeId);
      $this->db->update('employee',$data);
      return $employeeId;
    }

    public function getEmployeeUrl() {
      if(!isset($_GET['employeeid'])) return False;
      $employeeId = $this->input->get('employeeid');
      $sql = "SELECT url FROM employee WHERE employee_id = $employeeId;";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        foreach($query->result_array() as $row) {
          $url = $row['url'];
          if($url == '' || $url == NULL) $url = '/markazboys/assets/images/default/default_avatar.png';
        }
        return array('url'=>$url);
      }
      else return False;
    }
  }
?>
