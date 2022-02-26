<?php
include 'headers.php';
$purchaseqry=mysqli_query($config,"SELECT * FROM purchases");
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
<table style = 'border-collapse: collapse; width:98%'><tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'purchases.php'><img src = 'images/invoice.png' width = '20' height = '20' align = 'left'>Purchases</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/customers.png' width = '20' height = '20' align = 'left'><a href = 'purchaseorders.php'>Purchase Orders</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'receivedproposals.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Received Proposals</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'receivedquotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Received Quotations</a></td></tr>

</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/discounted.png' width = '40' height = '40'><br><h4>Purchases</h4>
<p>
<hr color = 'cyan'></p>
<div style="width: 20%;float:right;"><a href="purchasepdf.php" style="color:blue;"><img src="images/pdf.png" width="30" height="30" align="left">Download Purchases</a></div>
<table width="100%">
    <tr><th>Order ID</th><th>Item</th><th>Unit Cost</th><th>VAT (Ksh)</th><th>Total Cost (Ksh.)</th></tr>
    <?php
    while($prow=mysqli_fetch_assoc($purchaseqry)){
        $orderid=$prow['orderid'];
        $item=$prow['item'];
        $unitcost=$prow['unitcost'];
        $vat=$prow['vat'];
        $totalcost=$prow['totalcost'];
        echo '<tr><td>'.$orderid.'</td><td>'.$item.'</td><td>'.$unitcost.'</td><td>'.$vat.'</td><td>'.$totalcost.'</td></tr>';
    }
    ?>
</table>


</div>

</td></tr></table>
</td>
</tr></table>