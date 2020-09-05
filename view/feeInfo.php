<div class="col-sm-9">
  <div class="panel panel-info">
    <div class="panel-heading">Fee Info</div>
    <div class="panel-body">
      <h3><b><?php echo $studentName; ?></b></h3>
      <div class="row">
        <div class="col-sm-4">
          <h4><b>Class: <?php echo $className; ?></b></h4>
        </div>
        <div class="col-sm-4 text-center">
          <h4><b>Seciton: <?php echo $sectionName ?></b></h4>
        </div>
        <div class="col-sm-4 text-right">
          <h4><b>Roll No: <?php echo $rollno; ?></b></h4>
        </div>
      </div>
      <?php echo br(1); ?>
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>ID</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Action</th>
        </thead>
        <?php
          $count = 1;
          foreach($feeInfo as $row) {
            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$row['reciept_id'].'</td>';
            echo '<td>'.$row['reciept_date'].'</td>';
            echo '<td>'.$row['total'].'</td>';
            echo '<td>';
            echo '<a href="/markazboys/index.php/accounting/editReciept?recieptid='.$row['reciept_id'].'" class="btn btn-warning" target="_blank">Edit</a>';
            echo '&nbsp;';
            echo '<a href="/markazboys/index.php/printdoc/printReciept?recieptid='.$row['reciept_id'].'" class="btn btn-info" target="_blank">Print</a>';
            echo '</td>';
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
