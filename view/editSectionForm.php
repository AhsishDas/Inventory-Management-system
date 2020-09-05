<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
  if(isset($_GET['sectionid'])) $sectionId = $_GET['sectionid'];
  else $sectionId = -1;
?>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="well">
      <form action="<?php echo '/markazboys/index.php/classes/editSection?classid='.$classId.'&sectionid='.$sectionId; ?>" method="POST">
        <textfield>
          <legend>Edit Section</legend>
          <div class="form-group">
            <input type="text" name="sectionName" placeholder="section name" class="form-control">
            <?php echo form_error('sectionName', '<p style="color: red;">', '</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/classes/manageSections?classid='.$classId.'&sectionid='.$sectionId; ?>" class="btn btn-default">Cancel</a>
            <input type="submit" name="submit" value="Edit Section" class="btn btn-danger">
          </div>
          <di
        </textfield>
      </form>
    </div>
  </div>
  <div class="col-sm-4"></div>
</div>
