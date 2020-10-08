<html>
 <head>
  <meta charset="utf-8">
   <title>Octank Product Corporation</title>
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <style>body {margin-top: 40px; background-color: #533;}</style>
 </head>
 
  <body>
   <div class="container">
	   <div class="hero-unit">
		   <h1>Octank Product Catalog</h1>
		   <p>
		      <?php
			print "The Current Date and Time is: <br/>";
			print date("g:i A l, F j Y.");
		      ?>
		   </p>
 <!--Get instance metadata-->
<?php
      echo "Getting the curl handle";
      $curl_handle=curl_init();
      curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
      curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($curl_handle,CURLOPT_URL,'http://169.254.169.254/latest/meta-data/instance-id');
      $instanceId = curl_exec($curl_handle);
      if (empty($instanceId)){
        print "Sorry, for some reason, we got no hostname back <br />";
      } else {
        print "Server = " . $instanceId . "<br />";
   ?>
 <?php
  $webport = $_SERVER['RDS_PORT'];
  $Database = $_SERVER['RDS_HOSTNAME'];
  $DBUser = $_SERVER['RDS_USERNAME'];
  $DBPassword = $_SERVER['RDS_PASSWORD'];

  $dbconnection = mysql_connect($Database, $DBUser, $DBPassword) or die("Could not connect: " . mysql_error());  
   if($dbconnection){
      print "Connected to aurora successfully";
    } else {
      echo "Error creating table: " . mysql_error($dbconnection);
    }  
  $dbselected = mysql_select_db("OctankDB");
  $queryretrieve = "SELECT * FROM products";
      $result = mysql_query($queryretrieve, $dbconnection);
        echo $result;
        while($row = mysql_fetch_array($result)){
        echo $row['name'];
        echo $row['description'];
        }

 mysql_close($dbconnection);
 ?>
 </body>
</html>
