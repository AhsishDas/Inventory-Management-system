<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
  if(isset($_GET['reclassid'])) $reClassId = $_GET['reclassid'];
  else $reClassId = -1;
 ?>
<div class="col-sm-9">
  <div class="panel panel-info">
    <div class="panel-heading">Select Students</div>
    <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>Student Name</th>
          <th>Roll No (cur)</th>
          <th>Section</th>
          <th>Roll No</th>
        </thead>
        <?php $action = '/markazboys/index.php/students/bulkReadmissionAction?classid='.$classId.'&reclassid='.$reClassId; ?>
        <form action="<?= $action; ?>" method="POST">
        <?php
          $count = 1;
          $students = $students['students'];
          $sections = $sections['sectionInfo'];
          foreach($students as $row) {
            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$row['student_name'].'</td>';
            echo '<td>'.$row['rollno'].'</td>';
            echo '<td>';
            echo '<select name="section'.$row['student_id'].'"id="section'.$row['student_id'].'" class="form-control">';
            echo '<option></option>';
            foreach($sections as $sec) {
              echo '<option>'.$sec['section_name'].'</option>';
            }
            echo '</select>';
            echo '</td>';
            echo '<td><input type="number" name="rollno'.$row['student_id'].'"id="rollno'.$row['student_id'].'" class="form-control">';
            echo '</tr>';
            $count ++;
          }
         ?>
      </table>

      <a href="/markazboys/index.php/students" class="btn btn-default">Cancel</a>
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
     </form>
    </div>
  </div>
</div>
</div>
<?php include('footer.php'); ?>
