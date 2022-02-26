<?php
include 'config.php';
$id = $_GET['id'];
$status = $_GET['status'];
if ( $status == 'no' ) {
    $status = 'Rejected';
} else {
    $status = 'Accepted';
}
mysqli_query( $config, "UPDATE quotationids SET `status`='$status' WHERE id='$id'" );
header( 'location:quotationdetails.php?id='.$id );
?>