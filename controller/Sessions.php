<?php
	class Sessions extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->helper(array('url','form','html'));
			session_start();
			if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
			if($_SESSION['user'] != 'admin') redirect('login/accessMsg');
			$this->load->model('model_sessions');
			$this->load->view('header',array('title'=>'Sessions'));
			$this->load->view('sessionBreadcrumb');
		}

		public function index() {
			$session = $this->model_sessions->fetchSessionData();

			if($session == False) $sessionData = array('sessions'=>array());
			else $sessionData = $session;

			$this->load->view('sessions',$sessionData);
		}

		public function addNewSessionForm() {
			$this->load->view('addNewSession');
			$this->index();
		}

		public function addNewSession() {
			$validateData = array(
				array(
					'field'=>'startDate',
					'label'=>'starting date',
					'rules'=>'trim|required|callback_startDateCheck'
				),
				array(
					'field'=>'endDate',
					'label'=>'ending date',
					'rules'=>'trim|required|callback_endDateCheck'
				)
			);

			$this->load->library('form_validation');
			$this->form_validation->set_rules($validateData);
			if($this->form_validation->run() == False) {
				$this->addNewSessionForm();
			}
			else {
				$this->model_sessions->addSession();
				redirect('sessions');
			}
		}

		public function startDateCheck($startDate) {
			$check = $this->model_sessions->getStartDate($startDate);
			if($check) {
				$this->form_validation->set_message('startDateCheck','The starting date already exists.');
				return False;
			}
			else return True;
		}

		public function endDateCheck($endDate) {
			$check = $this->model_sessions->getEndDate($endDate);
			if($check) {
				$this->form_validation->set_message('endDateCheck','The ending date already exists.');
				return False;
			}
			else return True;
		}

		public function setAsCurrent() {
			$status = $this->model_sessions->setCurrentSession();
			if($status) redirect('sessions?sacs=sfl');
			else redirect('sessions?sacs=usfl');
		}

		public function editSessionForm() {
			$this->load->view('editSession');
			$this->index();
		}

		public function editSession() {
			$validationData = array(
				array(
					'field'=>'startDate',
					'label'=>'starting date',
					'rules'=>'trim|required|callback_startDateCheck'
				),
				array(
					'field'=>'endDate',
					'label'=>'ending date',
					'rules'=>'trim|required|callback_endDateCheck'
				)
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($validationData);
			if($this->form_validation->run() == False) {
				$this->editSessionForm();
			}
			else {
				if($this->model_sessions->editSession()) redirect('sessions?eds=sfl');
				else redirect('sessions?eds=usfl');
			}
		}

		public function removeSession() {
			if($this->model_sessions->removeSession()) redirect('sessions?rmvs=sfl');
			else redirect('sessions?rmvs=usfl');
		}

		public function setReadmission() {
			if($this->model_sessions->setReadmission()) redirect('sessions?sfl');
			else redirect('sessions?usfl');
		}
	}

?>
