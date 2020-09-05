<?php
  if(isset($_GET['adc']) && $_GET['adc'] == 'sfl') {
    echo '<div class="alert alert-success alert-dismissable">';
    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
    echo 'New class added successfully.';
    echo '</div>';
  }
?>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="well">
      <form action="<?php echo '/markazboys/index.php/classes/addNewClass'; ?>" method="POST">
        <textfield>
          <legend>Add New Class</legend>
          <div class="form-group">
            <input type="text" name="newClassName" placeholder="class name" class="form-control">
            <?php echo form_error('newClassName','<p style="color: red;">','</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/classes'; ?>" class="btn btn-default">Cancel</a>
            <input type="submit" name="submit" value="Add Class" class="btn btn-primary">
          </div>
        </textfield>
      </form>
    </div>
  </div>
  <div class="col-sm-4"></div>
</div>
