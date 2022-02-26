<?php
include 'config.php';
$id = $_GET['id'];
$qry = mysqli_query( $config, "SELECT * FROM products WHERE id='$id'" );
$row = mysqli_fetch_assoc( $qry );
$productname = $row['productname'];
$unitcost = $row['unitcost'];
$cartquery = mysqli_query( $config, "INSERT INTO cart(product,unitcost) VALUES('$productname','$unitcost')" );
header( 'location:products.php' );
?>