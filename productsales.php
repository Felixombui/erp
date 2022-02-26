<?php
include 'headers.php';
$qry = mysqli_query( $config, 'SELECT * FROM cart' );
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

<div width = '100%'>
<form action = '' method = 'POST'>
<table><tr><td>Customer Name</td><td>
<select name = 'customername'>
<?php
$custqry = mysqli_query( $config, 'SELECT * FROM customers' );
while( $custrow = mysqli_fetch_assoc( $custqry ) ) {
    echo '<option>'.$custrow['Names'].'</option>';
}
?>
</select>
</td></tr></table>
<table width = '100%' class = 'datatable'><tr style = 'text-align: left;'><th>Item</th><th>Unit Cost</th><th>Quantity</th><th>Tax</th><th></th></tr>

<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $itmid = $row['id'];
    $item = $row['product'];
    $unitcost = $row['unitcost'];
    echo '<tr><td>'.$item.'</td><td>'.number_format( $unitcost, 2 ).'</td><td><input type="number" name="quantity'.$itmid.'" value="1"></td><td><input type="text" name="tax'.$itmid.'" value="0"></td><td><a href="deletecart.php?id='.$itmid.'"><img src="images/delete.ico" width="20" height="20"></td></tr>';
}
if ( $_POST['quantity'.$itmid] ) {
    echo 'You clicked '.$itmid;
}
?>
</table>
<table><tr><td><input type = 'submit' name = 'submit' value = 'Submit for invoicing' style = 'padding: 5px; border-color:pink; border-radius:3px; width:250px;'></td></tr></table>
</form>
<?php
if ( isset( $_POST['submit'] ) ) {
    //create salesid
    $customer = addslashes( $_POST['customername'] );
    $salesdate = date( 'd/m/Y' );
    if ( $sidqry = mysqli_query( $config, "INSERT INTO salesids(customer,salesdate) VALUES('$customer','$salesdate')" ) ) {
        $idqry = mysqli_query( $config, 'SELECT * FROM salesids ORDER BY id DESC LIMIT 1' );
        $idrow = mysqli_fetch_assoc( $idqry );
        $salesid = $idrow['id'];
        $TotalGross = 0;
        $TotalTax = 0;
        $TotalNet = 0;
        $newqry = mysqli_query( $config, 'SELECT * FROM cart' );
        $items = mysqli_num_rows( $newqry );
        echo $items;
        $index = 0;
        while( $newrow = mysqli_fetch_assoc( $newqry ) ) {
            $index = $index+1;
            $itmid = $newrow['id'];
            $item = addslashes( $newrow['product'] );
            $unitcost = $newrow['unitcost'];
            $frmqty = 'quantity'.$itmid;
            echo $frmqty;
            $frmtax = 'tax'.$itmid;
            $quantity = $_POST['quantity'.$itmid];
            $tax = $_POST['tax'.$itmid];
            $gross = $unitcost*$quantity;
            $taxamount = $tax/100 * $gross;
            $net = $gross+$taxamount;
            $TotalGross = $TotalGross+$gross;
            $TotalTax = $TotalTax+$taxamount;
            $TotalNet = $TotalNet+$net;
            mysqli_query( $config, "INSERT INTO sales(salesid,item,unitcost,quantity,gross,tax,taxamount,net) VALUES('$salesid','$item','$unitcost','$quantity','$gross','$tax','$taxamount','$net')" );
        }
        mysqli_query( $config, "UPDATE salesids SET grosscost='$TotalGross',tax='$TotalTax',netcost='$TotalNet' where id='$salesid'" );
        echo 'Success';
    } else {
        echo 'Error at sales id!';
    }
}
?>
</div>

</td></tr></table>
</td>
</tr></table>
