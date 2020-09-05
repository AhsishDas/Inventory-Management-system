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

<div class="container">
  <div class="panel panel-success">
    <div class="panel-heading">Student's Information</div>
    <div class="panel-body">
      <h3><strong>Name: </strong> <?php echo $studentInfo['studentName']; ?></h3>
      <h4><strong>Father Name: </strong> <?php echo $studentInfo['fatherName']; ?></h4>
      <div class="row">
        <div class="col-sm-4">
          <h4><strong>Class: </strong> <?php echo $studentInfo['className']; ?> </h4>
        </div>
        <div class="col-sm-4">
          <h4><strong>Section: </strong> <?php echo $studentInfo['sectionName']; ?> </h4>
        </div>
        <div class="col-sm-4">
          <h4><strong>Roll No: </strong> <?php echo $studentInfo['rollno']; ?> </h4>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-info">
    <div class="panel-heading">Reciept</div>
    <div class="panel-body">
      <form onsubmit="return check()" action="<?php echo '/markazboys/index.php/accounting/editRecieptAction?recieptid='.$recieptInfo[0]['reciept_id']; ?>" method="POST">
        <table class="table table-hover">
          <thead>
            <th>Sr No</th>
            <th>Particulars</th>
            <th>Details</th>
            <th>Validity</th>
            <th>Rs</th>
          </thead>
          <tr>
            <td>01</td>
            <td>Shool New Admission</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="newAdmissionDetails" id="newAdmissionDetails" class="form-control" value="<?php echo $recieptInfo[0]['new_admission_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="newAdmissionDate" id="newAdmissionDate" class="form-control" value="<?php echo $recieptInfo[0]['new_admission_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="newAdmissionAmount" id="newAdmissionAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['new_admission_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>02</td>
            <td>School Re-Admission</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="reAdmissionDetails" id="reAdmissionDetails" class="form-control" value="<?php echo $recieptInfo[0]['re_admission_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="reAdmissionDate" id="reAdmissionDate" class="form-control" value="<?php echo $recieptInfo[0]['re_admission_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="reAdmissionAmount" id="reAdmissionAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['re_admission_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>03</td>
            <td>Hostel New Admission</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" style="border-width: 0px 0px 2px 0px;" type="text" name="newHostelDetalis" id="newHostelDetalis" class="form-control" value="<?php echo $recieptInfo[0]['new_hostel_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="newHostelDate" id="newHostelDate" class="form-control" value="<?php echo $recieptInfo[0]['new_hostel_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="newHostelAmount" id="newHostelAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['new_hostel_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>04</td>
            <td>Hostel Re-Admission</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="reHostelDetails" id="reHostelDetails" class="form-control" value="<?php echo $recieptInfo[0]['re_hostel_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="reHostelDate" id="reHostelDate" class="form-control" value="<?php echo $recieptInfo[0]['re_hostel_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="reHostelAmount" id="reHostelAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['re_hostel_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>05</td>
            <td>Monthly Tuition Fees</td>
            <td>
              <div class="from-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="monthlyTuitionFeesDetails" id="monthlyTuitionFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['monthly_tuition_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="monthlyTuitionFeesDate" id="monthlyTuitionFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['monthly_tuition_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="monthlyTuitionFeesAmount" id="monthlyTuitionFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['monthly_tuition_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>06</td>
            <td>Hostel Monthly Fees</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="hostelMonthlyFeesDetails" id="hostelMonthlyFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['hostel_monthly_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="hostelMonthlyFeesDate" id="hostelMonthlyFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['hostel_monthly_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="hostelMonthlyFeesAmount" id="hostelMonthlyFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['hostel_monthly_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>07</td>
            <td>Computer Fees</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="computerFeesDetails" id="computerFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['computer_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="computerFeesDate" id="computerFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['computer_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="computerFeesAmount" id="computerFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['computer_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>08</td>
            <td>Monthly Transport Fees</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="monthlyTransportFeesDetails" id="monthlyTransportFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['monthly_transport_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="monthlyTransportFeesDate" id="monthlyTransportFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['monthly_transport_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="monthlyTransportFeesAmount" id="monthlyTransportFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['monthly_transport_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>09</td>
            <td>Examination Fee</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="examinationFeesDetails" id="examinationFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['examination_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="examinationFeesDate" id="examinationFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['examination_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="examinationFeesAmount" id="examinationFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['examination_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>10</td>
            <td>Library Fees</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="libraryFeesDetails" id="libraryFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['library_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="libraryFeesDate" id="libraryFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['library_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="libraryFeesAmount" id="libraryFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['library_a']; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td>11</td>
            <td>Game Fees</td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="text" name="gameFeesDetails" id="gameFeesDetails" class="form-control" value="<?php echo $recieptInfo[0]['game_d']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="date" name="gameFeesDate" id="gameFeesDate" class="form-control" value="<?php echo $recieptInfo[0]['game_val']; ?>">
              </div>
            </td>
            <td>
              <div class="form-group">
                <input style="border-width: 0px 0px 2px 0px;" type="number" name="gameFeesAmount" id="gameFeesAmount" oninput="calTotal()" class="form-control" value="<?php echo $recieptInfo[0]['game_a']; ?>">
              </div>
            </td>
            <tr>
              <td>12</td>
              <td>Academic Diary/Hand Book</td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="text" name="diaryDetails" id="diaryDetails" class="form-control" value="<?php echo $recieptInfo[0]['diary_d']; ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="date" name="diaryDate" id="diaryDate" class="form-control" value="<?php echo $recieptInfo[0]['diary_val']; ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="number" name="diaryAmount" id="diaryAmount" oninput="calTotal()" oninput="calTotal()" class="form-control" value="<?php $recieptInfo[0]['diary_a']; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>13</td>
              <td>Miscellaneous</td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="text" name="misDetails" id="misDetails" class="form-control" value="<?php echo $recieptInfo[0]['mis_d']; ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="date" name="misDate" id="misDate" class="form-control" value="<?php echo $recieptInfo[0]['mis_val']; ?>">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input style="border-width: 0px 0px 2px 0px;" type="number" name="misAmount" id="misAmount" oninput="calTotal()" class="form-control" value="<?php $recieptInfo[0]['mis_a']; ?>">
                </div>
              </td>
            </tr>
          </tr>
          <tr>
            <td></td>
            <td>Total</td>
            <td>
              <div class="from-group">
                <input type="number" name="total" id="total" readonly="readonly" ondblclick="removeReadonly()" onchange="setReadonly()" class="form-control" value="<?php echo $recieptInfo[0]['total']; ?>">
              </div>
            </td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <div class="text-center">
          <div class="form-group">
            <a href="<?php echo '/markazboys/index.php/accounting/studentIncomeList'; ?>" class="btn btn-default">Back</a>
            <a href="<?php echo '/markazboys/index.php/accounting/editReciept?recieptid='.$recieptInfo[0]['reciept_id']; ?>" class="btn btn-default">Reset</a>
            <input type="submit" name="submit" class="btn btn-primary" value="Edit Receipt">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function getData() {
    var data = {
      newAdmission: document.getElementById('newAdmissionAmount').value,
      reAdmission: document.getElementById('reAdmissionAmount').value,
      newHostel: document.getElementById('newHostelAmount').value,
      reHostel: document.getElementById('reHostelAmount').value,
      monthlyTuitionFees: document.getElementById('monthlyTuitionFeesAmount').value,
      hostelMonthlyFees: document.getElementById('hostelMonthlyFeesAmount').value,
      computerFees: document.getElementById('computerFeesAmount').value,
      monthlyTransportFees: document.getElementById('monthlyTransportFeesAmount').value,
      examinationFees: document.getElementById('examinationFeesAmount').value,
      libraryFees: document.getElementById('libraryFeesAmount').value,
      gameFees: document.getElementById('gameFeesAmount').value,
      diary: document.getElementById('diaryAmount').value,
      mis: document.getElementById('misAmount').value,
    }
    return data;
  }

  function calTotal() {
    var data = getData();

    if(data.newAdmission == '') data.newAdmission = 0;
    if(data.reAdmission == '') data.reAdmission = 0;
    if(data.newHostel == '') data.newHostel = 0;
    if(data.reHostel == '') data.reHostel = 0;
    if(data.monthlyTuitionFees == '') data.monthlyTuitionFees = 0;
    if(data.hostelMonthlyFees == '') data.hostelMonthlyFees = 0;
    if(data.computerFees == '') data.computerFees = 0;
    if(data.monthlyTransportFees == '') data.monthlyTransportFees = 0;
    if(data.examinationFees == '') data.examinationFees = 0;
    if(data.libraryFees == '') data.libraryFees = 0;
    if(data.gameFees == '') data.gameFees = 0;
    if(data.diary == '') data.diary = 0;
    if(data.mis == '') data.mis = 0;

    var newAdmission = Math.floor(data.newAdmission);
    var reAdmission = Math.floor(data.reAdmission);
    var newHostel = Math.floor(data.newHostel);
    var reHostel = Math.floor(data.reHostel);
    var monthlyTuitionFees = Math.floor(data.monthlyTuitionFees);
    var hostelMonthlyFees = Math.floor(data.hostelMonthlyFees);
    var computerFees = Math.floor(data.computerFees);
    var monthlyTransportFees = Math.floor(data.monthlyTransportFees);
    var examinationFees = Math.floor(data.examinationFees);
    var libraryFees = Math.floor(data.libraryFees);
    var gameFees = Math.floor(data.gameFees);
    var diary = Math.floor(data.diary);
    var mis = Math.floor(data.mis);

    var total = newAdmission + reAdmission + newHostel + reHostel + monthlyTuitionFees + hostelMonthlyFees + computerFees + monthlyTransportFees
    + examinationFees + libraryFees + gameFees + diary + mis;
    document.getElementById('total').value = total;
  }

  function removeReadonly() {
    document.getElementById('total').removeAttribute('readonly');
  }

  function setReadonly() {
    var val = document.getElementById('total');
    val.setAttribute('readonly','readonly');
  }

  function check() {
    var data = getData();
    if(data.newAdmission != '') {
      var newAdmissionDetails = document.getElementById('newAdmissionDetails').value;
      var newAdmissionDate = document.getElementById('newAdmissionDate').value;
      if(newAdmissionDetails == '' || newAdmissionDate == '') {
        alert('Please fill in the new admission fees details and validity.');
        return false;
      }
    }
    if(data.reAdmission != '') {
      var reAdmissionDetails = document.getElementById('reAdmissionDetails').value;
      var reAdmissionDate = document.getElementById('reAdmissionDate').value;
      if(reAdmissionDetails == '' || reAdmissionDate == '') {
        alert('Please fill in the re admission fees details and validity.');
        return false;
      }
    }
    if(data.newHostel != '') {
      var newHostelDetalis = document.getElementById('newHostelDetalis').value;
      var newHostelDate = document.getElementById('newHostelDate').value;
      if(newHostelDetalis == '' || newHostelDate == '') {
        alert('Please fill in the new hostel fees details and validity.');
        return false;
      }
    }
    if(data.reHostel != '') {
      var reHostelDetails = document.getElementById('reHostelDetails').value;
      var reHostelDate = document.getElementById('reHostelDate').value;
      if(reHostelDetails == '' || reHostelDate == '') {
        alert('Please fill in the re hostel fees details and validity.');
        return false;
      }
    }
    if(data.monthlyTuitionFees != '') {
      var monthlyTuitionFeesDetails = document.getElementById('monthlyTuitionFeesDetails').value;
      var monthlyTuitionFeesDate = document.getElementById('monthlyTuitionFeesDate').value;
      if(monthlyTuitionFeesDetails == '' || monthlyTuitionFeesDate == '') {
        alert('Please fill in the monthly tuition fees details and validity.');
        return false;
      }
    }
    if(data.hostelMonthlyFees != '') {
      var hostelMonthlyFeesDetails = document.getElementById('hostelMonthlyFeesDetails').value;
      var hostelMonthlyFeesDate = document.getElementById('hostelMonthlyFeesDate').value;
      if(hostelMonthlyFeesDetails == '' || hostelMonthlyFeesDate == '') {
        alert('Please fill in the hostel monthly fees details and validity.');
        return false;
      }
    }
    if(data.computerFees != '') {
      var computerFeesDetails = document.getElementById('computerFeesDetails').value;
      var computerFeesDate = document.getElementById('computerFeesDate').value;
      if(computerFeesDetails == '' || computerFeesDate == '') {
        alert('Please fill in the computer fees details and validity.');
        return false;
      }
    }
    if(data.monthlyTransportFees != '') {
      var monthlyTransportFeesDetails = document.getElementById('monthlyTransportFeesDetails').value;
      var monthlyTransportFeesDate = document.getElementById('monthlyTransportFeesDate').value;
      if(monthlyTransportFeesDetails == '' || monthlyTransportFeesDate == '') {
        alert('Please fill int the monthly transport fees details and validity.');
        return false;
      }
    }
    if(data.examinationFees != '') {
      var examinationFeesDetails = document.getElementById('examinationFeesDetails').value;
      var examinationFeesDate = document.getElementById('examinationFeesDate').value;
      if(examinationFeesDetails == '' || examinationFeesDate == '') {
        alert('Please fill in the examination fees details and validity.');
        return false;
      }
    }
    if(data.libraryFees != '') {
      var libraryFeesDetails = document.getElementById('libraryFeesDetails').value;
      var libraryFeesDate = document.getElementById('libraryFeesDate').value;
      if(libraryFeesDetails == '' || libraryFeesDate == '') {
        alert('Please fill in the library fees details and validity.');
        return false;
      }
    }
    if(data.gameFees != '') {
      var gameFeesDetails = document.getElementById('gameFeesDetails').value;
      var gameFeesDate = document.getElementById('gameFeesDate').value;
      if(gameFeesDetails == '' || gameFeesDate == '') {
        alert('Please fill in the game fees details and vaidity.');
        return false;
      }
    }
    if(data.diary != '') {
      var diaryDetails = document.getElementById('diaryDetails').value;
      var diaryDate = document.getElementById('diaryDate').value;
      if(diaryDetails == '' || diaryDate == '') {
        alert('Please fill in the diary fees details and validity.');
        return false;
      }
    }
    if(data.mis != '') {
      var misDetails = document.getElementById('misDetails').value;
      var misDate = document.getElementById('misDate').value;
      if(misDetails == '' || misDate == '') {
        alert('Please fill in the miscellaneous fees details and validity.');
        return false;
      }
    }
    var total = document.getElementById('total').value;
    if(total == '' || total == '0') {
      alert('Please collect fee.');
      return false;
    }
    return true;
  }
</script>
<?php include('footer.php'); ?>
