<?php
include 'headers.php';
$customerqry = mysqli_query( $config, 'SELECT * FROM customers' );
$noofcustomers = mysqli_num_rows( $customerqry );
$quoteqry = mysqli_query( $config, 'SELECT * FROM quotationids' );
$noofquotes = mysqli_num_rows( $quoteqry );
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
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'bankaccounts.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Banks & Accounts</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'accountsreports.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Account Reports</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'productsales.php'><img src = 'images/emptycart.png' width = '20' height = '20' align = 'left'>Product Sales</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/discounted.png' width = '40' height = '40'><br><h4>Sales</h4>
<p>
<hr color = 'cyan'></p>

<a href = 'products.php'><div style = 'float: left; padding:8px;' align = 'center' class = 'icondiv'>
<img src = 'images/products.png' width = '50' height = '50'><br>
Customer Invoices: 0
</div></a>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/customers.png' width = '50' height = '50'><br>
Supplier Invoices: <?php echo $noofcustomers ?>
</div>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/edit.png' width = '50' height = '50'><br>
Accepted Quotations: 0
</div>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/icons/NOTE06.ico' width = '50' height = '50'><br>
Ready for Invoicing: <?php echo $noofquotes ?>
</div>
<div width = '100%'>

</div>

</td></tr></table>
</td>
</tr></table>