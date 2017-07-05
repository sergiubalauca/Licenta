<?php
session_start();

// Reset to 1
if(isset($_POST['reset'])){($_SESSION['number']='A');}

// Set or increment session number only if button is clicked.
if(empty($_SESSION['number'])){
    $_SESSION['number']='A';
}elseif(isset($_POST['next'])){
    $_SESSION['number']='A';
}


echo $_SESSION['number'];
?>