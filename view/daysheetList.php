<?php
  if(isset($_GET['dusfl'])) {
    echo '<div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><span class="glyphicon glyphicon-ban-circle"></span> Unsuccessful!</strong> Daysheet is already created. Please edit.
          </div>';
  }
?>

<div class="panel panel-info">
  <div class="panel-heading">Daysheet List</div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo '/markazboys/index.php/accounting/newDaysheetForm'; ?>" class="btn btn-primary">Create Daysheet</a>
      </div>
      <div class="col-sm-6 text-right">
        <form class="form-inline" action="#" method="POST">
          <div class="form-group">
            <input type="date" name="daysheetDate" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-success" value="Search">
          </div>
        </form>
      </div>
    </div>
    <?php echo br(1); ?>
    <table class="table table-bordered">
      <thead>
        <th>#</th>
        <th>Date</th>
        <th>Opening Balance</th>
        <th>Closing balance</th>
        <th>Action</th>
      </thead>
      <?php
        $count = 1;
        foreach($daysheet as $row) {
          echo '<tr>';
          echo '<td>'.$count.'</td>';
          echo '<td>'.$row['daysheet_date'].'</td>';
          echo '<td>'.$row['opening_balance'].'</td>';
          echo '<td>'.$row['closing_balance'].'</td>';
          echo '<td>';
          echo '<a href="/markazboys/index.php/accounting/daysheetEditForm?daysheetid='.$row['daysheet_id'].'" class="btn btn-warning">Edit</a>';
          echo '&nbsp;';
          echo '<a href="/markazboys/index.php/printdoc/printDaysheet?daysheetid='.$row['daysheet_id'].'" class="btn btn-info" target="_blank">Print</a>';
          echo '</td>';
          echo '</tr>';
          $count ++;
        }
       ?>
    </table>
  </div>
</div>
</div>
<?php include('footer.php'); ?>
