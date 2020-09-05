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

<div class="panel panel-success">
  <div class="panel-heading">Edit Daysheet</div>
  <div class="panel-body">
    <form action="<?php echo '/markazboys/index.php/accounting/daysheetEdit?daysheetid='.$daysheetInfo[0]['daysheet_id']; ?>" method="POST">
        <div class="form-group">
          <label for="openingBalance">Opening Balance</label>
          <input type="number" name="openingBalance" id="openingBalance" class="form-control" value="<?php echo $daysheetInfo[0]['opening_balance']; ?>">
          <?php echo form_error('openingBalance', '<p style="color: red">', '</p>'); ?>
        </div>
        <div class="form-group">
          <label for="closingBalance">Closing Balance</label>
          <input type="number" name="closingBalance" id="closingBalance" class="form-control" value="<?php echo $daysheetInfo[0]['closing_balance']; ?>">
          <?php echo form_error('closingBalance', '<p style="color: red;">', '</p>'); ?>
        </div>
        <div class="form-group">
          <a href="<?php echo '/markazboys/index.php/accounting/daySheetList'; ?>" class="btn btn-default">Cancel</a>
          <input type="submit" name="create" value="Edit Daysheet" class="btn btn-primary">
        </div>
    </form>
  </div>
</div>
