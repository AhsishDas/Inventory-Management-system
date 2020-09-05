<?php echo br(4); ?>
<div class="container">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="panel panel-info">
      <div class="panel-heading">Login</div>
      <div class="panel-body">
        <?php
          if(isset($_GET['usfl'])) {
            echo '<div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><span class="glyphicon glyphicon-remove-circle"></span> Unsuccessful!</strong> Incorrect Password.
                  </div>';
          }
        ?>
        <form action="/markazboys/index.php/login/loginAction" method="POST">
          <textfield>
            <legend>Login Information</legend>
            <div class="form-group">
              <select name="user" class="form-control input-lg">
                <option>admin</option>
                <option>user</option>
              </select>
            </div>
            <div class="form-group">
              <input type="password" name="passwd" class="form-control input-lg" placeholder="enter password">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg">
            </div>
          </textfield>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>
</div>
<?php include('footer.php'); ?>
