<div class="col-sm-9">
  <div class="panel panel-info">
    <div class="panel-heading">Upload Photo</div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-3">
          <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input type="file" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
            </div>
            <div class="form-group">
              <select name="photoId" class="form-control">
                <option>Student</option>
                <option>Mother</option>
                <option>Father</option>
              </select>
            </div>
            <div class="form-group">
              <a href="/markazboys/index.php/students" class="btn btn-default">Cancel</a>
              <input type="submit" name="upload" value="Upload" class="btn btn-danger">
            </div>
          </form>
        </div>
        <div class="col-sm-9">
          <div class="text-center">
            <img src="" id="output" class="img-thumbnail" style="visibility: hidden;" width="40%">
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4">
          <div class="thumbnail">
            <a href="<?php echo $studentImg; ?>" target="_blank">
              <img src="<?php echo $studentImg; ?>" style="width:80%">
              <div class="caption text-center">
                <p><?php echo $studentName; ?></p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <a href="<?php echo $fatherImg; ?>" target="_blank">
              <img src="<?php echo $fatherImg; ?>" style="width:80%">
              <div class="caption text-center">
                <p><?php echo $fatherName; ?><p>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <a href="<?php echo $motherImg; ?>" target="_blank">
              <img src="<?php echo $motherImg; ?>" style="width:80%">
              <div class="caption text-center">
                <p><?php echo $motherName; ?></p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  loadFile = function(event){
    var reader = new FileReader();
    reader.onload = function(){
      var output=document.getElementById("output");
      output.src = reader.result;
      output.style.visibility = '';
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
<?php include('footer.php'); ?>
