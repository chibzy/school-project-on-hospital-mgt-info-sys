<?php
require_once("connect.php");
connectdb();

########################################################################## chosen script ###########################################
function adminLogin($adminID,$psw){
	$email=mysql_escape_string($adminID);
	$psw=mysql_escape_string($psw);
	
	$loginMsg='';	
		if($adminID!=''){
			
			if($psw!=''){
				
				#hash the password
				
				$field=array();
				$flagfields=array('username','psw');
				$flagvalues=array($adminID,$psw);
				
				$ok=mysql_query(SQLretrieve('admin',$field,$flagfields,$flagvalues));
				
				
				if($ok!=false){
					while($v=mysql_fetch_array($ok)){
						$details=$v;
					}
					if(!empty($details)){
						#set session variables
						$_SESSION['adminName']=$details['username'];
						$_SESSION['psw']=$details['psw'];
						
						header("location:patientList.php");
						#$isLogin=true;
					}else{
						$loginMsg="<div class=\"alert alert-error\">Incorrect admin info. entered</div>";
					}
				}else{
					$loginMsg="<div class=\"alert alert-error\">Invalid admin info.</div>";
				}
				
			}else{
		$loginMsg="<div class=\"alert alert-error\">Password field can't be empty </div>";
			}
		}else{
		$loginMsg="<div class=\"alert alert-error\">Admin ID can't be empty.</div>";
		}
	
	return $loginMsg;
}

function SQLretrieve($tablename,$fields,$flagfields,$flagvalues){
	#check if the flags are array
	$statement="";
	if(count($flagvalues)!=count($flagfields)){
		$err="field and value list mismatch";
		return $err;
	}else{
		if(count($flagfields)!=0){
			for($i=0;$i<count($flagfields);$i++){
				if((count($flagfields)-1)-$i!=0){
				$statement.="{$flagfields[$i]}='{$flagvalues[$i]}'  and ";
				}else{
					$statement.="{$flagfields[$i]}='{$flagvalues[$i]}'";
				}
			}
			
		}else{
			$statement="";
		}
		#spread the fields
		$spread="";
		if(count($fields)!=0){
			for($j=0;$j<count($fields);$j++){
				#if((count($flagfields)-1)-$j!=0){
				if((count($fields)-1)-$j!=0){
					$spread.="{$fields[$j]},";
				}else{
					$spread.="{$fields[$j]}";
				}
				#echo $spread." spread <br>";
			}
		}else{
			$spread="*";
		}
		
		#form the statement
		if($statement!=''){
			$sqlstatement="select $spread from $tablename where $statement";
			#echo "$sqlstatement<br>";
		}else{
			$sqlstatement="select $spread from $tablename";
			#echo "$sqlstatement<br>";
		}
		#echo $sqlstatement."<br>";
		return $sqlstatement;
	}
}
function loadPatientDetails($pid){
	$fields=array();
	$flagfields=array('patient_id');
	$flagvalue=array($pid);
	
	$ok=mysql_query(SQLretrieve('patient_info',$fields,$flagfields,$flagvalue));
	if(mysql_affected_rows()>0){
		if($val=mysql_fetch_array($ok)){
			$passport=$val['passport'];
			$name=$val['name'];
			$gender=$val['gender'];
			$type=$val['patient_type'];
			$regDate=$val['rdate'];
			$dob=$val['dob'];
			$phone=$val['phone'];
			
		}
		$illment=array();
		
		$fields=array();
		$flagfields=array('patient_id');
		$flagvalue=array($pid);
		
		$ok=mysql_query(SQLretrieve('illness_history',$fields,$flagfields,$flagvalue));
		if(mysql_affected_rows()>0){
			$i=0;
			while($val=mysql_fetch_array($ok)){
				$illment[$i]=$val;
			
			$i++;
			}
		}
		
		?>
		<div style="width:150px; float:left; margin-right:10px; border:#CCC thin solid; padding:5px;">
        <img src="<?php echo $passport;?>" width="100px" alt="patient Passport" align="left" /><div style="clear:both;"></div>
        <div><h5><?php echo $name;?></h5></div>
        <div style="background-color:#369; height:5px;"></div>
        <div><b>Patient ID:</b> <?php echo $pid;?></div>
        <div><b>Date of Birth :</b> <?php echo $dob;?></div>
        <div><b>Gender :</b> <?php echo $gender;?></div>
        <div><b>Date of Reg. :</b> <?php echo $regDate;?></div>
        <div><b>Patient type :</b> <?php echo $type;?></div>
        <div><b>Phone : </b><?php echo $phone;?></div>
        </div>
        
        <input type="hidden" value="<?php echo $pid;?>" id="pid" />
        
        <div style="border:#CCC thin solid; padding:5px; width:300px; float:right;">
        	<div><h5>Patient Medical History</h5></div>
            <div style="background-color:#369; height:5px;"></div>
           <?php for($i=0;$i<count($illment);$i++){?> 
            <div style="border-bottom:#CCC thin solid; padding-bottom:2px;">
            <?php echo $illment[$i][1];?> :  | <b><?php echo $illment[$i][2];?> </b><br /><?php echo $illment[$i][3];?> 
            <input type="hidden" value="<?php echo $illment[$i][0];?>" id="item<?php echo $i;?>" />
            <button class="btn btn-small" type="button" name="btn<?php $i;?>" onclick="removeIll('item<?php echo $i;?>')"> Remove </button>
            </div>
          <?php }?>
        </div>
		<?php

	}else{
		echo "<div class='alert alert-error'>Invalid patient ID.</div>";
	}
}
function savePatient($name,$dob,$gender,$phone,$type,$pid,$passport){
	$msg='';
	$rdate=(date('m/d/Y'));
	if($name!='' && $dob!='' && $gender!='' && $phone!='' && $type!='' && $pid!=''){
		
		$available=false;
		
		$fields=array();
		$flagfields=array('patient_id');
		$flagvalue=array($pid);
		
		$ok=mysql_query(SQLretrieve('patient_info',$fields,$flagfields,$flagvalue));

		if(mysql_affected_rows()>0) $available=true;
		
		if($available==true) $msg="<div class=\"alert alert-error\"> Patient already registered. </div>";
		
		if($available==false){
			$path=updateQImg($passport,$pid);
			$sql="insert into patient_info(name,dob,gender,patient_type,patient_id,rdate,passport,phone) values('$name','$dob','$gender','$type','$pid','$rdate','$path','$phone')";
			mysql_query($sql);
			$msg="<div class=\"alert alert-success\"> New patient successfully added </div>";
		}
	}else{
		$msg="<div class=\"alert alert-error\"> Compusory fields are empty </div>";	
	}
	return $msg;
}
function updateQImg($logo,$Qid){
global $msg;
if($logo['name']!='' && $logo['size']<=20000){
	#echo "1<br>";
	$ext=explode('.',$logo['name']);
#		if($ext[1]=='png'){
		if($logo['type']=='image/png' || $logo['type']=='image/pjpeg' || $logo['type']=='image/jpeg' ){
			#echo "2<br>";
			if($logo['tmp_name']!=''){
				#echo "3<br>";
				#check for the ../cbt/question/schlid/testid/ directory, before transfering file
				$dir="pics/";#$schlid/$testid/";
				#$newQid="$schlid-$testid-$Qid";
				$dest=$dir."$Qid.{$ext[1]}";
				
				move_uploaded_file($logo['tmp_name'],"$dest");
				return $dest;
			}
			
		}else{
			$msg='<p class="alert alert-error">The picture file format is not supported</p>';	
		}		
}else{
	$msg='<p class="alert alert-error">The selected file size is bigger than 20kb</p>';
}
	#if($msg!='') return $msg;
}
function removeIll($sn){
	if($sn!=''){
	$sql="delete from illness_history where sn=$sn";
	mysql_query($sql);
	}
}
function loadIllUpdate(){
?>
<form method="post">
        <center>
        <input type="hidden" name="pid" value="<?php echo $_SESSION['id'];?>" />
        <div class="form-group">
        <table>
          <tr><td>Diagnosis :<br />
          <textarea class="input-xlarge" placeholder="Enter diagnosis" name="txtdiag"></textarea>
          </td> 
          </tr>
          <tr><td>Treatment :
          <br />
          <textarea class="input-xlarge" placeholder="Enter diagnosis" name="txttreatment"></textarea>
          </td> 
          </tr>
         <tr>
         <td>
         <button type="submit" name="diag" class="btn btn-block btn-danger">Update history</button>
         </td>
         </tr>
          </table>
        </div>
        </center>
        </form>
<?php	
}
function updateHistory($diagnosis,$treatment,$pid){
	global $msg;
	if($diagnosis!='' && $treatment!='' && $pid!=''){
		$cdate=date('m/d/Y');
		$sql="insert into illness_history(date,diagnosis,treatment,patient_id) values('$cdate','$diagnosis','$treatment','$pid')";
		mysql_query($sql);
		$msg='<p class="alert alert-success">Patient medical history successfully updated.</p>';
	}
	return $msg;
}
?>