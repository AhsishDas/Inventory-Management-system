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
  <div class="panel-heading">New Expense</div>
  <div class="panel-body">
    <form action="<?php echo '/markazboys/index.php/accounting/newExpenseAction'; ?>" method="POST">
      <textfield>
        <legend>Expense Details and Amount</legend>

            <div class="form-group">
              <label for="details">Expense Details</label>
              <input type="text" name="details" id="details" class="form-control" value="<?php echo set_value('details'); ?>">
              <?php echo form_error('details','<p style="color: red;">', '</p>'); ?>
            </div>
            <div class="form-group">
              <label for="amount">Expense Amount</label>
              <input type="number" name="amount" id="amount" class="form-control" value="<?php echo set_value('amount'); ?>">
              <?php echo form_error('amount','<p style="color: red;">', '</p>'); ?>
            </div>
            <div class="form-group">
              <a href="<?php echo '/markazboys/index.php/accounting'; ?>" class="btn btn-default">Cancel</a>
              <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>

      </textfield>
    </form>
  </div>
</div>

</div>
</div>
<?php include('footer.php'); ?>
