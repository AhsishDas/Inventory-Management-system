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
      <div class="panel-heading">Employee Details</div>
      <div class="panel-body">
        <form action="<?php echo '/markazboys/index.php/employee/newEmployee'; ?>" method="POST">
          <div class="form-group">
            <label for="employeeName">Employee Name</label>
            <input type="text" name="employeeName" id="employeeName" class="form-control" value="<?php echo set_value('employeeName'); ?>">
            <?php echo form_error('employeeName', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" name="designation" id="designation" class="form-control" value="<?php echo set_value('designation'); ?>">
            <?php echo form_error('designation', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="qualification">Qualification</label>
            <input type="text" name="qualification" id="qualification" class="form-control" value="<?php echo set_value('qualification'); ?>">
            <?php echo form_error('qualification','<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="workExperience">Work Experience</label>
            <input type="text" name="workExperience" id="workExperience" class="form-control" value="<?php echo set_value('workExperience'); ?>">
            <?php echo form_error('workExperience', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <label for="doj">Date of Joining</label>
            <input type="date" name="doj" id="doj" class="form-control" value="<?php echo set_value('doj'); ?>">
            <?php echo form_error('doj', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/employee'; ?>" class="btn btn-default">Cancel</a>
            <a href="<?php echo '/markazboys/index.php/employee/newEmployeeForm'; ?>" class="btn btn-default">Reset</a>
            <input type="submit" name="submit" value="Add Employee" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>
</div>
<?php include('footer.php'); ?>
