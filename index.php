<?php session_start(); ?>

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

#log{
	position: absolute;
	margin-top: 15px;
	margin-left:100px;
	width: 100%;
	list-style-type: none;
}

#log a li{
	padding:10px;
	text-align: center;
	width: 50px;
	height: 30px;
	float:left;
	-webkit-border-radius: 8px;
    -moz-border-radius: 8px;
}

#log a{
	text-align: center;
	margin-top:0px;
	color: #D5D2CE;
	font-size: 18px;
}

#log a li:hover{
	background-color: #AD8148;
	
}

#content{
    font-size: 20px;
    margin-left: 20px;
    color: #272625;
}

input{
	border-color: #FFFFFF;
    height: 30px;
	-webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border:1px solid transparent;
    border-color: #000000;
}

fieldset{
	-webkit-border-radius: 8px;
    -moz-border-radius: 8px;
}

#file{
	border:none;
	width: 200px;
}

a{
	margin-left: 20px;
	color: #080808;
}

#star{
	color:red;
}

#submit:hover{
	background-color: #000000;
	color:#FFFFFF;
}
</style>
<title>Welcome page</title>
</head>
<body>

<header id="head">
		<div id="image"><img class="logo" src="images/gallery-art.jpg"></div>
		<ul id="log">
			<a href="logup.php"><li>log up</li></a>
			<a href="login.php"><li>log in</li></a>
		</ul>
	</div>
</header>

<br><br>

<fieldset>
<div id="content">
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="result.php" method="POST" >
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <!-- Name of input element determines name in $_FILES array -->
<span id="star">*</span>Send this file: <input name="userfile" type="file" id="file"/><br /><br />
<span id="star">*</span>Enter Email of user: <input type="email" name="useremail"><br /><br />
<span id="star">*</span>Enter Phone of user (1XXXXXXXXXX): <input type="phone" name="phone">
<input type="submit" value="Send File" id="submit"/>

</form>
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="gallery.php" method="POST">
<span id="star">*</span>Enter Email of user for gallery to browse: <input type="email" name="email">
<input type="submit" value="Load Gallery" id="submit"/>
</form>
</fieldset>

<br>
<a href="introspection.php">Backup databases</a>
</div>

</body>
</html>