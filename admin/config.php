<?php

   $siteurl ="http://localhost/template";
   $dbuser="root";
   $dbhost ="localhost";
   $dbpass ="root";
   $dbname ="online_test";
   
// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
echo "connected";
