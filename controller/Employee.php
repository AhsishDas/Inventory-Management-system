<?php
  class Employee extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
      if($_SESSION['user'] != 'admin') redirect('login/accessMsg');
      $this->load->helper('html');
      $this->load->helper('form');
      $this->load->model('model_employee');
      $this->load->view('header.php',array('title'=>'Employee'));
      $this->load->view('employeeBreadcrumb');
    }

    public function index() {
      $data = $this->model_employee->fetchEmployeeData();
      $this->load->view('employeeList', $data);
    }

    public function newEmployeeForm() {
      $this->load->view('newEmployeeForm');
    }

    public function newEmployee() {
      $validateData = array(
        array(
          'field'=>'employeeName',
          'label'=>'employee name',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'designation',
          'label'=>'designation',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'qualification',
          'label'=>'qualification',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'workExperience',
          'label'=>'work experience',
          'rules'=>''
        ),
        array(
          'field'=>'doj',
          'label'=>'date of joining',
          'rules'=>'required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) {
        $this->newEmployeeForm();
      }
      else {
        $this->model_employee->addEmployee();
        redirect('employee/newEmployeeForm?sfl');
      }
    }

    public function salaryAccount() {
      $employeeInfo = $this->model_employee->fetchEmployeeAccountInfo();
      if($employeeInfo == False) redirect('employee?usfl');
      $this->load->view('salaryAccount', $employeeInfo);
    }

    public function salaryAccountEditForm() {
      $employeeInfo = $this->model_employee->fetchEmployeeAccountInfo();
      if($employeeInfo == False) redirect('employee?usfl');
      $this->load->view('salaryAccountEdit', $employeeInfo);
    }
    public function salaryAccountEdit() {
      $employeeId = $this->model_employee->salaryAccountEdit();
      if($employeeId == False) redirect('employee?usfl');
      else redirect('employee/salaryAccount?employeeid='.$employeeId);
    }

    public function removeEmployee() {
      if($this->model_employee->removeEmployee()) redirect('employee?sfl');
      else redirect('employee?usfl');
    }

    public function editProfile() {
      $data = $this->model_employee->fetchEmployeeProfileData();
      $this->load->view('editEmployeeProfile',$data);
    }

    public function editProfileAction() {
      $employeeId = $this->model_employee->editEmployeeProfile();
      if($employeeId == False) redirect('employee?usfl');
      else redirect('employee/editProfile?sfl&employeeid='.$employeeId);
    }

    public function uploadPhoto() {
      $data = $this->model_employee->getEmployeeUrl();
      if($data == False) redirect('accounting?usfl');
      else $this->load->view('uploadEmployeePhoto',$data);

      if(isset($_POST['upload'])) {
        $employeeId = $this->input->get('employeeid');
        $target_dir = "./assets/images/teacher/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $curFileName = basename($_FILES["photo"]["name"]);
        $data = array('url'=>'/markazboys/assets/images/teacher/'.$curFileName);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }


        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                //$curFileName = $target_dir.basename($_FILES["photo"]['name']);
                //$newFileName = '1'.".jpg";
                //rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");
                //rename($target_file,$newFileName);
                $this->db->where('employee_id',$employeeId);
                $this->db->update('employee',$data);
                redirect('employee?sfl');
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }
      }
    }
  }
?>
