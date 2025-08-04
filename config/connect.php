<?php
$Server="localhost";
$DB_HOST = "localhost";
$DB_NAME = "root";
$DB_PASS ="";
$DB_DB = "db_eform";
$con = new mysqli($DB_HOST, $DB_NAME, $DB_PASS, $DB_DB);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

function SaveTracking($idTransaksi,$idNextTrack,$InputCatatan,$idanggotasesion,$datenow,$hostnamesession) { 
	include "conn.php";
 	mysqli_query($con,"INSERT INTO  tb_req_tracking (No_Req,TRACKING_CODE,Remark,CreatedBy,CreatedDate,CreatedHostName) 
 	Values ('$idTransaksi','$idNextTrack','$InputCatatan','$idanggotasesion','$datenow','$hostnamesession')");
} 
 
function UpdateStatusTracking($idTransaksi,$Status_Tracking) { 
	include "conn.php";
 	mysqli_query($con,"UPDATE tb_req_tracking  SET Status_Tracking='$Status_Tracking' WHERE No_Req='$idTransaksi'  ");
} 

function CekPrivilage($userdomain,$module) { 
	include "conn.php";
	$CekPrivilage=mysqli_query($con,"SELECT UserDomain,Module,Status from Tb_user_privilage WHERE
	UserDomain = '$userdomain' And Module='$module' And Status='1' ");
	if (mysqli_num_rows($CekPrivilage) !=0 ) {echo "checked";}
} 
function ShowData1($table,$fild,$where1,$value1) { 
	include "conn.php";
	$ShowData1=mysqli_query($con,"SELECT " .$fild. " FROM " .$table. " 
	WHERE " .$where1. " = '".$value1."' " );
	if (mysqli_num_rows($ShowData1) !=0 ) {
		while(@$row =mysqli_fetch_array($ShowData1)){echo $row[$fild];}}
} 

function ShowDataChecklistAppFAW($valdata,$Checklist_Code,$fawcode,$level) { 
	include "conn.php";
	$ShowDataChecklistAppFAW=mysqli_query($con,"SELECT ".$valdata." FROM tb_faw_check_app
	Where Checklist_Code='".@$Checklist_Code."' And Request_No = '".@$fawcode."' 
	And Workflow_Index_No='".@$level."' ");
	if (mysqli_num_rows($ShowDataChecklistAppFAW) !=0 ) {
		while(@$rowFAWCheck1 =mysqli_fetch_array($ShowDataChecklistAppFAW)){
			if (@$rowFAWCheck1['Result']=='1') {echo "√"; } else {echo "x";}
			}
		} 
	else {echo"-";}
}


function ShowTableDetail($table,$fild,$where1,$where2,$value1,$vaule2,$orderby) { 
	include "conn.php";
	$query="SELECT " .$fild. " FROM " .$table. " 
	WHERE " .$where1. " = '".$value1."' And " .$where2. " = '".$vaule2."'  Order BY " .$orderby. " Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		if (mysqli_num_rows($exe) >1 ) {
			while(@$row =mysqli_fetch_array($exe)){	
				echo "<table height='100%' width='100%'  rules='cols' cellpadding='0' cellspacing='0'  border='1'>
					<tr>
					<td  style='padding:2px 2px 2px 2px;font-size:14px;'>
					".$row[$fild]."
					</td>
					</tr>
					</table>";
				}
			}
		else {
				while(@$row =mysqli_fetch_array($exe)){
					echo "<table height='100%'  border='0'>
					<tr>
					<td  style='padding:2px 2px 2px 2px;font-size:14px;'>
					".$row[$fild]."
					</td>
					</tr>
					</table>";
				}
			
			}
		}else {echo "";}
}
function Showttdmpr($valdata,$ValNoReq,$Workflowmenu,$level,$index) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	WHERE Request_No = '".$ValNoReq."' And WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	And LevelProcess = '".$level."' And Approve_No = '".$index."' Group By ".$valdata."");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {
			if (!empty($row[$valdata])){   
				echo "<img width='40' height='40' src='../dist/Sign/".$row[$valdata]."'>"; 
			}
		}
	}else {echo "";}
}

function Showttd($valdata,$ValNoReq,$Workflowmenu,$index) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	WHERE Request_No = '".$ValNoReq."' And WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	And Index_No = '".$index."' Group By ".$valdata."");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {
			if (!empty($row[$valdata])){   
				echo "<img width='40' height='40' src='../dist/Sign/".$row[$valdata]."'>"; 
			}
		}
	}else {echo "";}
}

function ShowTtdNamaTglByPosisi($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.")  And Status_Approval ='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowTtdNamaTglByPosisiRequestor($ValNoReq,$Workflowmenu,$posisi,$indexno) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") AND a.Index_No IN (".$indexno.") And Status_Approval ='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowTtdNamaTglByPosisiRequestorFAW($ValNoReq,$Workflowmenu,$posisi,$indexno) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") AND a.LevelProcess IN ('".$indexno."') And Status_Approval ='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}


function ShowTtdNamaTglByPosisiRequestorStep1($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") And Status_Approval ='1'
	AND a.LevelProcess='Requestor' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

 
function ShowTtdNamaTglByPosisiDivisiFNIMDataControl($ValNoReq,$Workflowmenu,$posisi,$divisi ) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") AND d.KDDivision IN (".$divisi.") And Status_Approval ='1'  GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40'  src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowTtdNamaTglByPosisiDivisi($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") And Status_Approval ='1'  GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowTtdNamaTglByPosisiDivisiNPRF($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(Max(ApproveDate), '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") And Status_Approval ='1' And a.Index_No !='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowttdARM($ValNoReq,$Workflowmenu,$level,$index) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a 
	INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE Request_No = '".$ValNoReq."' And WorkFlowMenu = '".$Workflowmenu."' 
	And LevelProcess = '".$level."' And Index_No = '".$index."' And Status_Approval ='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.ApproveDate desc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while ($row = mysqli_fetch_array($exe)) {
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
		<tr style='font-size:10px;'>
		<td style='text-align:center;'>
		".$ttd."<br>
		".$row['Nama']."<br>
		".$row['ApproveDate']."<br>
		</td>
		</tr>
		</table>";}
	}else {echo "";}
}

function ShowttdARMF1($ValNoReq,$TRACKINGCODE,$PosisionCode) { 
	include "conn.php";
	$query="SELECT a.IDNo, a.No_Req,a.TRACKING_CODE,b.DESCR,  
	c.NIP,c.Name,c.SignIn,c.Email, d.DivisionName,e.PositionName,
	DATE_FORMAT(a.CreatedDate, '%d-%m-%Y')  CreatedDate
	FROM tb_req_tracking a INNER JOIN param_tracking b ON a.TRACKING_CODE=b.CODE
	INNER JOIN tb_user c ON a.CreatedBy=c.UserDomain
	INNER JOIN tb_division d ON c.KDDivision=d.KDDivision
	INNER JOIN tb_position e ON c.KDPosition=e.KDPosition
	WHERE a.No_Req = '".$ValNoReq."' And a.TRACKING_CODE IN (".$TRACKINGCODE.") 
	And c.KDPosition IN(".$PosisionCode.") AND a.Status_Tracking = '1'  ";
	$exe = mysqli_query($con,$query." Order BY a.IDNo");
	if (mysqli_num_rows($exe) !=0 ) {
		while ($row = mysqli_fetch_array($exe)) {
			if (!empty($row['SignIn'])) {
				$ttd="<img width='60' height='50' src='../dist/Sign/".@$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
		<tr style='font-size:11px;'>
		<td style='text-align:center;'>
		".$ttd."<br>
		".$row['Name']."<br>
		".$row['CreatedDate']."<br>
		</td>
		</tr>
		</table>";}
	}else {echo "";}
}

function ShowTtdNamaTglByPosisiDivisiPS($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT SignIn,b.Name AS Nama,DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate,a.Index_No FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") And Status_Approval ='1' And a.Index_No !='1' GROUP BY SignIn,Nama,
	a.Index_No Order BY a.Index_No Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			if (!empty($row['SignIn'])) {
				$ttd="<img width='40' height='40' src='../dist/Sign/".$row['SignIn']."'>";}
			else{
				$ttd="";}
		echo "<table width='100%'>
			<tr style='font-size:10px;'>
			<td style='text-align:center;'>
			".$ttd."<br>
			".$row['Nama']."<br>
			".$row['ApproveDate']."<br>
			</td>
			</tr>
			</table>";}
		}else {echo "";}
}

function ShowTglByPosisiDivisi($ValNoReq,$Workflowmenu,$posisi) { 
	include "conn.php";
	$query="SELECT  DATE_FORMAT(ApproveDate, '%d-%m-%Y') as
	ApproveDate FROM tb_workflownprf a INNER JOIN tb_user b 
	ON a.Approve=b.UserDomain INNER JOIN tb_position c ON b.KDPosition=c.KDPosition
	INNER JOIN tb_division d ON b.KDDivision=d.KDDivision
	WHERE a.Request_No = '".$ValNoReq."' And WorkFlowMenu ='".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' 
	AND b.KDPosition IN (".$posisi.") And Status_Approval ='1' GROUP By DATE_FORMAT(ApproveDate, '%d-%m-%Y') Asc";
	$exe = mysqli_query($con,$query);
	if (mysqli_num_rows($exe) !=0 ) {
		while(@$row =mysqli_fetch_array($exe)){
			echo $row['ApproveDate'];
		}
	}
	else {echo "";}
}

function ShowDivisiFAWApprove($valdata,$ValNoReq,$Workflowmenu,$index) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	INNER JOIN tb_division c ON b.KDDivision=c.KDDivision WHERE Request_No = '".$ValNoReq."' And 
	WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' And a.LevelProcess = '".$index."' 
	And  Status_Approval ='1'  Group By ".$valdata." ");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {    
			echo $row[$valdata]; 
		}
	}else {echo "";}
} 

function ShowDivisiFAWRevise($valdata,$ValNoReq,$Workflowmenu,$index) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	INNER JOIN tb_division c ON b.KDDivision=c.KDDivision WHERE Request_No = '".$ValNoReq."' And 
	WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' And a.LevelProcess = '".$index."' 
	And  (Status_Approval ='1' or Approve is not null) Group By ".$valdata." ");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {    
			echo $row[$valdata]; 
		}
	}else {echo "";}
} 


function Shownamettd($valdata,$ValNoReq,$Workflowmenu,$index) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	INNER JOIN tb_division c ON b.KDDivision=c.KDDivision WHERE Request_No = '".$ValNoReq."' And 
	WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' And Index_No = '".$index."' 
	And Status_Approval ='1'  Group By ".$valdata." ");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {    
			echo $row[$valdata]; 
		}
	}else {echo "";}
} 

function ShowtglDevMPR($valdata,$ValNoReq,$Workflowmenu,$LevelPRocess) { 
	include "conn.php";
	$Showttd=mysqli_query($con,"SELECT ".$valdata." FROM tb_workflownprf a INNER JOIN tb_user  b ON a.Approve=b.UserDomain
	INNER JOIN tb_division c ON b.KDDivision=c.KDDivision WHERE Request_No = '".$ValNoReq."' And 
	WorkFlowMenu = '".$Workflowmenu."' And WorkFlowMenu = '".$Workflowmenu."' And LevelProcess = '".$LevelPRocess."' Limit 1");
	if (mysqli_num_rows($Showttd) !=0 ) {
		while ($row = mysqli_fetch_array($Showttd)) {    
			echo $row[$valdata]; 
		}
	}else {echo "";}
} 


function updatefile($tbl,$fild,$criteria,$fildWhere,$criteriaWhere) { 
	include "conn.php";
	$updatefile=mysqli_query($con,"UPDATE ".$tbl." SET ".$fild." = '".$criteria."' WHERE ".$fildWhere." = '".$criteriaWhere."'  ");
}

function LogInfo($date,$desc,$crete,$host) { 
	include "conn.php";
	mysqli_query($con,"INSERT tb_loginfo (Date,Description,CreatedBy,CreatedHostName) VALUES ('".$date."','".$desc."','".$crete."','".$host."')");
}
function showprivilage($usernm,$module,$value) { 	
	include "conn.php";
	$showprivilage=mysqli_query($con,"SELECT UserDomain,Module,Status from Tb_user_privilage where UserDomain = '$usernm' And Module='$module' And Status='1' ");
	if (mysqli_num_rows($showprivilage) !=0 ) {echo "$value";} else {echo "";}
} 
function caridata1($tbl,$fild1,$fild2,$criteria) { 
	include "conn.php";
	$caridata1=mysqli_query($con,"SELECT ".$fild2." FROM ".$tbl." Where ".$fild1." = '".$criteria."' ");
	if (mysqli_num_rows($caridata1) !=0 ) {
	while ($row = mysqli_fetch_array($caridata1)) {    
		echo $row[$fild2];}
	}
} 
function caridata2($tbl,$filddata,$fild1,$criteria1,$fild2,$criteria2) { 
	include "conn.php";
	$caridata2=mysqli_query($con,"SELECT ".$filddata." FROM ".$tbl." 
	Where ".$fild1." = '".$criteria1."' And ".$fild2." = '".$criteria2."' ");
	if (mysqli_num_rows($caridata2) !=0 ) {
	while ($row = mysqli_fetch_array($caridata2)) {    
		echo $row[$filddata];}
	}
} 
function cekdata1($nm_tb,$nm_fild,$kriteria) {
	include "conn.php"; 
	$caridata=mysqli_query($con,"SELECT ".$nm_fild." from ".$nm_tb." where ".$nm_fild." = '".$kriteria."' ");
	$caridata = mysqli_num_rows($caridata); 
	return $caridata;
}
function FormatText($text){
// membaca input dari form
$input = $text;
// memecah string input berdasarkan karakter '\r\n\r\n'
$pecah = explode("\r\n\r\n", $input);
// string kosong inisialisasi
$text = "";
// untuk setiap substring hasil pecahan, sisipkan <p> di awal dan </p> di akhir
// lalu menggabungnya menjadi satu string utuh $text
for ($i=0; $i<=count($pecah)-1; $i++)
{
   $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
   $text .= $part;
}
// menampilkan outputnya
echo $text;
}

function MPRDisable($FildNo,$FildProces,$Index_Process){
if ($FildNo=='1' And $FildProces==$Index_Process ) {echo "";} else {echo "disabled='disabled'";}
}

function ARMPurDisable($FildNo,$FildProces,$Index_Process,$FildDivisi){
	if (($FildNo=='1' And $FildProces==$Index_Process And $FildProces=="P001") || $FildDivisi=="P001") {echo "";} else {echo "disabled='disabled'";}
	}
function ARMProdDisable($FildNo,$FildProces,$Index_Process,$FildDivisi){
	if (($FildNo=='2' ||$FildNo=='1' And $FildProces==$Index_Process And $FildProces=="19FOKG11") || $FildDivisi=="19FOKG11") {echo "";} else {echo "disabled='disabled'";}
	}
	

function formatMoney($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0,00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0),",", "."); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2),",", "."); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney






?>