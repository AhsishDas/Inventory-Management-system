<?php
  if(isset($_GET['classid'])) $classId = $_GET['classid'];
  else $classId = -1;
  $classes = $class['classes'];
  $noOfStudents = $class['noOfStudents'];
  $sectionData = $section['sectionData'];
  $noOfStudentsSection = $section['noOfStudentsSection'];

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
<div class="row">
  <div class="col-sm-3">
    <div class="panel panel-info">
      <div class="panel-heading">Class List</div>
      <div class="panel-body">
        <div class="list-group">
          <?php
            foreach($classes as $row) {
              if($classId == $row['class_id']) echo '<a class="list-group-item list-group-item-danger" href="#">';
              else echo '<a class="list-group-item" href="/markazboys/index.php/classes/manageSections?classid='.$row['class_id'].'">';
              echo $row['class_name'];
              echo '<span class="badge">'.$noOfStudents[$row['class_id']].'</span>';
              echo '</a>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-9">
    <div class="panel panel-info">
      <div class="panel-heading">Manage Sections</div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <th>#</th>
            <th>Section Name</th>
            <th>No of Students</th>
            <th>Action</th>
          </thead>

          <?php
            $count = 1;
            foreach($sectionData as $row) {
              echo '<tr>';
              echo '<td>'.$count.'</td>';
              echo '<td>'.$row['section_name'].'</td>';
              echo '<td>'.$noOfStudentsSection[$row['section_id']].'</td>';

              echo '<td>';
              echo '<div class="dropdown">';
              echo '<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action';
    					echo '<span class="caret"></span></button>
    					  <ul class="dropdown-menu">
    					    <li><a href="'."/markazboys/index.php/Classes/editSectionForm".'?classid='.$row['class_id'].'&sectionid='.$row['section_id'].'">Edit Section</a></li>
                  <li><a data-toggle="modal" href="#'.$count.'">Remove Class</a></li>
    					  </ul>
    					</div>';
              echo '<div id="'.$count.'" class="modal fade" role="dialog">
    								  <div class="modal-dialog">
    								    <div class="modal-content">
    								      <div class="modal-header">
    								        <button type="button" class="close" data-dismiss="modal">&times;</button>
    								        <h4 class="modal-title">Confirmation</h4>
    								      </div>
    								      <div class="modal-body text-center">
    								        <p>Are you sure to remove the section?</p>
    								        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    												<a href="'."/markazboys/index.php/Classes/removeSection".'?classid='.$row['class_id'].'&sectionid='.$row['section_id'].'" class="btn btn-danger">Yes</a>
    								    </div>
    								  </div>
    								</div>';
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
