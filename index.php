<html>
 <head>
  <meta charset="utf-8">
   <title>Octank Product Corporation</title>
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <style>body {margin-top: 40px; background-color: LightSkyBlue}</style>
 </head>
 
  <body>
   <div class="container">
	   <div class="hero-unit">
		   <h1>Octank Product Catalog</h1>
		   <p>
		      <?php
			date_default_timezone_set('US/Eastern');
			print "The Current Date and Time is: <br/>";
			print date("g:i A l, F j Y.");
		      ?>
		   </p>
 <!--Get instance metadata-->
<?php

      $curl_handle=curl_init();
      curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
      curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($curl_handle,CURLOPT_URL,'http://169.254.169.254/latest/meta-data/instance-id');
      $instanceId = curl_exec($curl_handle);
      if (empty($instanceId)){
        print "Sorry, for some reason, we got no hostname back <br />";
      } else {
        print "This page is powered by " . $instanceId . "<br />";
      }
   ?>
 <?php
  $Database = $_SERVER['RDS_HOSTNAME'];
  $DBUser = $_SERVER['RDS_USERNAME'];
  $DBPassword = $_SERVER['RDS_PASSWORD'];
  $DBName = $_SERVER['RDS_DBNAME'];

  $dbconnection = mysql_connect($Database, $DBUser, $DBPassword) or die("Could not connect: " . mysql_error());  
   if($dbconnection){
      print "This page connects to AWS Aurora DB";
    } else {
      echo "Error creating table: " . mysql_error($dbconnection);
    }  
  $dbselected = mysql_select_db($DBName);
  $queryretrieve = "SELECT * FROM products";
  $result = mysql_query($queryretrieve, $dbconnection);
?>
		   
<table class="table table-dark">
	<thead>
    <tr>
      <th scope="col">productId</th>
      <th scope="col">productName</th>
      <th scope="col">description</th>
    </tr>
  </thead>
	<tbody>
    <tr>
		  <?php
        while($row = mysql_fetch_array($result)){
		      ?><td><?php echo $row['productId']; ?></td>
		      <td><?php echo $row['productName']; ?></td>
		      <td><?php echo $row['description']; ?></td> 
    </tr>
    <?php
        }
		  mysql_close($dbconnection);		
    ?>
	</tbody>
</table>
</div>
</div>
<div class="container">	 
  <?php
    $octfile = fopen("/OctVolume/1001.html", "r") or die("");
    echo fread($octfile,filesize("/OctVolume/1001.html"));
    fclose($octfile);
  ?> 
</div>
</body>
</html>
