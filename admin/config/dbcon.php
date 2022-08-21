<?php 

$host = "mysqlHost";
$username = "devops";
$password = "dbadmin";
$database = "devopsexam";

$con = mysqli_connect("$host", "$username", "$password", "$database");

if(!$con){
    header("Location: ../errors/dberrors.php");
    die();
}

?>
