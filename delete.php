<?php
session_start();
header('Location:index.php');
//var_dump($_SESSION);
@usset(@$_SESSION['fr_name']);
@usset($_SESSION['fr_surname']);
@usset($_SESSION['fr_email']);
@usset($_SESSION['fr_pesel']);
@usset($_SESSION['fr_born']);

