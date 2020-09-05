<div class="panel panel-info">
  <div class="panel-heading">Expense List</div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-7">
        <form class="form-inline" action='#' method="POST">
          <div class="form-group">
            <input type="date" name="startDate" class="form-control">
          </div>
          <div class="form-group">
            <input type="date" name="endDate" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="searchByDate" value="Search" class="btn btn-success">
          </div>
        </form>
      </div>
      <div class="col-sm-5 text-right">
        <form action="#" method="POST" class="form-inline">
          <div class="form-group">
            <input type="number" name="recieptId" class="form-control" placeholder="Reciept ID">
          </div>
          <div class="form-group">
            <input type="submit" name="searchById" value="Search" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
    <?php echo br(1); ?>
    <table class="table table-bordered">
      <thead>
        <th>#</th>
        <th>Reciept ID</th>
        <th>Details</th>
        <th>Date</th>
        <th>Amount(&#x20B9;)</th>
        <th>Action</th>
      </thead>
      <?php
        $count = 1;
        foreach($recieptInfo as $row) {
          echo '<tr>';
          echo '<td>'.$count.'</td>';
          echo '<td>'.$row['reciept_id'].'</td>';
          echo '<td>'.$row['expense_details'].'</td>';
          echo '<td>'.$row['expense_date'].'</td>';
          echo '<td>'.$row['expense_amount'].'</td>';
          echo '<td><a href="/markazboys/index.php/accounting/expenseEditForm?recieptid='.$row['reciept_id'].'" class="btn btn-warning">Edit</a>';
          echo '</tr>';
          $count ++;
        }
       ?>
    </table>
  </div>
</div>
</div>
</div>
<?php include('footer.php'); ?>
