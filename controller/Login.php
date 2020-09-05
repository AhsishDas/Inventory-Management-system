<?php
  class Login extends CI_Controller {
    public function __construct() {
      session_start();
      parent::__construct();

      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->helper('html');
      $this->load->model('model_login');
    }

    public function index() {
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == True) redirect('login/home');
      $this->load->view('headerPrint', array('title'=>'Login'));
      $this->load->view('login');
    }

    public function loginAction() {
      $user = $this->model_login->loginAction();
      if($user) {
        $_SESSION['loggedin'] = True;
        $_SESSION['user'] = $user;
        redirect('login/home');
      }
      else redirect('login?usfl');
    }

    public function logout() {
      $_SESSION['loggedin'] = False;
      session_unset();
      session_destroy();
      redirect('login');
    }

    public function settings() {
      $this->load->view('header', array('title'=>'Login'));
      $this->load->view('settings');
    }
    public function settingsAction() {
      if($this->model_login->settingsAction()) redirect('login/settings?sfl');
      else redirect('login/settings?usfl');
    }

    public function home() {
      $this->load->view('home');
    }

    public function accessMsg() {
      $this->load->view('accessMsg');
    }
  }
?>
