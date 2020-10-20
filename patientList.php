<?php
require_once("connect/indexScripts.php");
if(!isset($_SESSION)){
	session_start();
}
$msg='';

if(!isset($_SESSION['psw'])) header("location:index.php");

if(isset($_POST['btnsignout'])){
	session_destroy();
	header("location:index.php");
}
if(isset($_POST['register'])){
	#$passport='';
	$name=mysql_escape_string($_POST['Name']);	
	$dob=mysql_escape_string($_POST['dob']);
	$gender=mysql_escape_string($_POST['gender']);
	$phone=mysql_escape_string($_POST['phone']);
	$type=mysql_escape_string($_POST['type']);
	$pid=mysql_escape_string($_POST['pid']);
	
	if(isset($_FILES['passport']))$passport=$_FILES['passport'];
	
	$msg=savePatient($name,$dob,$gender,$phone,$type,$pid,$passport);
}
if(isset($_POST['diag'])){
	$diagnosis=mysql_escape_string($_POST['txtdiag']);
	$treatment=mysql_escape_string($_POST['txttreatment']);
	$pid=mysql_escape_string($_POST['pid']);
	
	$msg=updateHistory($diagnosis,$treatment,$pid);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Welcome to st. Hilda's hospital managment information system</title>
<style type="text/css" media="screen">
    .selected { background-color: #888; }
</style>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/ppseducation.css" />
<script type="text/javascript" src="script/jquery-latest.pack.js"></script>
<script type="text/javascript" src="script/prototype.js"></script>
<script type="text/javascript" src="script/mine.js"></script>
<script type="text/javascript" src="script/scriptaculous.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body style="font-size:12px;">
 <?php
 
    include("link/PatientRegform.php");
	include("link/About.php");
	include("link/PatientDetails.php");
	include("link/addIll.php");
?>
<div class="container-fluid">
<div class="row-fluid">
	<div class="span12">
    <div class="navbar-form" style="height:70px; background-color:#069; color:#FFF;font-family:Algerian; text-align:center;">
    <h1>@Admin Dashboard</h1>
    
    </div>
    </div>
</div>
<div class="row-fluid">
<div class="span4"></div><div class="span4">
<h3>WHAT DO YOU WANT TO DO?</h3>
<form class="form-actions" method="post">
		<div><?php echo $msg;?></div>
         <div style="margin-top:10px;"><button type="button" onClick="Effect.toggle('searchForm','BLIND');" class="btn btn-large btn-block" name='btnsearch'>SEARCH FOR PATIENT</button></div>
          <div style="display:none;" class="form-inline" id="searchForm"><br>
          <input type="text" name="searchvalue" id="searchvalue" class="input-block-level"  placeholder="Enter patient ID"> <br><br><center><button type="button" data-target="#pDetails" data-toggle="modal" class="btn btn-danger btn-small" onClick="loadPatient();" name='getPatient'> Get patient </button> <button type="button" data-target="#addIll" data-toggle="modal" class="btn btn-success btn-small" onClick="loadIllment();" name='loadillment'>Update Diagnosis</button></center>
          </div>
         <div style="margin-top:10px;"><button type="button" data-target="#regForm" data-toggle="modal" class="btn btn-large btn-block btn-success" name='btnregister'>REGISTER NEW PATIENT</button></div>
         <div style="margin-top:10px;"><button data-target="#about" data-toggle="modal" class="btn btn-large btn-block btn-danger" name='btnsearch'>ABOUT HOSP. MGT. INFO. SYSTEM</button></div>
         <div style="margin-top:10px;"><button type="submit" class="btn btn-large btn-block btn-info" name='btnsignout'>SIGN OUT</button></div>
         
 </form>
</div><div class="span4"></div>
</div>
</div>
<div class="navbar-form" style="height:40px; background-color:#069; color:#FFF; text-align:center;">
    Copyright reserve &copy; Gabbysoft Inc. <?php echo date('Y');?>
</div>
</body>
</html>
