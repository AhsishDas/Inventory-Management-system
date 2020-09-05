<?php
  if(isset($_GET['sessionid'])) $sessionId = $_GET['sessionid'];
  else $sessionId = -1;
?>
<div class="row">
  <div class="col-sm-4"></div>

  <div class="col-sm-4">
    <div class="panel panel-info">
      <div class="panel-heading">Edit Session</div>
      <div class="panel-body">
        <form action="<?php echo '/markazboys/index.php/sessions/editSession?sessionid='.$sessionId; ?>" method="POST">
          <div class="form-group">
            <label for="startDate">Starting Date</label>
            <input type="date" name="startDate" id="startDate" class="form-control">
            <?php echo form_error('startDate','<p style="color: red;">','</p>'); ?>
          </div>
          <div class="form-group">
            <label for="endDate">Ending Date</label>
            <input type="date" name="endDate" id="endDate" class="form-control">
            <?php echo form_error('endDate','<p style="color: red;">','</p>'); ?>
          </div>
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/Sessions'; ?>" class="btn btn-default">Cancel</a>
            <input type="submit" name="submit" value="Edit Session" class="btn btn-danger">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-sm-4"></div>
</div>
