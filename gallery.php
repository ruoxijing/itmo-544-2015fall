<html>
<head>
<style type="text/css">
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
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>jQuery Wookmark Plug-in Example</title>
  <meta name="description" content="An very basic example of how to use the Wookmark jQuery plug-in.">
  <meta name="author" content="Christoph Ono, Sebastian Helzle">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS Reset -->
  <link rel="stylesheet" href="../css/reset.css">

  <!-- Global CSS for the page and tiles -->
  <link rel="stylesheet" href="../css/main.css">

</head>
<body>

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
    echo "============\n". $endpoint . "================";

//echo "begin database";
#$link = mysqli_connect($endpoint,"controller","letmein888","customerrecords") or die("Error " . mysqli_error($link));
$link = mysqli_connect($endpoint,"rjing","mypoorphp","itmo544mp1") or die("Error " . mysqli_error($link));

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//below line is unsafe - $email is not checked for SQL injection -- don't do this in real life or use an ORM instead
echo $email "gallery";
$link->real_query("SELECT * FROM items WHERE email = '$email'"); 
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img src =\" " . $row['s3rawurl'] . "\" /><img src =\"" .$row['s3finishedurl'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>
<div id="container">
    <header>
      <h1>jQuery Wookmark Plug-in</h1>
    </header>
    <div id="main" role="main">

      <ul id="tiles">
        <!-- These are our grid blocks -->
        <li><img src="images/test.jpg" width="200" height="283"><p>1</p></li>
        <!-- End of grid blocks -->
      </ul>
    </div>
  </div>

  <!-- include jQuery -->
  <script src="../libs/jquery.min.js"></script>

  <!-- Include the plug-in -->
  <script src="../jquery.wookmark.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    (function ($){
      var handler = $('#tiles li');

      handler.wookmark({
          // Prepare layout options.
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 5, // Optional, the distance between grid items
          outerOffset: 10, // Optional, the distance to the containers border
          itemWidth: 210 // Optional, the width of a grid item
      });

      // Capture clicks on grid items.
      handler.click(function(){
        // Randomize the height of the clicked item.
        var newHeight = $('img', this).height() + Math.round(Math.random() * 300 + 30);
        $(this).css('height', newHeight+'px');

        // Update the layout.
        handler.wookmark();
      });
    })(jQuery);
  </script>
</body>
</html>
