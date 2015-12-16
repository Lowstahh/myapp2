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
   
  $query = "SELECT email FROM users WHERE email= '".$email."'";
  $result = pg_query($db, $query);
  $row = pg_fetch_array($result);
  $n = pg_affected_rows($db);

  if($n >= 1){
    echo "Username already exist";
}else{
   $email = pg_escape_string($email);
$password = pg_escape_string($password);
    $insert = "INSERT INTO users VALUES (nextval('u_id'), '$email', crypt('$password', gen_salt('md5')))";
    pg_query($db, $insert);


}


}
pg_close($db);
?>