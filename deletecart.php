<?php
include 'config.php';
$id=$_GET['id'];
mysqli_query($config,"DELETE FROM cart WHERE id='$id'");
header('location:productsales.php');
?>