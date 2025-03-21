<?php
 session_start();
$mate = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];

// Almacena la variable mate en la sesión
$_SESSION['mate'] = $mate;

// Establece la cabecera Location
header('Location: ../testmusic.php');
?>