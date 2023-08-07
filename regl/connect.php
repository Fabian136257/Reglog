<?php
$dbhost = "localhost";
$dbname = "reg";
$dbuser = "root";
$dbpassword = "";
try{
$db_conn = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $dbuser, $dbpassword);
} catch(PDOException $e){
  echo "Błąd";
}



?>