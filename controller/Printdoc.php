<?php
  class Printdoc extends CI_Controller {
    public function __construct() {
      parent::__construct();
      session_start();
      $this->load->helper(array('url','form','html'));
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
      $this->load->model('model_printdoc');

    }

    public function printReciept() {
      $this->load->view('headerPrint',array('title'=>'Student Receipt'));
      $data = $this->model_printdoc->fetchRecieptData();
      if($data == false) {
        echo '<h1>Reciept data is not found</h1>';
        echo '<a href="'.'/markazboys/index.php/students'.'">Back to Students</a>';
      }
      else $this->load->view('recieptForPrint',$data);
    }

    public function salaryReport() {
      $this->load->view('headerPrint',array('title'=>'Salary Report'));
      $data = $this->model_printdoc->salaryInfo();
      $this->load->view('salaryReport',$data);
    }

    public function printDaysheet() {
      $this->load->view('headerPrint',array('title'=>'Day Sheet'));
      $data = $this->model_printdoc->daysheetData();
      $this->load->view('daysheet',$data);
    }

    public function studentProfile() {
      $this->load->view('headerPrint',array('title'=>'Student Profile'));
      $data = $this->model_printdoc->getStudentInfo();
      $this->load->view('studentProfile',$data);
    }

    public function employeeProfile() {
      $this->load->view('headerPrint',array('title'=>'Employee Profile'));
      $data = $this->model_printdoc->getEmployeeInfo();
      $this->load->view('employeeProfile',$data);
    }
  }
?>
