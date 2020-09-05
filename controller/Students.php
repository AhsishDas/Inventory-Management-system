<?php
  class Students extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      session_start();
      if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == False) redirect('login');
      $this->load->helper('html');

      $this->load->helper('form');
      $this->load->model('model_students');
      $this->load->view('header.php',array('title'=>'Students'));
      if(isset($_GET['classid'])) $this->load->view('studentsBreadcrumb');
      $data = $this->model_students->fetchClassData();
      $this->load->view('manageStudents',$data);
    }

    public function index() {
      $data = $this->model_students->fetchAllStudents();
      $this->load->view('allStudents', $data);
    }

    public function newAdmissionForm() {
      $classId = $this->model_students->classIdAuthentication();
      if($classId == False) redirect('students?usfl');
      $data = $this->model_students->sectionData($classId);
      $this->load->view('newAdmission',$data);
    }

    public function newAdmission() {
      if(isset($_GET['classid'])) $classId = $this->input->get('classid');
      else $classId = -1;
      if($classId == -1) redirect('students?usfl');
      else {
        $validateData = array(
          array(
            'field'=>'studentName',
            'label'=>'student name',
            'rules'=>'trim|required'
          ),
          array(
            'field'=>'nationality',
            'label'=>'nationality',
            'rules'=>'trim'
          ),
          array(
            'field'=>'religion',
            'label'=>'religion',
            'rules'=>'trim'
          ),
          array(
            'field'=>'caste',
            'label'=>'caste',
            'rules'=>'trim'
          ),
          array(
            'field'=>'section',
            'label'=>'section',
            'rules'=>'required'
          ),
          array(
            'field'=>'rollno',
            'label'=>'rollno',
            'rules'=>'trim|required|is_natural'
          ),
          array(
            'field'=>'fatherName',
            'label'=>'father name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'contactNoFather',
            'label'=>'father\'s contact number',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'whatsappNoFather',
            'label'=>'father\'s WhatsApp number',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'motherName',
            'label'=>'mother name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'contactNoMother',
            'label'=>'mother\'s contact numbwer',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'sibName',
            'label'=>'name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'sibClass',
            'label'=>'class',
            'rules'=>'trim|alpha_numeric'
          ),
          array(
            'field'=>'sibSection',
            'label'=>'section',
            'rules'=>'trim|alpha|exact_length[1]'
          ),
          array(
            'field'=>'dob',
            'label'=>"",
            'rules'=>""
          ),
          array(
            'field'=>'lastSchool',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'boardingPoint',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'qualificationFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'occupationFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'anualIncomeFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'qualificationMother',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'occupationMother',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'familyAnualIncome',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'villageTown',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'wardMahalla',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'postOffice',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'policeStation',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'district',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'pinCode',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'presentAddressLine1',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'presentAddressLine2',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'sibRollNo',
            'label'=>'rollno',
            'rules'=>'trim|is_natural'
          )
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validateData);
        if($this->form_validation->run() == False) {
          $this->newAdmissionForm();
        }
        else {
          if($this->model_students->addStudent()) redirect('students/newAdmissionForm?sfl&classid='.$classId);
          else redirect('students');
        }
      }
    }

    public function classStudents() {
      $sectionData = $this->model_students->fetchSections();
      if($sectionData == False) redirect('students?usfl');
      $classStudents = $this->model_students->fetchClassStudents();
      $data = array(
        'sectionInfo'=>$sectionData['sectionInfo'],
        'students'=>$classStudents['students'],
        'class'=>$classStudents['class']
      );
      $this->load->view('classStudents',$data);
    }

    public function sectionStudents() {
      $sectionData = $this->model_students->fetchSections();
      if($sectionData == False) redirect('students?usfl');
      $sectionStudents = $this->model_students->fetchSectionStudents();
      if($sectionStudents == False) redirect('students?usfl');
      $data = array(
        'sectionInfo'=>$sectionData['sectionInfo'],
        'students'=>$sectionStudents['students'],
        'class'=>$sectionStudents['class']
      );
      $this->load->view('sectionStudents',$data);
    }

    public function removeStudent() {
      if($_SESSION['user'] != 'admin') redirect('login/accessMsg');
      if(isset($_GET['classid']) && isset($_GET['sectionid'])) {
        $classId = $this->input->get('classid');
        $sectionId = $this->input->get('sectionid');
        $url = 'students/sectionStudents?classid='.$classId.'&sectionid='.$sectionId;
      }
      else if(isset($_GET['classid'])) {
        $classId = $this->input->get('classid');
        $url = 'students/classStudents?classid='.$classId;
      }
      else $url = 'students?a';
      if($this->model_students->removeStudent()) redirect($url.'&sfl');
      else redirect($url.'&usfl');
    }

    public function editProfile() {
      if(isset($_GET['classid']) && isset($_GET['sectionid'])) {
        $classId = $this->input->get('classid');
        $sectionId = $this->input->get('sectionid');
        $url = '/markazboys/index.php/students/sectionStudents?classid='.$classId.'&sectionid='.$sectionId;
      }
      else if(isset($_GET['classid'])) {
        $classId = $this->input->get('classid');
        $url = '/markazboys/index.php/students/classStudents?classid='.$classId;
      }
      else $url = '/markazboys/index.php/students?a';
      $profileData = $this->model_students->fetchProfileData();
      if($profileData == False) redirect($url);
      $this->load->view('editProfile',$profileData);
    }

    public function editProfileAction() {
      if(isset($_GET['studentid'])) $classId = $this->input->get('studentid');
      else $classId = -1;
      if($classId == -1) redirect('students?usfl');
      else {
        $validateData = array(
          array(
            'field'=>'studentName',
            'label'=>'student name',
            'rules'=>'trim|required'
          ),
          array(
            'field'=>'nationality',
            'label'=>'nationality',
            'rules'=>'trim'
          ),
          array(
            'field'=>'religion',
            'label'=>'religion',
            'rules'=>'trim'
          ),
          array(
            'field'=>'caste',
            'label'=>'caste',
            'rules'=>'trim'
          ),
          array(
            'field'=>'rollno',
            'label'=>'rollno',
            'rules'=>'trim|required|is_natural'
          ),
          array(
            'field'=>'fatherName',
            'label'=>'father name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'contactNoFather',
            'label'=>'father\'s contact number',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'whatsappNoFather',
            'label'=>'father\'s WhatsApp number',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'motherName',
            'label'=>'mother name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'contactNoMother',
            'label'=>'mother\'s contact numbwer',
            'rules'=>'trim|exact_length[10]|is_natural'
          ),
          array(
            'field'=>'sibName',
            'label'=>'name',
            'rules'=>'trim'
          ),
          array(
            'field'=>'sibClass',
            'label'=>'class',
            'rules'=>'trim|alpha_numeric'
          ),
          array(
            'field'=>'sibSection',
            'label'=>'section',
            'rules'=>'trim|alpha|exact_length[1]'
          ),
          array(
            'field'=>'dob',
            'label'=>"",
            'rules'=>""
          ),
          array(
            'field'=>'lastSchool',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'boardingPoint',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'qualificationFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'occupationFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'anualIncomeFather',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'qualificationMother',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'occupationMother',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'familyAnualIncome',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'villageTown',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'wardMahalla',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'postOffice',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'policeStation',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'district',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'pinCode',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'presentAddressLine1',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'presentAddressLine2',
            'label'=>'',
            'rules'=>''
          ),
          array(
            'field'=>'sibRollNo',
            'label'=>'rollno',
            'rules'=>'trim|is_natural'
          )
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validateData);
        if($this->form_validation->run() == False) {
          $this->editProfile();
        }
        else {
          if($this->model_students->editProfile()) redirect('students/editProfile?sfl&studentid='.$classId);
          else redirect('students?usfl');
        }
      }
    }

    public function uploadPhoto() {
      $imgUrl = $this->model_students->getImageUrl();
      $this->load->view('imageUpload',$imgUrl);
      if(isset($_POST['upload'])) {
        $photoId = $this->input->post('photoId');
        echo $photoId;
        $studentId = $this->input->get('studentid');
        $studentTable = 'student'.$this->model_students->curSession();

        if($photoId == 'Student') {
          $target_dir = "./assets/images/students/";
          $target_file = $target_dir . basename($_FILES["photo"]["name"]);
          $curFileName = basename($_FILES["photo"]["name"]);
          $data = array('studentImgUrl'=>'/markazboys/assets/images/students/'.$curFileName);
        }
        elseif($photoId == 'Father') {
          $target_dir = "./assets/images/Father/";
          $target_file = $target_dir . basename($_FILES["photo"]["name"]);
          $curFileName = basename($_FILES["photo"]["name"]);
          $data = array('fatherImgUrl'=>'/markazboys/assets/images/father/'.$curFileName);
        }
        elseif($photoId == 'Mother') {
          $target_dir = "./assets/images/Mother/";
          $target_file = $target_dir . basename($_FILES["photo"]["name"]);
          $curFileName = basename($_FILES["photo"]["name"]);
          $data = array('motherImgUrl'=>'/markazboys/assets/images/mother/'.$curFileName);

        }


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
                $this->db->where('student_id',$studentId);
                $this->db->update($studentTable,$data);
                redirect('students/uploadPhoto?studentid='.$studentId);
            } else {
                //echo "Sorry, there was an error uploading your file.";
            }
        }
      }
    }
    /*
    function do_upload()
  	{
      $studentId = $this->model_students->studentIdAuthentication();
      $curSession = $this->model_students->curSession();
      $studentTable = 'student'.$curSession;
      $name = $curSession.'-'.$studentId.'.jpg';
      $photoId = $this->input->post('photoId');
      echo $name.' '.$photoId;
      if($photoId == 'Student') {
        $name = 's'.$name;
        $url = array('studentImgUrl'=>'/markazboys/assets/students/'.$name);
      }
      elseif($photoId == 'Father') {
        $name = 's'.$name;
        $url = array('fatherImgUrl'=>'/markazboys/assets/students/'.$name);
      }
      elseif($photoId == 'Mother') {
        $name = 'm'.$name;
        $url = array('motherImgUrl'=>'/markazboys/assets/students/'.$name);
      }
  		$config['upload_path'] = './assets/images/students';
  		$config['allowed_types'] = 'gif|jpg|png';
  		$config['max_size']	= '0';
  		$config['max_width']  = '0';
  		$config['max_height']  = '0';
      $config['file_name'] = $name;
      $config['overwrite'] = True;

  		$this->load->library('upload', $config);

  		if ( ! $this->upload->do_upload())
  		{
  			$error = array('error' => $this->upload->display_errors());
        echo $error['error'];
  			//$this->load->view('upload_form', $error);
  		}
  		else
  		{
  			$data = array('upload_data' => $this->upload->data());
        $this->db->where('student_id',$studentId);
        $this->db->update($studentTable,$url);
        //redirect('students/uploadPhoto?studentid='.$studentId);
  		}
  	}
    */
    public function feeInfo() {
      $data = $this->model_students->feeInfo();
      $this->load->view('feeInfo',$data);
    }

    public function reAdmissionClass() {
      $data = $this->model_students->readmissionClass();
      if($data == -1) $this->load->view('readmissionError');
      else {
        $this->load->view('readmissionClass',$data);
      }
    }

    public function reAdmissionForm() {
      $data = $this->model_students->readmissionSectionNames();
      if($data == False) redirect('students?usfl');
      $this->load->view('readmission',$data);
    }

    public function reAdmission() {
      $validateData = array(
        array(
          'field'=>'sectionName',
          'label'=>'section name',
          'rules'=>'trim|required'
        ),
        array(
          'field'=>'rollno',
          'label'=>'roll no',
          'rules'=>'trim|required'
        )
      );
      $this->load->library('form_validation');
      $this->form_validation->set_rules($validateData);
      if($this->form_validation->run() == False) $this->reAdmissionForm();
      else {
        if($this->model_students->reAdmissionStudent()) redirect('students?sfl');
        else redirect('students?usfl');
      }
    }

    public function bulkReadmission() {
      $data = $this->model_students->readmissionClass();
      if($data == -1) $this->load->view('readmissionError');
      else {
        $this->load->view('bulkReadmissionClass',$data);
      }
    }

    public function bulkReadmissionForm() {
      $data = $this->model_students->readmissionTableData();
      if($data == False) redirect('students?usfl');
      $this->load->view('bulkReadmissionTable', $data);
    }

    public function bulkReadmissionAction() {
      if($this->model_students->bulkReadmissionAction()) redirect('students?sfl');
      else redirect('students?usfl');
    }
  }
?>
