<?php
require 'conexion.php';
$usuario=$_POST['usuario'];

$password=$_POST['password'];

$tipo=preg_replace("/[0-9]/","",$usuario);


switch ($tipo){
    case "E":
    $sql = "SELECT Matricula FROM  alumnos WHERE Password='$password' AND Matricula='$usuario'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
    header('location:../alumno/index_alumno.php');
    echo $result;
    } 
    else {

    }

        break;
    
        case "D":
            $sql = "SELECT Matricula_D FROM docentes WHERE Password_D='$password' AND Matricula_D='$usuario'";
            $result = mysqli_query($conexion, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $session_query=mysqli_query($conexion,"SELECT id FROM docentes WHERE Matricula_D='$usuario'");
                $session_row=mysqli_fetch_assoc($session_query);
                $session=$session_row['id'];
                $grado1_query=mysqli_query($conexion,"SELECT grado1 FROM docentes WHERE Matricula_D='$usuario'");
                $grado1_row=mysqli_fetch_assoc($grado1_query);
                $grado1=$grado1_row['grado1'];
                $grado2_query=mysqli_query($conexion,"SELECT grado2 FROM docentes WHERE Matricula_D='$usuario'");
                $grado2_row=mysqli_fetch_assoc($grado2_query);
                $grado2=$grado2_row['grado2'];
                $grado3_query=mysqli_query($conexion,"SELECT grado3 FROM docentes WHERE Matricula_D='$usuario'");
                $grado3_row=mysqli_fetch_assoc($grado3_query);
                $grado3=$grado3_row['grado3'];
                $grado4_query=mysqli_query($conexion,"SELECT grado4 FROM docentes WHERE Matricula_D='$usuario'");
                $grado4_row=mysqli_fetch_assoc($grado4_query);
                $grado4=$grado4_row['grado4'];
                $grado5_query=mysqli_query($conexion,"SELECT grado5 FROM docentes WHERE Matricula_D='$usuario'");
                $grado5_row=mysqli_fetch_assoc($grado5_query);
                $grado5=$grado5_row['grado5'];-
                $grado6_query=mysqli_query($conexion,"SELECT grado6 FROM docentes WHERE Matricula_D='$usuario'");
                $grado6_row=mysqli_fetch_assoc($grado6_query);
                $grado6=$grado6_row['grado6'];
                session_start();
                $_SESSION['grado6']=$grado6;
                $_SESSION['grado5']=$grado5;
                $_SESSION['grado4']=$grado4;
                $_SESSION['grado3']=$grado3;
                $_SESSION['grado2']=$grado2;
                $_SESSION['grado1']=$grado1;
                $_SESSION['usuario']=$session;
                header('location:../docentes/index_docente.php');
            } 

            
            else {
                echo 'error';
            }
        break;
        
        
        case "ADMIN":
            $sql = "SELECT Matricula FROM admin WHERE Password='$password' AND Matricula ='$usuario'";
            $result = mysqli_query($conexion, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $session_query=mysqli_query($conexion,"SELECT id_admin FROM admin WHERE Matricula='$usuario'");
                $session_row=mysqli_fetch_assoc($session_query);
                $session=$session_row['id_admin'];
                session_start();
                $_SESSION['usuario']=$session;
            header('location:../admin/index_admin.php');
            } 
            else {
                echo 'error';
            }
            break;
        case "t":
            $sql = "SELECT Matricula FROM tutores WHERE Password='$password' AND Matricula ='$usuario'";
            $result = mysqli_query($conexion, $sql);
        
            if (mysqli_num_rows($result) > 0) {
            header('location:../index_tutor.php');
            } 
            else {
                echo 'error';
            }
            break;

}