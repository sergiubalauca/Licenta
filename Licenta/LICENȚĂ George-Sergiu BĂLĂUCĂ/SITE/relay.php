<?php
session_start();

if(isset($_POST['reset'])){($_SESSION['number']='A');}

if(empty($_SESSION['number'])){
    $_SESSION['number']='A';
}elseif(isset($_POST['next'])){
    $_SESSION['number']='A';
}


echo $_SESSION['number'];
?>