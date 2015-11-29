<?php
session_start();
require 'vendor/autoload.php';

$rds = new Aws\Rds\RdsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);

$result = $rds->describeDBInstances([
   'DBInstanceIdentifier' => 'jrxdb',
]);

$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================";
    
$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

    
   $dbhost = '$endpoint:3306';
   $dbuser = 'rjing';
   $dbpass = 'mypoorphp';
   
   $conn = mysql_connect($endpoint,'rjing', 'mypoorphp',"itmo544mp1")or die ('Error connecting to mysql');
   
   $dbname = 'itmo544mp1';
   mysql_select_db('$dbname');
   
   $table_name = "items";
   $backup_file  = "/tmp/jingruoxi.sql";
   $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
   $result = mysql_query($query);
   
   mysql_close($conn);
?>