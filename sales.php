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
<table style = 'border-collapse: collapse; width:98%'><tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'products.php'><img src = 'images/invoice.png' width = '20' height = '20' align = 'left'>Products</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/customers.png' width = '20' height = '20' align = 'left'><a href = 'customers.php'>Customers</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'proposals.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Proposals</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'productsales.php'><img src = 'images/emptycart.png' width = '20' height = '20' align = 'left'>Product Sales</a></td></tr>
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
Products: 0
</div></a>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/customers.png' width = '50' height = '50'><br>
Customers: <?php echo $noofcustomers ?>
</div>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/edit.png' width = '50' height = '50'><br>
Proposals: 0
</div>
<div style = 'float: left; padding:8px' align = 'center' class = 'icondiv'>
<img src = 'images/icons/NOTE06.ico' width = '50' height = '50'><br>
Quotations: <?php echo $noofquotes ?>
</div>
<div width = '100%'>

</div>

</td></tr></table>
</td>
</tr></table>