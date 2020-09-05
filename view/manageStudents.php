<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
?>
<div class="row">
  <div class="col-sm-3">
    <div class="panel panel-info">
      <div class="panel-heading">Class List</div>
      <div class="panel-body">
        <div class="list-group">
          <?php
            if($classId == -1) echo '<a href="/markazboys/index.php/students'.'" class="list-group-item list-group-item-danger">ALL STUDENTS<span class="badge">'.$totalStudents.'</span></a>';
            else echo '<a href="/markazboys/index.php/students'.'" class="list-group-item">ALL STUDENTS<span class="badge">'.$totalStudents.'</span></a>';
            foreach($classes as $row) {
              if($classId == $row['class_id']) echo '<a href="/markazboys/index.php/students/classStudents?classid='.$row['class_id'].'" class="list-group-item list-group-item-danger">'.$row['class_name'].'<span class="badge">'.$noOfStudents[$row['class_id']].'</span></a>';
              else echo '<a href="/markazboys/index.php/students/classStudents?classid='.$row['class_id'].'" class="list-group-item">'.$row['class_name'].'<span class="badge">'.$noOfStudents[$row['class_id']].'</span></a>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
