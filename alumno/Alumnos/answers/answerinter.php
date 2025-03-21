<?php
session_start();
$interpersonal = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];

// Almacena la variable interpersonal en la sesión
$_SESSION['interpersonal'] = $interpersonal;
echo ('hola')
?>