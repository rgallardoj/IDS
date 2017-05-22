<?php
session_start();

if (!isset($_SESSION['rut'])) 
{
    header('location:index.php');
}
?>