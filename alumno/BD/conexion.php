<?php
$servidor='localhost';
$Usuario='root';
$Password="";
$Bd="escuela";

$con= new mysqli($servidor,$Usuario,$Password,$Bd);
if($con->connect_error){
    die("connection failed".$con->connect_error);
}
else{
    echo $servidor;
}
?>