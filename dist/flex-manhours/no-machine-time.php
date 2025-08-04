<?php 
include "../config/connect_sql.php";
$showprivilage=mysqli_query($con,"SELECT * from Tb_user_privilage where UserDomain = '$username' 
And Module='no-machine-time' And Status='1' ");
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
        <title>No Machine Time - E-Fomr</title>
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
      <h3 class="mt-4">No Machine Time</h3>
	    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../dist/index.php?button=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">No Machine Time [ <?php echo "Server : ".$serverFlex." Database : ".$databaseFlex; ?> ]</li>
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
				  <th>Schedule No</th> 
                  <th>Result</th>
				  <th>Machine</th>
				  <th>Work Ceter</th>
				  <th>Fiscal Date</th>
				  <th>Sched Status</th>
				  <th>PPR</th> 
                  <th>UserID</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
				  <th>No</th>
				  <th>Schedule No</th> 
                  <th>Result</th>
				  <th>Machine</th>
				  <th>Work Ceter</th>
				  <th>Fiscal Date</th>
				  <th>Sched Status</th>
				  <th>PPR</th> 
                  <th>UserID</th>
                </tr>
              </tfoot>
              <tbody>
 			  <?php	$query = "SELECT  
ScheduleNo,
CASE WHEN SUM(RescType) = 2 THEN 'No Consumption'
  WHEN SUM(RescType) = 1 THEN 'No Production'
  WHEN SUM(RescType) = 4 THEN 'No Consumption And No Production(Machin Only)'
  WHEN SUM(RescType) = 3 THEN 'No Machine Time'
  WHEN SUM(RescType) = 5 THEN 'No Production (Consumption + Machin)'
  WHEN SUM(RescType) = 6 THEN 'No Consumption (Production + Machin)'
  WHEN SUM(RescType) = 7 THEN 'ALLActivityExists'
END Result,
--SUM(Qty) AS Qty,
MAX(Machine) AS Machine,
MAX(WorkCneter) AS WorkCneter,
convert(varchar,MAX(Fiscaldate),111) AS Fiscaldate,
CASE WHEN MAX(SchedStatus) = 3 then 'Complete' END AS SchedStatus,
MAX(PPR) AS PPR,
MAX(UserID) AS UserID
FROM
(
SELECT
     ScheduleNo,
     CASE WHEN SUM(Qty) = 0 THEN 0 ELSE RescType END AS RescType,
     SUM(Qty) AS Qty,
     MAX(Machine) AS Machine,
     MAX(WorkCenter) AS WorkCneter,
     MAX(Fiscaldate) AS Fiscaldate,
     MAX(SchedStatus) AS SchedStatus,
     MAX(PPR) AS PPR,
     MAX(UserID) AS UserID
 FROM
     (
         SELECT
             SAL.Fiscaldate,
               CONVERT(Decimal(21,6),SAL.PrimQty) AS Qty,
             SAL.WorkCtr            AS WorkCenter,
             SAL.SchedSchedNum      AS ScheduleNo,
             CASE
                 WHEN SAL.ActyType in (2,5) THEN
                     2
                 WHEN RESC.ResourceType = 2 AND SAL.Resc = ST.StgCnstrt THEN
                     4
                 WHEN RESC.ResourceType = 2 THEN
                     0
				 WHEN SAL.ActyType in (1,4) THEN
                     1
                 
                 ELSE
                     0
             END                    AS RescType,
             SD.SchedStatus,
             SD.PPR,
             US.UserID,
             ST.StgCnstrt AS Machine
         FROM
             saSchedActy SA
             INNER JOIN
                 saSchedLineItem SAL
             ON SAL.ParentObjectID = SA.ObjectID 
             AND SAL.ParentClassID = 10452 
             AND SAL.CollectionID = 1
             INNER JOIN fdUser US 
             ON US.ObjectID = SA.LastEditorObjectID
             INNER JOIN
                   smSchedule SD
             ON  SD.ScheduleInstType = 0
             AND SD.ScheduleSite = SAL.SchedSite
             AND SD.SchedulePM = SAL.SchedPM
             AND SD.ScheduleSchedNum = SAL.SchedSchedNum
             AND SD.ScheduleRlsNum = SAL.SchedRlsNum
             INNER JOIN
                 smStage ST
             ON  ST.ParentObjectID = SD.ObjectID
             AND ST.ParentClassID  = 10460
             AND ST.CollectionID   = 1
             INNER JOIN
                 fdBasResc RESC
             ON  RESC.ObjectID = SAL.RescObjectID
         WHERE
        SAL.Updatedate    >=  convert(datetime,'".$CariDate."')
		 	AND SAL.Updatedate    >=  CONVERT(DATETIME,LEFT(CONVERT(VARCHAR, DATEADD(MONTH, -1, GETDATE()), 112), 6)+'01')
         AND SAL.Fiscaldate    >=  convert(DATETIME,'".$CariDate."')
		 	AND SAL.Fiscaldate    >=  CONVERT(DATETIME,LEFT(CONVERT(VARCHAR, DATEADD(MONTH, -1, GETDATE()), 112), 6)+'01')
         AND SAL.Update_Status =  1
         AND SAL.Errors        =  0
         AND SD.SchedStatus    =  3
         AND SD.Scheduleschednum not like 'F1-MX1901%'
         AND SD.Scheduleschednum not like 'F1-FU1901%'
         AND SD.Scheduleschednum not like 'F1-PK1901%'
         AND SD.Scheduleschednum not like 'F2-IN1901%'
		 --AND SD.Scheduleschednum = 'C-IN18093200'
		 	AND SD.PPR not like 'MC%'
         AND (
                 RESC.ResourceType = 0
             OR  (
                     RESC.ResourceType =  1
                 AND RESC.PrimUM       <> 'HR'
                 )
             OR  (
                     RESC.ResourceType = 2
                 AND SAL.Resc IN (
                     ST.StgCnstrt)
                  )
             )
     ) AS SUB_BLACK

 GROUP BY
     ScheduleNo,
     RescType
) SUB2
GROUP BY ScheduleNo
HAVING SUM(RescType) <> 7
    AND SUM(Qty) <> 0
    AND MAX(WorkCneter) NOT LIKE 'V%'
    AND MAX(Machine) not in (SELECT KEY1  FROM DMGeneralPurpose where  DataType = '82' and NUMKEY1 = 1)
 ORDER BY ScheduleNo";
			//$exe = odbc_exec($myConnFlex,$query);
			$exe = sqlsrv_query ($myConnFlex,$query);
		
			$no = 1;
			//while(@$row =odbc_fetch_array($exe)){
			while(@$row =sqlsrv_fetch_array($exe)){
			?>
			  <tr> 
				<td><?php echo $no;?></td>
				<td><?php echo $row['ScheduleNo'];?></td>
				<td><?php echo $row['Result'];?></td>
				<td><?php echo $row['Machine'];?></td>
				<td><?php echo $row['WorkCneter'];?></td>
				<td><?php echo $row['Fiscaldate'];?></td>
				<td><?php echo $row['SchedStatus'];?></td>
				<td><?php echo $row['PPR'];?></td>
				<td><?php echo $row['UserID'];?></td>
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
	<script language="JavaScript" type="text/javascript">
	function checkDelete(){
		return confirm('Are you sure you want to delete this data?');
	}
	</script>
    </body>
</html>
<?php };?>