<?php
session_start();
//change the spelling of sesion to session
sesion_destroy();
header("location:index.php");
?>
