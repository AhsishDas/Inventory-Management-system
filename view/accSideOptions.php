<?php
  for($i = 0; $i <= 6; $i ++) {
    if($curOption == $i) $class[$i] = 'list-group-item list-group-item-danger';
    else $class[$i] = 'list-group-item';
  }
?>
<div class="row">
  <div class="col-sm-3">
    <div class="panel panel-info">
      <div class="panel-heading">Options</div>
      <div class="panel-body">
        <div class="list-group">
          <a href="<?php echo '/markazboys/index.php/accounting/newOtherIncomeForm'; ?>" class="<?php echo $class[0]; ?>">New Other Income</a>
          <a href="<?php echo '/markazboys/index.php/accounting/newExpenseForm'; ?>" class="<?php echo $class[1]; ?>">New Expense</a>
          <a href="<?php echo '/markazboys/index.php/accounting/StudentIncomeList'; ?>" class="<?php echo $class[2]; ?>">Student Income List</a>
          <a href="<?php echo '/markazboys/index.php/accounting/OtherIncomeList'; ?>" class="<?php echo $class[3]; ?>">Other Income List</a>
          <a href="<?php echo '/markazboys/index.php/accounting/expenseList'; ?>" class="<?php echo $class[4]; ?>">Expense List</a>
          <a href="<?php echo '/markazboys/index.php/accounting/daySheetList'; ?>" class="<?php echo $class[5]; ?>">Day Sheet</a>
          <a href="<?php echo '/markazboys/index.php/printdoc/salaryReport' ?>" class="list-group-item" target="_blank">Salary Report</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-9">
