<html>
<head><title>Gallery</title>
</head>
<body>

<?php
session_start();
$email = $_POST["email"];
echo $email;
require 'vendor/autoload.php';
use Aws\Rds\RdsClient;
$client = RdsClient::factory(array(
 'version'=>'latest',
'region'  => 'us-west-2'
));

#$result = $client->describeDBInstances(array(
#    'DBInstanceIdentifier' => 'jrx-db',
#));
#$endpoint = "";
#foreach ($result->getPath('DBInstances/*/Endpoint/Address') as $ep) {
    // Do something with the message
#    echo "============". $ep . "================";
#    $endpoint = $ep;
#}   
#print_r($result);
#$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
#    echo "============\n". $endpoint . "================";

#print_r($endpoint);  
//echo "begin database";
#$link = mysqli_connect($endpoint,"controller","letmein888","customerrecords") or die("Error " . mysqli_error($link));
$link = mysqli_connect("jrx-db.cwom1zatgb1y.us-west-2.rds.amazonaws.com","rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));
#$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//below line is unsafe - $email is not checked for SQL injection -- don't do this in real life or use an ORM instead
$link->real_query("SELECT * FROM mp1tb WHERE email = '$email'");
//$link->real_query("SELECT * FROM items");
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img src =\" " . $row['s3rawurl'] . "\" /><img src =\"" .$row['s3finishedurl'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>
</body>
</html>
