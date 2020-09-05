<ol class="breadcrumb">
  <li><a href="<?php echo '/markazboys/index.php/classes'; ?>">Manage Classes</a></li>
  <li><a href="<?php echo '/markazboys/index.php/classes/addNewClassForm'; ?>">Add New Class</a></li>
  <li><a href="<?php echo '/markazboys/index.php/classes/manageSections?classid='.$firstClassId; ?>">Manage Section</a></li>
  <?php
    if(isset($_GET['classid'])) {
      $classId = $_GET['classid'];
      echo '<li><a href="/markazboys/index.php/classes/addNewSectionForm?classid='.$classId.'">Add New Section</a></li>';
    }
  ?>
</ol>
