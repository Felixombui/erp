<?php
include 'headers.php';

?>
<style>
<?php echo include 'styles.css';
?>
</style>
<table style = 'width:100%; height:100%'><tr>
<td>
<div style = 'width: 15%; border-collapse:collapse; border-right:1px solid pink; background-color:cyan; height:100%;float:left;'>
<div align = 'center'><img src = 'images/logo.png' width = '100' height = '80' align = 'center'><hr color = 'pink'</div>
<div align = 'center'>
<table style = 'border-collapse: collapse; width:98%'><tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'invoices.php'><img src = 'images/invoice.png' width = '20' height = '20' align = 'left'>Invoices</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/customers.png' width = '20' height = '20' align = 'left'><a href = 'payments.php'>Payments</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'bankaccounts.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Accounts</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'accountsreports.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Account Reports</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'productsales.php'><img src = 'images/emptycart.png' width = '20' height = '20' align = 'left'>Product Sales</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/discounted.png' width = '40' height = '40'><br><h4>Invoices</h4>
<p>
<hr color = 'cyan'></p>

<div width = '100%'>
<div style = 'float: left; width:49%;'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid cyan'><tr><th style = 'background-color: orange; color:white;'>Ready for Invoicing</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$quotqry = mysqli_query( $config, "SELECT * FROM quotationids WHERE status='Accepted' AND id NOT IN(SELECT quotationid FROM invoiceids)" );
while( $qrow = mysqli_fetch_assoc( $quotqry ) ) {
    $quotid = $qrow['id'];
    $ref = $qrow['description'];
    $customer = $qrow['customername'];
    echo '<tr><td><a href="quotationdetails.php?id='.$quotid.'" style="color:blue"><img src="images/view.png" width="20" height="20" align="left">'.$ref.'</a></td><td align="right"><a href="createinvoice.php?qid='.$quotid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="right">Create Invoice</td></tr>';
}
?>
</table>
</td></tr>
</table>
</div>
<div style = 'float: left; width:49%; margin-left:5px;'>
<table width = '100%' align = 'right' style = 'border-collapse: collapse; border:1px solid cyan;'><tr><th>All Invoices</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$invqry = mysqli_query( $config, 'SELECT * FROM invoiceids' );
if ( mysqli_num_rows( $invqry ) <1 ) {
    echo '<tr><td>No invoices</td></tr>';
} else {
    while( $invrow = mysqli_fetch_assoc( $invqry ) ) {
        $invoiceid = $invrow['id'];
        $description = $invrow['description'];
        echo '<tr style="border:1px solid cyan"><td><a href="viewinvoice.php?id='.$invoiceid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="left">Invoice'.$invoiceid.'</td><td><a href="viewinvoice.php?id='.$invoiceid.'">'.$description.'</td></tr>';
    }
}
?>
</table>
</td></tr>
</table>
</div>

<div style = 'float: left; width:49%; margin-left:5px; margin-top:5px'>
<table width = '100%' align = 'right' style = 'border-collapse: collapse; border:1px solid cyan;'><tr><th>Pending Invoices</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$invqry = mysqli_query( $config, 'SELECT * FROM invoiceids WHERE status="Pending"' );
if ( mysqli_num_rows( $invqry ) <1 ) {
    echo '<tr><td>No invoices</td></tr>';
} else {
    while( $invrow = mysqli_fetch_assoc( $invqry ) ) {
        $invoiceid = $invrow['id'];
        $description = $invrow['description'];
        echo '<tr style="border:1px solid cyan"><td><a href="viewinvoice.php?id='.$invoiceid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="left">Invoice'.$invoiceid.'</td><td><a href="viewinvoice.php?id='.$invoiceid.'">'.$description.'</td></tr>';
    }
}
?>
</table>
</td></tr>
</table>
</div>

<div style = 'float: left; width:49%; margin-left:5px; margin-top:5px'>
<table width = '100%' align = 'right' style = 'border-collapse: collapse; border:1px solid cyan;'><tr><th>Partially Paid Invoices</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$invqry = mysqli_query( $config, 'SELECT * FROM invoiceids WHERE status="Partial"' );
if ( mysqli_num_rows( $invqry ) <1 ) {
    echo '<tr><td>No invoices</td></tr>';
} else {
    while( $invrow = mysqli_fetch_assoc( $invqry ) ) {
        $invoiceid = $invrow['id'];
        $description = $invrow['description'];
        echo '<tr style="border:1px solid cyan"><td><a href="viewinvoice.php?id='.$invoiceid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="left">Invoice'.$invoiceid.'</td><td><a href="viewinvoice.php?id='.$invoiceid.'">'.$description.'</td></tr>';
    }
}
?>
</table>
</td></tr>
</table>
</div>

<div style = 'float: left; width:49%; margin-left:5px; margin-top:5px'>
<table width = '100%' align = 'right' style = 'border-collapse: collapse; border:1px solid cyan;'><tr><th>Paid Invoices</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$invqry = mysqli_query( $config, 'SELECT * FROM invoiceids WHERE status="Paid"' );
if ( mysqli_num_rows( $invqry ) <1 ) {
    echo '<tr><td>No invoices</td></tr>';
} else {
    while( $invrow = mysqli_fetch_assoc( $invqry ) ) {
        $invoiceid = $invrow['id'];
        $description = $invrow['description'];
        echo '<tr style="border:1px solid cyan"><td><a href="viewinvoice.php?id='.$invoiceid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="left">Invoice'.$invoiceid.'</td><td><a href="viewinvoice.php?id='.$invoiceid.'">'.$description.'</td></tr>';
    }
}
?>
</table>
</td></tr>
</table>
</div>

<div style = 'float: left; width:49%; margin-left:5px; margin-top:5px'>
<table width = '100%' align = 'right' style = 'border-collapse: collapse; border:1px solid cyan;'><tr><th>Abandoned Invoices</th></tr>
<tr><td>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$invqry = mysqli_query( $config, 'SELECT * FROM invoiceids WHERE status="Abandoned"' );
if ( mysqli_num_rows( $invqry ) <1 ) {
    echo '<tr><td>No invoices</td></tr>';
} else {
    while( $invrow = mysqli_fetch_assoc( $invqry ) ) {
        $invoiceid = $invrow['id'];
        $description = $invrow['description'];
        echo '<tr style="border:1px solid cyan"><td><a href="viewinvoice.php?id='.$invoiceid.'" style="color:blue;"><img src="images/invoice.png" width="20" height="20" align="left">Invoice'.$invoiceid.'</td><td><a href="viewinvoice.php?id='.$invoiceid.'">'.$description.'</td></tr>';
    }
}
?>
</table>
</td></tr>
</table>
</div>

</div>

</td></tr></table>
</td>
</tr></table>