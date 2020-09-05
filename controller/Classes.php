<?php
  class Classes extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
      if($_SESSION['user'] != 'admin') redirect('login/accessMsg');
      $this->load->helper('form');

      $this->load->helper('html');
      $this->load->model('model_classes');
      $this->load->view('header',array('title'=>'Classes'));
      $data = $this->model_classes->firstCLassId();
      $this->load->view('classesBreadcrumb', $data);
    }

    public function index() {
      $data = $this->model_classes->fetchClassData();
      $this->load->view('manageClasses',$data);
    }

    public function addNewClassForm() {
      $this->load->view('addNewClass');
      $this->index();
    }

    public function addNewClass() {
      $validateData = array(
        array(
          'field'=>'newClassName',
          'label'=>'class name',
          'rules'=>'trim|required|alpha_numeric|callback_checkClass'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) {
        $this->addNewClassForm();
      }
      else {
        $this->model_classes->addNewClass();
        redirect(current_url().'?sfl');
      }
    }

    public function checkClass($className) {
      if($this->model_classes->checkClass($className)) {
        $this->form_validation->set_message('checkClass','The class name already exists.');
        return False;
      }
      else return True;
    }

    public function editClassForm() {
      $this->load->view('editClass');
      $this->index();
    }

    public function editClass() {
      $validateData = array(
        array(
          'field'=>'newClassName',
          'label'=>'class name',
          'rules'=>'trim|required|alpha_numeric|callback_checkClass'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) {
        $this->editClassForm();
      }
      else {
        if($this->model_classes->editClass()) redirect('classes?sfl');
        else redirect('classes?usfl');
      }
    }
    public function manageSections() {
      $classData = $this->model_classes->fetchClassData();
      $sectionData = $this->model_classes->fetchSectionData();
      $data = array(
        "class"=>$classData,
        'section'=>$sectionData,
      );
      $this->load->view('manageSections',$data);
    }

    public function addNewSectionForm() {
      $firstClassId = $this->model_classes->firstClassId();
      $this->load->view('addNewSection',$firstClassId);
      $this->manageSections();
    }

    public function addSection() {
      if(isset($_GET['classid'])) $classId = $this->input->get('classid');
      else $classId = -1;
      if($classId == -1) redirect('classes?usfl');
      else {
        $validateData = array(
          array(
            'field'=>'sectionName',
            'label'=>'section name',
            'rules'=>'trim|required|alpha|max_length[1]|callback_checkSection'
          )
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validateData);
        if($this->form_validation->run() == False) {
          $this->addNewSectionForm();
        }
        else {
          $this->model_classes->addSection();
          redirect('classes/addNewSectionForm?sfl&classid='.$classId);
        }
      }
    }

    public function checkSection($sectionName) {
      if($this->model_classes->checkSection($sectionName)) {
        $this->form_validation->set_message('checkSection','The section already exists.');
        return False;
      }
      else return True;
    }

    public function editSectionForm() {
      if($this->load->view('editSectionForm'));
      $this->manageSections();
    }

    public function editSection() {
      if(isset($_GET['classid'])) $classId = $this->input->get('classid');
      else $classId = -1;
      if(isset($_GET['sectionid'])) $sectionId = $this->input->get('sectionid');
      else $sectionId = -1;
      if($classId == -1 || $sectionId == -1) redirect('classes?usfl');
      else {
        $validateData = array(
          array(
            'field'=>'sectionName',
            'label'=>'section name',
            'rules'=>'trim|required|alpha|max_length[1]|callback_checkSection'
          )
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validateData);
        if($this->form_validation->run() == False) {
          $this->editSectionForm();
        }
        else {
          if($this->model_classes->editSection()) redirect('classes/manageSections?sfl&classid='.$classId);
        }
      }
    }

    public function removeClass() {
      if($this->model_classes->removeClass()) redirect('classes?sfl');
      else redirect('classes?usfl');
    }

    public function removeSection() {
      $classId = $this->model_classes->removeSection();
      if($classId == False) redirect('classes/manageSections?classid='.$classId.'&usfl');
      else redirect('classes/manageSections?classid='.$classId.'&sfl');
    }
   }
?>
