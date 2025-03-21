<?php
session_start();
if (isset($_POST['inter'])) {
    $interpersonal = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];

    // Almacena la variable interpersonal en la sesión
    $_SESSION['interpersonal'] = $interpersonal;
    $_SESSION['test_de_inteligencia_interpersonal_completed'] = true;
    // Establece la cabecera Location
    

}
if (isset($_POST['corp'])) {
    $corporal = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    $_SESSION['test_de_inteligencia_corporal_completed'] = true;
    
    // Almacentest_de_inteligencia_interpersonal_completeda la variable corporal en la sesión
    $_SESSION['corporal'] = $corporal;
}
if (isset($_POST['intra'])) {
    $intrapersonal = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable intrapersonal$intrapersonal en la sesión
    $_SESSION['intrapersonal'] = $intrapersonal;
    $_SESSION['test_de_inteligencia_intrapersonal_completed'] = true;
}
if (isset($_POST['lin'])) {
    $linguistica = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable linguistica en la sesión
    $_SESSION['linguistica'] = $linguistica;
    $_SESSION['test_de_inteligencia_linguistica_completed'] = true;
}
if (isset($_POST['mat'])) {
    $mate = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable mate en la sesión
    $_SESSION['mate'] = $mate;
    $_SESSION['test_de_inteligencia_matemática_completed'] = true;
}
if (isset($_POST['music'])) {
    $musica = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable musica en la sesión
    $_SESSION['musica'] = $musica;
    $_SESSION['test_de_inteligencia_músical_completed'] = true;
}
if (isset($_POST['nat'])) {
    $naturalista = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable naturalista en la sesión
    $_SESSION['naturalista'] = $naturalista;
    $_SESSION['test_de_inteligencia_naturalista_completed'] = true;
}
if (isset($_POST['vi'])) {
    $visual = $_POST['q1'] + $_POST['q2'] + $_POST['q3'] + $_POST['q4'] + $_POST['q5'] + $_POST['q6'] + $_POST['q7'] + $_POST['q8'] + $_POST['q9'] + $_POST['q10'];
    
    // Almacena la variable visual en la sesión
    $_SESSION['visual'] = $visual;
    $_SESSION['test_de_inteligencia_visual_completed'] = true;
    
}

if (isset($_SESSION['interpersonal']) || isset($_SESSION['corporal']) 
|| isset($_SESSION['intrapersonal']) || isset($_SESSION['mate']) || isset($_SESSION['linguistica']) || isset($_SESSION['musica'])
    || isset($_SESSION['naturalista']) || isset($_SESSION['visual'])) {
    $_SESSION['tests_completados']++;
}
if ($_SESSION['tests_completados'] == 8) {
    header('Location: ../respuesta.php');
}
else{
    header('Location: ../../tests.php');
}