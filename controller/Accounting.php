<?php
  class Accounting extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
      if($_SESSION['user'] != 'admin') redirect('login/accessMsg');
      $this->load->helper('html');
      $this->load->helper('form');
      $this->load->model('model_accounting');
      $this->load->view('header', array('title'=>'Accounting'));
    }

    public function index() {
      $this->newOtherIncomeForm();
    }

    public function recieptForm() {
      $studentData = $this->model_accounting->getStudentData();
      if($studentData == False) redirect('accounting');
      $this->load->view('reciept', $studentData);
    }

    public function recieptAction() {
      $recieptId = $this->model_accounting->recieptAction();
      if($recieptId == False) redirect('students');
      else redirect('printdoc/printReciept?recieptid='.$recieptId);
    }

    public function newOtherIncomeForm() {
      $this->load->view('accSideOptions', array('curOption'=>0));
      $this->load->view('newOtherIncome');
    }

    public function newOtherIncomeAction() {
      $validateData = array(
        array(
          'field'=>'details',
          'label'=>'income details',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'amount',
          'label'=>'income amount',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) {
        $this->newOtherIncomeForm();
      }
      else {
        if($this->model_accounting->newOtherIncome()) redirect('accounting/newOtherIncomeForm?sfl');
      }
    }

    public function newExpenseForm() {
      $this->load->view('accSideOptions',array('curOption'=>1));
      $this->load->view('newExpense');
    }

    public function newExpenseAction() {
      $validateData = array(
        array(
          'field'=>'details',
          'label'=>'expense details',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'amount',
          'label'=>'expense amount',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) {
        $this->newExpenseForm();
      }
      else {
        if($this->model_accounting->newExpense()) redirect('accounting/newExpenseForm?sfl');
      }
    }

    public function studentIncomeList() {
      $this->load->view('accSideOptions',array('curOption'=>2));
      $recieptInfo = $this->model_accounting->studentIncomeList();
      $this->load->view('studentIncome',$recieptInfo);
    }

    public function otherIncomeList() {
      $this->load->view('accSideOptions', array('curOption'=>3));
      $recieptInfo = $this->model_accounting->otherIncomeList();
      $this->load->view('otherIncome', $recieptInfo);
    }

    public function expenseList() {
      $this->load->view('accSideOptions', array('curOption'=>4));
      $recieptInfo = $this->model_accounting->expenseList();
      $this->load->view('expenseList', $recieptInfo);
    }

    public function editReciept() {
      $data = $this->model_accounting->fetchStudentRecieptData();
      if($data == False) redirect('index.php/accounting/studentIncomeLis?usfl');
      $this->load->view('editStudentReciept',$data);
    }

    public function editRecieptAction() {
      $recieptId = $this->model_accounting->editReciept();
      if($recieptId == False) redirect('accounting/studentIncomeList?usfl');
      else redirect('accounting/editReciept?sfl&recieptid='.$recieptId);
    }

    public function otherIncomeEditForm() {
      $this->load->view('accSideOptions', array('curOption'=>3));
      $data = $this->model_accounting->incomeDetailsById();
      if($data == False) redirect('accounting/otherIncomeList?usfl');
      $this->load->view('otherIncomeEdit',$data);
      $recieptInfo = $this->model_accounting->otherIncomeList();
      $this->load->view('otherIncome', $recieptInfo);
    }

    public function editOtherIncome() {
      $validateData = array(
        array(
          'field'=>'details',
          'label'=>'income details',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'amount',
          'label'=>'income amount',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) $this->otherIncomeEditForm();
      else {
        $recieptId = $this->model_accounting->editIncome();
        if($recieptId == False) redirect('accounting/otherIncmeList?usfl');
        else redirect('accounting/otherIncomeEditForm?sfl&recieptid='.$recieptId);
      }
    }

    public function expenseEditForm() {
      $this->load->view('accSideOptions', array('curOption'=>4));
      $data = $this->model_accounting->expenseDetialsById();
      if($data == False) redirect('accounting/expenseList?usfl');
      $this->load->view('expenseEdit',$data);
      $recieptInfo = $this->model_accounting->expenseList();
      $this->load->view('expenseList', $recieptInfo);
    }

    public function editExpense() {
      $validateData = array(
        array(
          'field'=>'details',
          'label'=>'expense details',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'amount',
          'label'=>'expense amount',
          'rules'=>'trimm|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) $this->expenseEditForm();
      else {
        $recieptId = $this->model_accounting->editExpense();
        if($recieptId) redirect('accounting/expenseEditForm?sfl&recieptid='.$recieptId);
        else redirect('accounting/expenseList?uslf');
      }
    }

    public function daySheetList() {
      $this->load->view('accSideOptions', array('curOption'=>5));
      $data = $this->model_accounting->fetchDaysheetData();
      $this->load->view('daySheetList',$data);
    }

    public function newDaysheetForm() {
      if($this->model_accounting->checkDaysheet()) redirect('accounting/daySheetList?dusfl');
      $this->load->view('accSideOptions', array('curOption'=>5));
      $data = $this->model_accounting->newDaysheetInfo();
      $this->load->view('newDaySheet',$data);
      $data = $this->model_accounting->fetchDaySheetData();
      $this->load->view('daySheetList',$data);
    }

    public function newDaySheetAction() {
      $validateData = array(
        array(
          'field'=>'openingBalance',
          'label'=>'opening balance',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'closingBalance',
          'label'=>'closing balance',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) $this->newDaySheetForm();
      else {
        $daysheetId = $this->model_accounting->createDaysheet();
        redirect('printdoc/printDaysheet?daysheetid='.$daysheetId);
      }
    }

    public function daysheetEditForm() {
      $this->load->view('accSideOptions',array('curOption'=>5));
      $daysheetInfo = $this->model_accounting->daysheetById();
      if($daysheetInfo == False) redirect('accounting/daySheetList?usfl');
      $this->load->view('daysheetEdit',$daysheetInfo);
      $data = $this->model_accounting->fetchDaySheetData();
      $this->load->view('daySheetList',$data);
    }

    public function daysheetEdit() {
      $validateData = array(
        array(
          'field'=>'openingBalance',
          'label'=>'opening balance',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'closingBalance',
          'label'=>'closing balance',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) $this->daysheetEditForm();
      else {
        $daysheetId = $this->model_accounting->editDaysheet();
        if($daysheetId == False) redirect('accounting/daySheetList?usfl');
        else redirect('accounting/daysheetEditForm?sfl&daysheetid='.$daysheetId);
      }
    }
/*
    public function uploadPhoto() {
      $data = $this->model_accounting->getEmployeeUrl();
      if($data == False) redirect('accounting?usfl');
      else $this->load->view('uploadPhoto',$data);
    }*/
  }
?>
