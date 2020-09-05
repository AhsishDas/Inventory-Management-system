<div class="text-center">
  <button onclick="printReciept()" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Print</button>
</div>

<div id="reciept">
  <div class="container" style="padding: 3em;">
    <div class="panel panel-info">
      <div class="panel-body">

        <div class="row">
          <div class="col-sm-9">
            <div class="panel panel-info">
              <div class="panel-body">
                <p><b>Employee Name: </b><?= $employeeName; ?></p>
                <p><b>Designation: </b><?= $designation; ?></p>
                <p><b>Qualification: </b><?= $qualification; ?></p>
                <p><b>Work Experience: </b><?= $workExperience; ?></p>
                <p><b>Date of Joining: </b><?= $doj; ?></p>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <?php
              if($url == '' || $url == NULL) {
                $url = '/markazboys/assets/images/default/default_avatar.png';
              }
            ?>

            <img src="<?= $url; ?>" class="img-thumbnail">
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>

<script>
  function printReciept() {
    var restorePage = document.body.innerHTML;
    var printContent = document.getElementById('reciept').innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = restorePage;
  }
</script>

<?php include('footer.php'); ?>
