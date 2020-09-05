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
  <div class="panel-heading">Employee List</div>
  <div class="panel-body">
    <table class=" table table-bordered">
      <thead>
        <th>#</th>
        <th>Employee Name</th>
        <th>Designation</th>
        <th>Date Of Joining</th>
        <th>Action</th>
        <?php
          $count = 1;
          foreach($employee as $row) {
            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td>'.$row['employee_name'].'</td>';
            echo '<td>'.$row['designation'].'</td>';
            echo '<td>'.$row['doj'].'</td>';
            echo '<td>';
            echo '<div class="dropdown">';
            echo '<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">Action';
            echo '<span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="'."/markazboys/index.php/Employee/salaryAccount".'?employeeid='.$row['employee_id'].'">Salary Account</a></li>
                <li><a href="'."/markazboys/index.php/Printdoc/employeeProfile".'?employeeid='.$row['employee_id'].'" target="_blank">View Profile</a></li>
                <li><a href="'."/markazboys/index.php/Employee/editProfile".'?employeeid='.$row['employee_id'].'">Edit Profile</a></li>
                <li><a data-toggle="modal" href="#'.$count.'">Remove Employee</a></li>
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
                          <p>Are you sure to remove the Employee?</p>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <a href="'."/markazboys/index.php/employee/removeEmployee".'?employeeid='.$row['employee_id'].'" class="btn btn-danger">Yes</a>
                      </div>
                    </div>
                  </div>';
            echo '</td>';
            echo '</tr>';
            $count ++;
          }
        ?>
      </thead>
    </table>
  </div>
</div>
<?php include('footer.php'); ?>
