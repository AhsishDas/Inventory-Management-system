<div class="text-center">
  <a href="<?php echo '/markazboys/index.php/accounting/daySheetList'; ?>" class="btn btn-default">Back</a>
  &nbsp;
  <button onclick="printReciept()" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Print</button>
</div>
<div id = "reciept">
  <div class="text-center">
    <h3><strong><u>Markaz Academy English High School</u></strong></h3>
    <h3>(Uder Markazul Ma'arif, Hojai)</h3>
    <h4 style="background-color: gray; padding: .1em; color: white;"><strong>Day Sheet, <?php echo $daysheetDate; ?></strong></h4>
  </div>
  <table class="table">
    <tr>
      <td style="width: 50%">
      <table class="table table-bordered">
        <thead>
          <th>Head of Incomme</th>
          <th>Amount</th>
        </thead>
        <tr>
          <td>School &amp; Hostel Fees</td>
          <td><?php echo $studentIncomeTotal; ?></td>
        </tr>
        <thead>
          <th>Other Sources</th>
          <th></th>
        </thead>
        <?php
          foreach($otherIncome as $row) {
            echo '<tr>';
            echo '<td>'.$row['income_details'].'</td>';
            echo '<td>'.$row['income_amount'].'</td>';
            echo '</tr>';
          }
         ?>
         <tr>
           <td><b>Total Collection</b></td>
           <td><b><?php echo $incomeTotal; ?></b></td>
         </tr>
      </table>
    </td>
    <td style="width: 50%">
      <table class="table table-bordered">
        <thead>
          <th>Head of Expenditure</th>
          <th>Amount</th>
        </thead>
        <?php
          foreach($expense as $row) {
            echo '<tr>';
            echo '<td>'.$row['expense_details'].'</td>';
            echo '<td>'.$row['expense_amount'].'</td>';
            echo '</tr>';
          }
        ?>
        <tr>
          <td><b>Total Expenditure</b></td>
          <td><b><?php echo $expenseTotal; ?></b></td>
        </tr>
      </table>
      <td>
    </tr>
  </table>
  <hr>
  <div class="row">
    <div class="col-sm-6 text-right">
      <b>Grand Total = <?php echo $totalCredit; ?></b>
    </div>
    <div class="col-sm-6 text-right">
      <b>Closing Balance = <?php echo $closingBalance; ?></b>
      <?php echo br(1); ?>
      <b>Grand Total = <?php echo $totalDebit; ?></b>
    </div>
  </div>
  <?php echo br(4); ?>
  <div class="row">
    <div class="col-sm-4">Accountant</div>
    <div class="col-sm-4 text-center">Estate Officer</div>
    <div class="col-sm-4 text-right">Principal</div>
  </div>
</div>
</div>
<script>
  function printReciept() {
    var restorePage = document.body.innerHTML;
    var printContent = document.getElementById('reciept').innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = restorePage;
  }
</script>
<?php include('footer.php'); ?>
