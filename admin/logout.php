<?php
session_start();
//change the spelling of sesion to session
session_destroy();
header("location:index.php");
?>
