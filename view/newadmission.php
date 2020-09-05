<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
?>
<div class="col-sm-9">

  <?php
    if(isset($_GET['sfl'])) {
      echo '<div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Done successfully <strong><span class="glyphicon glyphicon-ok"></span></strong>
            </div>';
    }

    elseif(isset($_GET['usfl'])) {
      echo '<div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Something went wrong <strong><span class="glyphicon glyphicon-remove"></span></strong>
            </div>';
    }
   ?>
   
  <div class="panel panel-info">
    <div class="panel-heading">New Admission Form</div>
    <div class="panel-body">
      <form action="<?php echo '/markazboys/index.php/students/newAdmission?classid='.$classId; ?>" method="POST">
        <div class="row">
          <div class="col-sm-6">
            <textfield>
              <legend>Personal Information</legend>
              <div class="form-group">
                <label for="studentName">Student's Name</label>
                <input type="text" name="studentName" id="studentName" class="form-control" value="<?php echo set_value('studentName'); ?>">
                <?php echo form_error('studentName','<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="date" name="dob" id="dob" class="form-control" value="<?php echo set_value('dob'); ?>">
                  <?php echo form_error('dob','<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo set_value('nationality'); ?>">
                <?php echo form_error('nationality', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" name="religion" id="religion" class="form-control" value="<?php echo set_value('religion'); ?>">
                <?php echo form_error('religion', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="caste">Caste</label>
                <input type="text" name="caste" id="caste" class="form-control" value="<?php echo set_value('caste'); ?>">
                <?php echo form_error('caste', '<p style="color: red;">', '</p>'); ?>
              </div>
            </textfield>
          </div>
          <div class="col-sm-6">
            <textfield>
              <legend>Previous School Information</legend>
              <div class="form-group">
                <label for="lastSchool">Name &amp; Address of Last School Attended</label>
                <input type="text" name="lastSchool" id="lastSchool" class="form-control" value="<?php echo set_value('lastSchool'); ?>">
              </div>
              </textfield>
              <textfield>
                <legend>Facilities Required</legend>
                <div class="checkbox">
                  <label><input type="checkbox" name="hostel"><strong>Hostel Facility</strong></label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" name="transport"><strong>Transport Facility</strong></label>
                </div>
                <div class="form-group">
                  <label for="boardingPoing">Boarding Point</label>
                  <input type="text" name="boardingPoint" id="boardingPoint" class="form-control" value="<?php echo set_value('boardingPoint'); ?>">
                </div>
              </textfield>
              <textfield>
                <legend>Class Information</legend>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="section">Section</label>
                      <select name="section" id="section" class="form-control" value="<?php echo set_value('section'); ?>">
                        <?php
                          foreach($sections as $row) {
                            echo '<option>'.$row['section_name'].'</option>';
                          }
                        ?>
                      </select>
                      <?php echo form_error('section','<p style="color: red;">','</p>'); ?>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="rollno">Roll No</label>
                      <input type="number" name="rollno" id="rollno" class="form-control" value="<?php echo set_value('rollno'); ?>">
                      <?php echo form_error('rollno','<p style="color: red;">', '</p>'); ?>
                    </div>
                  </div>
                </div>
              </textfield>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            <textfield>
              <legend>Father's Information</legend>
              <div class="form-group">
                <label for="fatherName">Father's Name</label>
                <input type="text" name="fatherName" id="fatherName" class="form-control" value="<?php echo set_value('fatherName'); ?>">
                <?php echo form_error('fatherName', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="qualificationFather">Qualification</label>
                <input type="text" name="qualificationFather" id="qualificationFather" class="form-control" value="<?php echo set_value('qualificationFather'); ?>">
              </div>
              <div class="form-group">
                <label for="occupationFather">Occupation</label>
                <input type="text" name="occupationFather" id="occuaptionFather" class="form-control" value="<?php echo set_value('occupationFather'); ?>">
              </div>
              <div class="form-group">
                <label for="anualIncomeFather">Anual Income</label>
                <input type="number" name="anualIncomeFather" id="anualIncomeFather" class="form-control" value="<?php echo set_value('anualIncomeFather'); ?>">
              </div>
              <div class="form-group">
                <label for="contactNoFather">Contact No</label>
                <input type="number" name="contactNoFather" id="contactNoFather" class="form-control" value="<?php echo set_value('contactNoFather'); ?>">
                <?php echo form_error('contactNoFather', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="whatsappNoFather">WhatsApp No</label>
                <input type="number" name="whatsappNoFather" id="whatsappNoFather" class="form-control" value="<?php echo set_value('whatsappNoFather'); ?>">
                <?php echo form_error('whatsappNoFather', '<p style="color: red;">', '</p>'); ?>
              </div>
            </textfield>
          </div>
          <div class="col-sm-6">
            <textfield>
              <legend>Mother's &amp; Family Information</legend>
              <div class="form-group">
                <label for="motherName">Mother's Name</label>
                <input type="text" name="motherName" id="motherName" class="form-control" value="<?php echo set_value('motherName'); ?>">
                <?php echo form_error('motherName', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="qualificationMother">Qualification</label>
                <input type="text" name="qualificationMother" id="qualificationMother" class="form-control" value="<?php echo set_value('qualificationMother'); ?>">
              </div>
              <div class="form-group">
                <label for="occupationMother">Occuaption</label>
                <input type="text" name="occupationMother" id="occupationMother" class="form-control" value="<?php echo set_value('occupationMother'); ?>">
              </div>
              <div class="form-group">
                <label for="contactNoMother">Contact No</label>
                <input type="number" name="contactNoMother" id="contactNoMother" class="form-control" value="<?php echo set_value('contactNoMother'); ?>">
                <?php echo form_error('contactNoMother', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="familyAnualIncome">Family's Anual Income</label>
                <input type="number" name="familyAnualIncome" id="familyAnualIncome" class="form-control" value="<?php echo set_value('familyAnualIncome'); ?>">
              </div>
            </textfield>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            <textfield>
            <legend>Permanent Address</legend>
            <div class="form-group">
              <label for="villageTown">Village/Town</label>
              <input type="text" name="villageTown" id="villageTown" class="form-control" value="<?php echo set_value('villageTown'); ?>">
            </div>
            <div class="form-group">
              <label for="wardMahalla">Ward/Mahalla</label>
              <input type="text" name="wardMahalla" id="wardMahalla" class="form-control" value="<?php echo set_value('wardMahalla'); ?>">
            </div>
            <div class="form-group">
              <label for="postOffice">Post Office</label>
              <input type="text" name="postOffice" id="postOffice" class="form-control" value="<?php echo set_value('postOffice'); ?>">
            </div>
            <div class="form-group">
              <label for="policeStation">Police Station</label>
              <input type="text" name="policeStation" id="policeStation" class="form-control" value="<?php echo set_value('policeStation'); ?>">
            </div>
            <div class="form-group">
              <label for="district">District</label>
              <input type="text" name="district" id="district" class="form-control" value="<?php echo set_value('district'); ?>">
            </div>
            <div class="form-group">
              <label for="pinCode">PIN Code</label>
              <input type="number" name="pinCode" id="pinCode" class="form-control" value="<?php echo set_value('pinCode'); ?>">
            </div>
            </textfield>
          </div>
          <div class="col-sm-6">
            <textfield>
              <legend>Present Address (if any)</legend>
              <div class="form-group">
                <label for="presentAddressLine1">Address Line 1</label>
                <input type="text" name="presentAddressLine1" id="presentAddressLine1" class="form-control" value="<?php echo set_value('presentAddressLine1'); ?>">
              </div>
              <div class="form-group">
                <label for="presentAddressLine2">Address Line 2</label>
                <input type="text" name="presentAddressLine2" id="presentAddressLine2" class="form-control" value="<?php echo set_value('presentAddressLine2'); ?>">
              </div>
            </textfield>
            <textfield>
              <legend>If any brother/sister studying in the school</legend>
              <div class="form-group">
                <label for="sibName">Name</label>
                <input type="text" name="sibName" id="sibName" class="form-control" value="<?php echo set_value('sibName'); ?>">
                <?php echo form_error('sibName', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="form-group">
                <label for="sibClass">Class</label>
                <input type="text" name="sibClass" id="sibClass" class="form-control" value="<?php echo set_value('sibClass'); ?>">
                <?php echo form_error('sibClass', '<p style="color: red;">', '</p>'); ?>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sibSection">Section</label>
                    <input type="text" name="sibSection" id="sibSection" class="form-control" value="<?php echo set_value('sibSection'); ?>">
                    <?php echo form_error("sibSection", '<p style="color: red;">', '</p>'); ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <label for="sibRollNo">Roll No</label>
                  <input type="number" name="sibRollNo" id="sibRollNo" class="form-control" value="<?php echo set_value('sibRollNo'); ?>">
                  <?php echo form_error('sibRollNo', '<p style="color: red;">', '</p>'); ?>
                </div>
              </div>
            </textfield>
          </div>
        </div>
        <div class="form-group">
          <a href="<?php echo '/markazboys/index.php/students'; ?>" class="btn btn-default">Cancel</a>
          <a href="<?php echo '/markazboys/index.php/students/newAdmissionForm?classid='.$classId; ?>" class="btn btn-default">Reset</a>
          <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php include("footer.php"); ?>
