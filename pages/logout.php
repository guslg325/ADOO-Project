<?php
    session_start();
    unset($_SESSION["login"]);//finaliza la sesion
    header("location: ./../index.php"); //redirigimos a index
?>