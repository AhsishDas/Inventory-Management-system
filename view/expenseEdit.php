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
  <div class="panel-heading">Edit Expense</div>
  <div class="panel-body">
    <form action="<?php echo '/markazboys/index.php/accounting/editExpense?recieptid='.$expenseInfo[0]['reciept_id']; ?>" method="POST">
      <div class="form-group">
        <label for="details">Expense Details</label>
        <input type="text" name="details" id="details" class="form-control" value="<?php echo $expenseInfo[0]['expense_details']; ?>">
        <?php echo form_error('details','<p style="color: red;">', '</p>'); ?>
      </div>
      <div class="form-group">
        <label for="amount">Expense Amount</label>
        <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $expenseInfo[0]['expense_amount']; ?>">
        <?php echo form_error('amount', '<p style="color: red;">', '</p>'); ?>
       </div>
       <div class="form-group">
         <a href="<?php echo '/markazboys/index.php/accounting/expenseList'; ?>" class="btn btn-default">Cancel</a>
         <a href="<?php echo '/markazboys/index.php/accounting/expenseEditForm?recieptid='.$expenseInfo[0]['reciept_id']; ?>" class="btn btn-default">Reset</a>
         <input type="submit" name="submit" class="btn btn-primary" value="Edit Expense">
       </div>
    </form>
  </div>
</div>
