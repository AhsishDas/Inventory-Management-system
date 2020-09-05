<?php
  class Model_Login extends CI_Model {
    public function loginAction() {
      $user = $this->input->post('user');
      $passwd = $this->input->post('passwd');
      $sql = "SELECT * FROM users WHERE user = '$user' AND passwd = '$passwd';";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) return $user;
      else return False;
    }

    public function settingsAction() {
      $user = $this->input->post('user');
      $passwd = $this->input->post('passwd');
      $newPasswd = $this->input->post('newPasswd');
      $sql = "SELECT * FROM users WHERE user = '$user' AND passwd = '$passwd';";
      $query = $this->db->query($sql);
      if($query->num_rows() > 0) {
        $data = array('passwd'=>$newPasswd);
        $this->db->where('user',$user);
        $this->db->update('users',$data);
        return True;
      }
      else return False;
    }
  }
?>
