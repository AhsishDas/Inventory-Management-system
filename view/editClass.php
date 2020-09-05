<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
?>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="well">
      <form action="<?php echo '/markazboys/index.php/classes/editClass?classid='.$classId; ?>" method="POST">
        <textfield>
          <legend>Edit Class Name</legend>
          <div class="form-group">
            <input type="text" name="newClassName" placeholder="new class name" class="form-control">
            <?php echo form_error('newClassName','<p style="color: red;">','</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/Classes'; ?>" class="btn btn-default">Cancel</a>
            <input type="submit" name="submit" value="Edit Class" class="btn btn-primary">
          </div>
        </textfield>
      </form>
    </div>
  </div>
  <div class="col-sm-4"></div>
</div>
