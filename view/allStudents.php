<?php
  if(isset($_GET['ser']) && $_GET['ser'] != '') {
    $searchStr = $_GET['ser'];
    $nameSearch = 1;
  }
  else $nameSearch = 0;

  if(isset($_GET['hostel']) && $_GET['hostel'] == 'on') $hostelSearch = 1;
  else $hostelSearch = 0;

  if(isset($_GET['transport']) && $_GET['transport'] == 'on') $transportSearch = 1;
  else $transportSearch = 0;


?>
<div class="col-sm-9">

    <?php
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
     
  <div class="panel panel-info">
    <div class="panel panel-heading">All Students List</div>
    <div class="panel-body">
      <form class="form-inline" action="#" method="GET">
        <div class="form-group">
          <div class="checkbox">
            <label><input type="checkbox" name="hostel"><strong>Hostel</strong></label>
          </div>
          &nbsp;
          <div class="checkbox">
            <label><input type="checkbox" name="transport"><strong>Transport</strong></label>
          </div>
          &nbsp;
          <select name="filter" class="form-control">
            <option>None</option>
            <option>New-Admission</option>
            <option>Re-Admission</option>
            <option>New-Hostel-Admission</option>
            <option>Re-Hostel-Admission</option>
            <option>Tuition</option>
            <option>Hostel</option>
            <option>Computer</option>
            <option>Transport</option>
            <option>Examination</option>
            <option>Library</option>
            <option>Game</option>
            <option>Diary-Notebook</option>
          </select>
        </div>

        <div class="form-group">
          <input type="text" name="ser" class="form-control" placeholder="search student">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Search" class="btn btn-success">
        </div>

      </form>

      <?php echo br(1); ?>
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>Student Name</th>
          <th>Class</th>
          <th>Section</th>
          <th>Rollno</th>
          <th>Action</th>
        </thead>
        <?php
          $count = 1;
          foreach($students as $row) {
            $nameView = 1;
            if($nameSearch == 1) {
              if(stristr($row['student_name'],$searchStr)) $nameView = 1;
              else $nameView = 0;
            }
            $transportView = 1;
            if($transportSearch == 1) {
              if($row['transport_facility'] == 'Y') $transportView = 1;
              else $transportView = 0;
            }
            $hostelView = 1;
            if($hostelSearch == 1) {
              if($row['hostel_facility'] == 'Y') $hostelView = 1;
              else $hostelView = 0;
            }

            if($nameView && $hostelView && $transportView) {
            echo '<tr class="'.$class[$row['student_id']].'">';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$row['student_name'].'</td>';
            echo '<td>'.$classNames[$row['student_id']].'</td>';
            echo '<td>'.$sectionNames[$row['student_id']].'</td>';
            echo '<td>'.$row['rollno'].'</td>';
            echo '<td>';
            echo '<div class="dropdown">';
            echo '<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action';
            echo '<span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="'."/markazboys/index.php/accounting/recieptForm".'?studentid='.$row['student_id'].'" target="_blank">Collect fees</a></li>
                <li><a href="'."/markazboys/index.php/printdoc/studentProfile".'?studentid='.$row['student_id'].'" target="_blank">View Profile</a></li>
                <li><a href="'."/markazboys/index.php/students/editProfile".'?studentid='.$row['student_id'].'">Edit Profile</a></li>
                <li><a href="'."/markazboys/index.php/students/feeInfo".'?studentid='.$row['student_id'].'">Fees</a></li>
                <li><a href="'."/markazboys/index.php/students/reAdmissionClass".'?studentid='.$row['student_id'].'">Re-Admission</a></li>
                <li><a data-toggle="modal" href="#'.$count.'">Remove Student</a></li>
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
                          <p>Are you sure to remove the student?</p>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a href="'."/markazboys/index.php/students/removeStudent".'?studentid='.$row['student_id'].'" class="btn btn-danger">Yes</a>
                      </div>
                    </div>
                  </div>';
            echo '</td>';
            echo '</tr>';
            $count ++;
          }}
        ?>
      </table>
    </div>
  </div>
</div>
</div>
<?php include("footer.php"); ?>
