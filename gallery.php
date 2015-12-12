<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<style type="text/css">
body{
	margin:0px;
    font-family: 'Poiret One', cursive;
    background-color: #E4F7FF;
}

header{
	position: relative;
        background-image: linear-gradient(90deg, #063053, #FFFFFF);
        opacity: 0.7;
        width: 100%;
        height: 80px;
}

img.logo{
        position: absolute;
        width: 130px;
        height: 80px;
}

#prev, #next {
    position:absolute;
    width:50px;
    height:50px;
    border:1px solid #aaa;
    background-color:#dca;
    color:white;
    z-index:10;
    font-size:40px;
    line-height:45px;
    text-align:center;
    font-family:Helvetica, sans-serif;
    cursor:pointer;
    cursor:hand;
}

#prev:hover,#next:hover {
	background-color:#ba9;
	border: 1px solid #999;
}

#navigation {
	width:800px;
	position:relative;
	margin-top:2em;
	margin-left:auto;
	margin-right:auto;
	height:70px;
}

#prev {
    left:0px;
}

#next {
	right:0px;
}

.zoomContainer {
	margin:0;
    padding:0;
    width:800px;
    height:600px;
    position:relative;
}

.zoomTarget {
    width:300px;
    height:300px;
    position:absolute;
}

.zoomViewport {
	margin:0;
    padding:0;
    width:800px;
	height:600px;
	border:1px solid #ccc;
	background-color: white;
	overflow:hidden;
	margin-left:auto;
	margin-right:auto;
	margin-top:1em;
}

h3 {
	font-family: Helvetica Neue, Helvetica, sans-serif;
	display:block;
	width:800px;
	margin-left:auto;
	margin-right:auto;
	margin-top:5%;
	color:#444;
}

div {
    -webkit-tap-highlight-color:rgba(0,0,0,0);
}

#item1 {
	background-color:#fcc;
	position:absolute;
	left:50px;
	top:50px;
	width:250px;
	height:250px;
	border:1px solid red;
}

#item2 {
	background-color:#ccf;
	position:absolute;
	bottom:40px;
	right:40px;
	width:250px;
	height:200px;
	border:1px solid blue;
}

#item3 {
	background-color:#cfc;
	position:absolute;
	top:0px;
	right:100px;
	width:250px;
	height:200px;
	border:1px solid green;
	-webkit-transform: rotate(10deg) translate(0px,0px);
	-moz-transform: rotate(10deg) translate(0px,0px);
	-o-transform: rotate(10deg) translate(0px,0px);
}

#item3b {
	background-color:#cff;
	position:absolute;
	top:0px;
	left:0px;
	width:200px;
	height:100px;
	border:1px solid cyan;
	-webkit-transform: rotate(10deg) translate(200px,200px);
	-moz-transform: rotate(10deg) translate(200px,200px);
	-o-transform: rotate(10deg) translate(200px,200px);
}

#item2b {
	background-color:#99f;
	position:absolute;
	bottom:80px;
	right:80px;
	width:100px;
	height:100px;
	border:1px solid blue;
}

#item4 {
	background-color:#ffc;
	position:absolute;
	bottom:200px;
	left:200px;
	width:50px;
	height:50px;
	border:1px solid yellow;
	-webkit-transform: rotate(30deg) skew(20deg);
	-moz-transform: rotate(30deg) skew(20deg);
	-o-transform: rotate(30deg) skew(20deg);
}
</style>

<title>Gallery</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../jquery.zoomooz.min.js"></script>
</head>
<body>
<header>
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

$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

echo "\n" . $email . "gallery\n";
$link->real_query("SELECT * FROM items WHERE email = '$email'"); 
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img id=\"item5\" src =\" " . $row['s3rawurl'] . "\" /><img src =\"" .$row['s3finishedurl'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>
<!--	<div id="header-container">
		<img class="logo" src="images/gallery-art.jpg"><div id="name">Gallery</div>
		<ul class="second-nav">
		</ul>
	</div>
</header>
<div class="zoomViewport">
			<div id="container" class="zoomContainer">
                <div id="item1">
                <?php 
#                while ($row = $res->fetch_assoc()) {
#                echo "<img class=\"zoomTarget\" src =\" " . $row['s3rawurl'] . "\" />";
#                echo $row['id'] . "Email: " . $row['email'];
                ?>
                </div>
                <div id="item2" class="zoomTarget"></div>
                <div id="item2b" class="zoomTarget"></div>
                <div id="item3" class="zoomTarget">
                    <div id="item3b" class="zoomTarget"></div>
                </div>
                <div id="item4" class="zoomTarget"><img src="test.jpg" style="width: 50px; height: 50px;"></div>
			</div>
	    </div>
	    <div id="navigation">
			<div id="prev" class="zoomButton" data-type="prev" data-root=".zoomViewport">&lt;</div>
			<div id="next" class="zoomButton" data-type="next" data-root=".zoomViewport">&gt;</div>
		</div>
<div id="container">
    <header>
      <h1>Pictures</h1>
    </header>
    <div id="main" role="main">

      <ul id="tiles">
      
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
} catch(err) {}
</script>
-->
</body>
</html>