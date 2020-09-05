<div class="panel panel-success">
  <div class="panel-heading">Create Daysheet</div>
  <div class="panel-body">
    <form action="<?php echo '/markazboys/index.php/accounting/newDaySheetAction'; ?>" method="POST">
      <textfield>
        <legend>Create daysheet for <?php echo date('M').' '.date('n').', '.date('M'); ?></legend>
        <div class="form-group">
          <label for="openingBalance">Opening Balance</label>
          <input type="number" name="openingBalance" id="openingBalance" class="form-control" value="<?php echo $openingBalance; ?>">
          <?php echo form_error('openingBalance', '<p style="color: red">', '</p>'); ?>
        </div>
        <div class="form-group">
          <label for="closingBalance">Closing Balance</label>
          <input type="number" name="closingBalance" id="closingBalance" class="form-control" value="<?php echo $closingBalance; ?>">
          <?php echo form_error('closingBalance', '<p style="color: red;">', '</p>'); ?>
        </div>
        <div class="form-group">
          <a href="<?php echo '/markazboys/index.php/accounting/daySheetList'; ?>" class="btn btn-default">Cancel</a>
          <input type="submit" name="create" value="Create" class="btn btn-primary">
        </div>
      </textfield>
    </form>
  </div>
</div>
