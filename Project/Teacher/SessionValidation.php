<?php
session_start();
if($_SESSION['tid']==""){
    header('location:../Guest/Login.php');
}
?>