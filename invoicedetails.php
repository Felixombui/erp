<?php
include 'headers.php';
$qid = $_GET['qid'];
$invid = $_GET['invid'];
$invdetails = mysqli_query( $config, "SELECT * FROM invoiceids WHERE id='$invid'" );
$invrow = mysqli_fetch_assoc( $invdetails );
$customer = $invrow['customername'];
$description = $invrow['description'];
$paymentaccount = $invrow['paymentaccount'];

?>

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
<img src = 'images/discounted.png' width = '40' height = '40'><br><h4>New Invoices</h4>
<p>
<hr color = 'cyan'></p>

<div width = '100%'>
<div style = 'float: left; width:49%;'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid cyan'><tr><th style = 'background-color: orange; color:white;'>Create Invoice</th></tr>
<tr><td>
<form method = 'post'>
<table width = '100%' style = 'border-collapse: collapse;'>
<tr><td>Customer:</td><td><?php echo $customer ?></td></tr>
<tr><td>Description:</td><td><?php echo $description ?></td></tr>
<tr><td>Payment Account:</td><td><?php echo $paymentaccount ?></td></tr>
<?php
?>
</table>
</form>
</td></tr>
</table>
</div>

</div>

</td></tr></table>
</td>
</tr></table>

<style>
<?php echo include 'styles.css';
?>
</style>