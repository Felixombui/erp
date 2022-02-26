<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query( $config, "DELETE FROM products WHERE id='$id'" );
header( 'location:products.php' );
?>