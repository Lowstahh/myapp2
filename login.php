<?php
$host = "host=127.0.01";
$port = "port=5432";
$dbname="dbname=glsapp";
$credentials="user=will password=798897";

$db = pg_connect("$host $port $dbname $credentials");

$email = $_POST["email"];
$password = $_POST["pw"];
if(!$db){
   echo "Error: unable to open db\n";
}else {

   #echo "opened db successfully";
   $email = pg_escape_string($email);
   $password = pg_escape_string($password);
   $sql =
      
      "SELECT * from users WHERE pwhash = crypt('$password', pwhash)";

$ret = pg_query($db, $sql);
   if(!$ret){
      echo pg_last_error($db);
      exit;
   } 

    $row = pg_fetch_row($ret);
    $n = pg_affected_rows($ret);

    

    if($n == 0){
      echo "incorrect error or password";
    }else{

   echo "Welcome back, id number ".  $row[0];
  }
}
pg_close($db);
?>