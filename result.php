<?php
// Start the session
session_start();
if(!isset($_SESSION['finish'])){
	$_SESSION['finish'] = 'ELB';
	session_write_close();
	header('Location: '.$_SERVER['PHP_SELF']);
}
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
$useremail = $_POST["useremail"];
echo $useremail;
$uploaddir = '/tmp/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$client = S3Client::factory(array(
'version' =>'latest',
'region'  => 'us-east-1'
));


$bucket = uniqid("php-jrx-",false);
$result = $client->createBucket(array(
    'Bucket' => $bucket
));
$client->waitUntil('BucketExists', array('Bucket' => $bucket));
$key = $uploadfile;
#$result = $client->describeDBInstances(array(
#    'DBInstanceIdentifier' => 'jrxdb',
#));
$result = $client->putObject(array(
    'ACL' => 'public-read',
    'Bucket' => $bucket,
    'Key' => $key,
    'SourceFile' => $uploadfile 
));

$url = $result['ObjectURL'];
echo $url;

// Max vert or horiz resolution
$maxsize=550;
// create new Imagick object
$image = new Imagick('../images/test.jpg');
// Resizes to whichever is larger, width or height
if($image->getImageHeight() <= $image->getImageWidth())
{
// Resize image using the lanczos resampling algorithm based on width
$image->resizeImage($maxsize,0,Imagick::FILTER_LANCZOS,1);
}
else
{
// Resize image using the lanczos resampling algorithm based on height
$image->resizeImage(0,$maxsize,Imagick::FILTER_LANCZOS,1);
}
// Set to use jpeg compression
$image->setImageCompression(Imagick::COMPRESSION_JPEG);
// Set compression level (1 lowest quality, 100 highest quality)
$image->setImageCompressionQuality(75);
// Strip out unneeded meta data
$image->stripImage();
// Writes resultant image to output directory
$image->writeImage('../images/testwrite.jpg');
// Destroys Imagick object, freeing allocated resources in the process
$image->destroy();

$bucket = uniqid("php-jrx-finished-",false);
$result = $client->createBucket(array(
    'Bucket' => $bucket
));
$client->waitUntil('BucketExists', array('Bucket' => $bucket));
$key = $uploadfile;
#$result = $client->describeDBInstances(array(
#    'DBInstanceIdentifier' => 'jrxdb',
#));
$result = $client->putObject(array(
    'ACL' => 'public-read',
    'Bucket' => $bucket,
    'Key' => $key,
    'SourceFile' => $uploadfile 
));
$finishedurl = $result['ObjectURL'];
echo $finishedurl;

use Aws\Rds\RdsClient;
$client = RdsClient::factory(array(
'version'=>'latest',
'region'=> 'us-east-1'
));

$result = $client->describeDBInstances(array(
    'DBInstanceIdentifier' => 'jrxdb',
));

$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================";
    
//echo "begin database";
#$link = mysqli_connect($endpoint,"controller","letmein888","customerrecords") or die("Error " . mysqli_error($link));
$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/* Prepared statement, stage 1: prepare */
if (!($stmt = $link->prepare("INSERT INTO items (id, email,phone,filename,s3rawurl,s3finishedurl,status,issubscribed) VALUES (NULL,?,?,?,?,?,?,?)"))) {
    echo "Prepare failed: (" . $link->errno . ") " . $link->error;
}
$email = $_POST['useremail'];
$phone = $_POST['phone'];
$s3rawurl = $url; 
$filename = basename($_FILES['userfile']['name']);
$s3finishedurl = $finishedurl;
$status =0;
$issubscribed=0;
$stmt->bind_param("sssssii",$email,$phone,$filename,$s3rawurl,$s3finishedurl,$status,$issubscribed);
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
printf("%d Row inserted.\n", $stmt->affected_rows);
/* explicit close recommended */
$stmt->close();
$link->real_query("SELECT * FROM items");
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo $row['id'] . " " .$row['email']. " " .$row['phone'];
}
$link->close();
//add code to detect if subscribed to SNS topic 
//if not subscribed then subscribe the user and UPDATE the column in the database with a new value 0 to 1 so that then each time you don't have to resubscribe them
// add code to generate SQS Message with a value of the ID returned from the most recent inserted piece of work
//  Add code to update database to UPDATE status column to 1 (in progress)
?>