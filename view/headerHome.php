<!DOCTYPE html>
<html>
<head>
  <title>Markaz Boys</title>

  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/bootstrap/css/bootstrap.min.css">
  <!-- boostrap theme -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/bootstrap/css/bootstrap-theme.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/datatables/media/css/jquery.dataTables.min.css">
  <!-- fileinput css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/fileinput/css/fileinput.min.css">
  <!-- fullcalendar css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/fullcalendar/fullcalendar.min.css">
  <!-- keith calendar css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/assets/keith-calendar/jquery.calendars.picker.css">

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="/markazboys/custom/css/custom.css">

  <!-- jquery -->
  <script type="text/javascript" src="/markazboys/assets/jquery/jquery.min.js"></script>

  <style>
    #logout {
      border-style: solid;
      border-width: 2px;
      border-color: rgba(255,255,255,0.6);
      padding: 1em 3em;
    }

    #logout:hover {
      background-color: rgba(10,10,10,.6);
      border-width: 0px;
    }
  </style>

</head>
<body style="background-color: rgba(10,10,10,0.9);">


<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo '/markazboys/index.php/login/home' ?>">MARKAZ BOYS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id="topNavDashboard"><a href="<?php echo '/markazboys/index.php/sessions' ?>"> <i class="glyphicon glyphicon-dashboard"></i> Sessions <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Class</a></li> -->
        <li id="topNavDashboard">
          <a href="<?php echo '/markazboys/index.php/classes'; ?>"> <i class="glyphicon glyphicon-edit"></i> Classes <sapn class="sr-only">(current)</span></a>
        </li>

        <li id="topNavDashboard">
          <a href="<?php echo '/markazboys/index.php/students'; ?>"> <i class="glyphicon glyphicon-list-alt"></i> Students <sapn class="sr-only">(current)</span></a>
        </li>

        <li id="topNavDashboard">
          <a href="<?php echo '/markazboys/index.php/employee'; ?>"> <i class="glyphicon glyphicon-briefcase"></i> Employee <sapn class="sr-only">(current)</span></a>
        </li>

        <li id="topNavDashboard">
          <a href="<?php echo '/markazboys/index.php/accounting'; ?>"> <i class="glyphicon glyphicon-indent-left"></i> Accounting <sapn class="sr-only">(current)</span></a>
        </li>






      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo '/markazboys/index.php/login/settings'; ?>">Settings</a></li>
            <li><a href="<?php echo '/markazboys/index.php/login/logout'; ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
