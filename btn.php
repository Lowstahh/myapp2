<?php
$host = "host=127.0.01";
$port = "port=5432";
$dbname="dbname=glsapp";
$credentials="user=will password=798897";

$db = pg_connect("$host $port $dbname $credentials");

if(!$db){
   echo "Error: unable to open db\n";
}else {

   #echo "opened db successfully";
   
   $sql =<<<EOF
      SELECT * from users;
EOF;

$ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 

    while($row = pg_fetch_row($ret)){
      echo "ID = ". $row[0] . "\n<br>";     
      echo "EMAIL = ". $row[1] ."\n<br>";
      echo "PWHASH = ". $row[2] ."\n<br>";
      echo "\n<br>";
}}
pg_close($db);
?>