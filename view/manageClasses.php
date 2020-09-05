<?php
  if(isset($_GET['edc'])) {
    $value = $_GET['edc'];
    if($value == 'sfl') {
      echo '<div class="alert alert-success alert-dismissable">';
      echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
      echo 'Class name edited successfully.';
      echo '</div>';
    }
    elseif($value == 'usfl') {
      echo '<div class="alert alert-danger alert-dismissable">';
      echo '<a href="#" class="close" data-dimiss="alert" aria-label="close">&times;</a>';
      echo 'Something went wrong. Please Try again.';
      echo '</div>';
    }
  }
  elseif(isset($_GET['sfl'])) {
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
<div class="panel panel-info">
  <div class="panel-heading">Manage Classes</div>
  <div class="panel-body">
    <table class="table table-bordered">
      <thead>
        <th>#</th>
        <th>Class Name</th>
        <th>No of Sections</th>
        <th>No of Students</th>
        <th>Action</th>
      </thead>
      <?php
        $count = 1;
        foreach($classes as $row) {
          echo '<tr>';
          echo '<td>'.$count.'</td>';
          echo '<td>'.$row['class_name'].'</td>';
          echo '<td>'.$noOfSections[$row['class_id']].'</td>';
          echo '<td>'.$noOfStudents[$row['class_id']].'</td>';
          echo '<td>';
          echo '<div class="dropdown">';
          echo '<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action';
					echo '<span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a href="'."/markazboys/index.php/Classes/manageSections".'?classid='.$row['class_id'].'">Manage Sections</a></li>
					    <li><a href="'."/markazboys/index.php/Classes/editClassform".'?classid='.$row['class_id'].'">Edit Class</a></li>
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
								        <p>Are you sure to remove the class?</p>
								        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
												<a href="/markazboys/index.php/classes/removeClass?classid='.$row['class_id'].'" class="btn btn-danger">Yes</a>
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
<?php include('footer.php'); ?>
