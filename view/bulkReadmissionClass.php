<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
?>
<div class="col-sm-9">
  <div class="panel panel-info">
    <div class="panel-heading">Re-Admission Class</div>
    <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>Class Name</th>
          <th>Select</th>
        </thead>
        <?php
          $count = 1;
          foreach($classInfo as $row) {
            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$row['class_name'].'</td>';
            echo '<td><a href="'."/markazboys/index.php/students/bulkReadmissionForm?reclassid=".$row['class_id'].'&classid='.$classId.'" class="btn btn-success">Select</a>';
            echo '</tr>';
            $count ++;
          }
         ?>
      </table>
    </div>
  </div>
</div>
