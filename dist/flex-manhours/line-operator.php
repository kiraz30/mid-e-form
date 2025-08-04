<?php 
include "../config/connect_sql.php";
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='line-operator' And Status='1' ");
if (mysqli_num_rows($showprivilage) ==0 ) {
	include "401.html";	}
else{
	?>
<?php 
if ($CariDate==""){$CariDate=date("Y-m-01");}
else {$CariDate=$CariDate;}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ManHours - E-Fomr</title>
        <link href="../css/styles.css" rel="stylesheet" />
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	
		<!-- Custom CSS -->
		<link href="../css/sb-admin-2.css" rel="stylesheet">
	
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
	
	<style> 
input[type=text] {
  width: 20%;
  height: 30px;
  padding: 10px 10px;
  margin: 2px 2px 2px 2px;
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: lightblue;
}
</style>

	<main> 
    <div class="container-fluid"> 
      <h3 class="mt-4">Line Operator</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Line Operator [ <?php echo "Server : ".$serverFlex." Database : ".$databaseFlex; ?> ]</li>
      </ol>
      <div class="card mb-4">
	  <form action=""  method="post" >
   		<div class="card-header">Filter : 
		<input type="date" name="CariDate" id="CariDate"  
		value="<?php  echo $CariDate; ?>" style="height:27px; padding-top:1px"/>
		<button type="submit" name="Refresh" value="Refresh" class="btn btn-primary">Search Filter</button> </div>
        <div class="card-body"> 
           <div class="table-responsive"> 
		  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
				  <th>No</th>
				  <th>Date</th> 
                  <th>Schedule No</th>
				  <th>Resource</th>
				  <th>Description</th>
				  <th>Machine</th>
				  <th>SchedResc</th>
				  <th>Line Operator</th> 
				  <th>UM</th> 
                  <th>UserID</th>
				  <th>ActQuantity</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th>
				  <th>Date</th> 
                  <th>Schedule No</th>
				  <th>Resource</th>
				  <th>Description</th>
				  <th>Machine</th>
				  <th>SchedResc</th>
				  <th>Line Operator</th> 
				  <th>UM</th> 
                  <th>UserID</th>
				  <th>ActQuantity</th>
                </tr>
              </tfoot>
              <tbody>
 			  <?php	$query = "SELECT  min(T2.StCalDate) as StCalDate, T2.ScheduleSchedNum as ScheduleNo, T2.PPR as Resource, min(T4.Description) as Description, T3.StgCnstrt as Machine,
 T1.Resc as SchedResc,  sum(isnull(T1.PrimQty,0)) as LineOperator, min(T1.PrimQtyUM) as UM, max(T1.UserID) as UserID
 ,sum(S2.ActRnMfg) as ActQuantity 
 FROM smSchedule T2
 INNER JOIN smStage S1 ON S1.ParentObjectID = T2.ObjectID AND S1.ParentClassID = 10460 AND S1.CollectionID = 1
 INNER JOIN smResc S2 ON S2.ParentObjectID = S1.ObjectID AND S2.ParentClassID = 10459 AND S2.CollectionID = 0
 left outer JOIN (select TT1.SchedObjectID, TT1.FiscalDate, TT1.Resc, TT1.PrimQty, TT1.PrimQtyUM, TT2.UserID 
 FROM saSchedActy TT0
 INNER JOIN fdUser TT2 ON TT2.ObjectID = TT0.LastEditorObjectID
 INNER JOIN saSchedLineItem TT1 ON TT1.ParentObjectID = TT0.ObjectID AND TT1.ParentClassID = 10452 AND TT1.CollectionID = 1
        where TT1.Resc in ('FA2_LINE_OPERATOR', 'FA1_MK_OPERATOR', 'FA1_PK_LINE_OPERATOR')) T1 ON T2.ObjectID = T1.SchedObjectID
 left outer JOIN smStage T3 ON T3.ParentObjectID = T2.ObjectID AND T3.ParentClassID = 10460 AND T3.CollectionID = 1
 left outer JOIN fdBasResc T4 ON T4.ObjectID = T2.PPRObjectID
where T2.SchedStatus = 3 and T2.StCalDate >= '".$CariDate."' and T2.ActStCalDt is not null 
and (T2.StCalDate >= '".$CariDate."' or (T2.PPR not like 'MC%'  ))
and T3.StgCnstrt not like 'V%'
and T3.StgCnstrt not in (SELECT    KEY1  FROM DMGeneralPurpose where  DataType = '82' and (NUMKEY1 = 1 or NUMKEY1 = 3))
and T2.ScheduleSchedNum not in (
'C-PT19010061',
'C-PT19010063',
'C-PT19010064',
'C-PT19010065',
'C-PT19010066',
'C-PT19010067',
'C-PT19010069',
'C-PT19010095',
'C-PT19010093',
'C-PT19010159',
'C-PT19010189',
'C-PT19010190',
'C-PT19010191'
)
group by T2.ScheduleSchedNum, T2.PPR, T3.StgCnstrt, T1.Resc
having sum(isnull(T1.PrimQty,0)) = 0 and sum(S2.ActRnMfg) > 0
order by 1";
//or (T2.PPR not like 'MB%' and T2.PPR not like 'MC%' and T2.PPR not like 'MR%'))
			//$exe = odbc_exec($myConnFlex,$query);
			$exe = sqlsrv_query ($myConnFlex,$query);
		
			$no = 1;
			//while(@$row =odbc_fetch_array($exe)){
			while(@$row =sqlsrv_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo date_format($row['StCalDate'], 'Y-m-d');?></td>
				<td><?php echo $row['ScheduleNo'];?></td>
				<td><?php echo $row['Resource'];?></td>
				<td><?php echo $row['Description'];?></td>
				<td><?php echo $row['Machine'];?></td>
				<td><?php echo $row['SchedResc'];?></td>
				<td><?php echo $row['LineOperator'];?></td>
				<td><?php echo $row['UM'];?></td>
				<td><?php echo $row['UserID'];?></td>
				<td><?php echo $row['ActQuantity'];?></td>

			  </tr>
			  <?php $no++;} ?>

              </tbody>
            </table>
		</div>
        </div>
      </div>
	  </form>
	 </div>
    </main> 
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
     </body>
</html>
<?php };?>