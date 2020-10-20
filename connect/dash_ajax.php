<?php
require_once("indexscripts.php");
if(!isset($_SESSION)){
	session_start();
}

$fxn=$_REQUEST["fxn"];

if($fxn=='loadPatient'){#use function in script file specified for  inside account files
	$id="";
	
	if(isset($_REQUEST['pid']))$id=$_REQUEST['pid'];
	$_SESSION['id']=$id;
	
	loadPatientDetails($id);
	
}
if($fxn=='removeIll'){
	//$id="";
	$sn='';
	if(isset($_REQUEST['sn']))$sn=$_REQUEST['sn'];

	removeIll($sn);
	loadPatientDetails($_SESSION['id']);
}
if($fxn=='loadIllment'){
	$id="";
	
	if(isset($_REQUEST['pid']))$id=$_REQUEST['pid'];
	$_SESSION['id']=$id;
	loadIllUpdate();
}
?>