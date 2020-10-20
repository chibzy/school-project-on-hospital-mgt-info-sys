// JavaScript Document
////////////////////////////////////////////////////
function loadPatient(){
	var id=document.getElementById('searchvalue').value;
	if(id!=''){
	var bals=new Ajax.Updater('patient','connect/dash_ajax.php?fxn=loadPatient&pid='+id, {method:'post',parameters:''});
	}
}
function loadIllment(){
	var id=document.getElementById('searchvalue').value;
	if(id!=''){
	var bals=new Ajax.Updater('ill','connect/dash_ajax.php?fxn=loadIllment&pid='+id, {method:'post',parameters:''});
	}
}
function removeIll(sn){
	
	var sn=document.getElementById(sn).value;
	
	//var id=document.getElementById('pid').value;
	
	//alert(id+' - '+sn);
	if(sn!=''){
	var on=confirm('Your removing a record, do you want to continue?');
	if(on==true){
		var bals=new Ajax.Updater('patient','connect/dash_ajax.php?fxn=removeIll&sn='+sn, {method:'post',parameters:''});
	}
	}
}