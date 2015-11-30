<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style type="text/css">
body{
        padding: 0px;
        margin: 0px;
        background: #EFDBC0;
}
header{
        background: #080808;
        opacity: 0.9;
        width: 100%;
        height: 100px;
        margin-right: 0px;
}

img.logo{
        position: fixed;
        width: 130px;
        height: 80px;
}

.mfp-container {
  text-align: center;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  padding: 0 8px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box; }

.mfp-container:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle; }

.mfp-align-top .mfp-container:before {
  display: none; }
</style>

<title>Gallery</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../jquery.zoomooz.min.js"></script>
</head>
<body>
<header>
	<div id="header-container">
		<img class="logo" src="images/gallery-art.jpg"><div id="name">Gallery</div>
		<ul class="second-nav">
		</ul>
	</div>
</header>
<div class="zoomViewport">
			<div id="container" class="zoomContainer">
                <div id="item1" class="zoomTarget"></div>
                <div id="item2" class="zoomTarget"></div>
                <div id="item2b" class="zoomTarget"></div>
                <div id="item3" class="zoomTarget">
                    <div id="item3b" class="zoomTarget"></div>
                </div>
                <div id="item4" class="zoomTarget"></div>
			</div>
	    </div>
	    <div id="navigation">
			<div id="prev" class="zoomButton" data-type="prev" data-root=".zoomViewport">&lt;</div>
			<div id="next" class="zoomButton" data-type="next" data-root=".zoomViewport">&gt;</div>
		</div>
<?php
session_start();
$email = $_POST["email"];

require 'vendor/autoload.php';
use Aws\Rds\RdsClient;
$client = RdsClient::factory(array(
 'version'=>'latest',
'region'  => 'us-east-1'
));

$result = $client->describeDBInstances([
   'DBInstanceIdentifier' => 'jrxdb',
]);

$endpoint = "";
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================\n";

//echo "begin database";
#$link = mysqli_connect($endpoint,"controller","letmein888","customerrecords") or die("Error " . mysqli_error($link));
$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//below line is unsafe - $email is not checked for SQL injection -- don't do this in real life or use an ORM instead
echo "\n" . $email . "gallery\n";
?>
<div id="container">
    <header>
      <h1>jQuery Wookmark Plug-in</h1>
    </header>
    <div id="main" role="main">

      <ul id="tiles">
        <!-- These are our grid blocks -->
        <!--<li><img src="images/test.jpg" width="200" height="283"><p>1</p></li>-->
<?php
$link->real_query("SELECT * FROM items WHERE email = '$email'"); 
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img src =\" " . $row['s3rawurl'] . "\" /><img src =\"" .$row['s3finishedurl'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>
        <!-- End of grid blocks -->
      </ul>
    </div>
  </div>

</body>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-16288001-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</html>
