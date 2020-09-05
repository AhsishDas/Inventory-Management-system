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

<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="panel panel-info">
      <div class="panel-heading">Edit Employee Details</div>
      <div class="panel-body">
        <a href="/markazboys/index.php/employee/uploadPhoto?employeeid=<?php echo $employee[0]['employee_id']; ?>" class="btn btn-primary">Upload Photo</a><br><br>
        <form action="<?php echo '/markazboys/index.php/employee/editProfileAction?employeeid='.$employee[0]['employee_id']; ?>" method="POST">
          <div class="form-group">
            <label for="employeeName">Employee Name</label>
            <input type="text" name="employeeName" id="employeeName" class="form-control" value="<?php echo $employee[0]['employee_name']; ?>">
            <?php echo form_error('employeeName', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" name="designation" id="designation" class="form-control" value="<?php echo $employee[0]['designation']; ?>">
            <?php echo form_error('designation', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="qualification">Qualification</label>
            <input type="text" name="qualification" id="qualification" class="form-control" value="<?php echo $employee[0]['qualification']; ?>">
            <?php echo form_error('qualification','<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="workExperience">Work Experience</label>
            <input type="text" name="workExperience" id="workExperience" class="form-control" value="<?php echo $employee[0]['work_experience']; ?>">
            <?php echo form_error('workExperience', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="doj">Date of Joining</label>
            <input type="date" name="doj" id="doj" class="form-control" value="<?php echo $employee[0]['doj']; ?>">
            <?php echo form_error('doj', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/employee'; ?>" class="btn btn-default">Back</a>
            <a href="<?php echo '/markazboys/index.php/employee/editProfile?employeeid='.$employee[0]['employee_id']; ?>" class="btn btn-default">Reset</a>
            <input type="submit" name="submit" value="Edit Employee" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>
</div>
<?php include('footer.php'); ?>
