<?php
   
   $server="MID22";
   $usernamedb="user_k2";
   $passworddb="k22016";
   $database="MID"; // Jun 1, 2020
   $databasePOOnline="POOnline"; // Jun 5, 2020
   $databaseMIIBPM="MII.BPM"; // Jun 9, 2020
   //$myConn=odbc_connect("Driver={SQL Server Native Client 10.0}; Server=$server; Database=$database;", $username, $password);
   $myConn = odbc_connect("Driver={SQL Server}; Server=$server; Database=$database;", $usernamedb, $passworddb);
if( $myConn ) { 
}else{
     echo "Connection could not be established.<br />";
     //die( print_r( sqlsrv_errors(), true));
}

   $myConnPO = odbc_connect("Driver={SQL Server}; Server=$server; Database=$databasePOOnline;", $usernamedb, $passworddb);
if( $myConnPO ) { 
}else{
     echo "Connection could not be established.<br />";
     //die( print_r( CI_DB_sqlsrv_errors(), true));
}
   $myConnMIIBPM = odbc_connect("Driver={SQL Server}; Server=$server; Database=$databaseMIIBPM;", $usernamedb, $passworddb);
if( $myConnMIIBPM ) { 
}else{
     echo "Connection could not be established.<br />";
     //die( print_r( sqlsrv_errors(), true));
}

   // FLEXPROCESS CONNCECTION
   //$serverFlex="MID100";
   $serverFlex="MID88";
   $usernamedbFlex="rian";
   $passworddbFlex="Itas25888";
   $databaseFlex="MandomLive"; // Aug 14, 2019
   //$databaseFlex="MIDTest_16"; // Jul 3, 2020

   // $conn=odbc_connect("Driver={SQL Server Native Client 10.0}; Server=$server; Database=$database;", $username, $password);
   $myConnFlex = odbc_connect("Driver={SQL Server}; Server=$serverFlex; Database=$databaseFlex;", $usernamedbFlex, $passworddbFlex);
if( $myConnFlex ) { 
}else{
     echo "Connection Server Flexprocess could not be established.<br />";
     //die( print_r( sqlsrv_errors(), true));
}
?>