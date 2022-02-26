<?php
include 'headers.php';
$id = $_GET['id'];
$itmid=$_GET['itmid'];
$kvalue="Save";
$query = mysqli_query( $config, "SELECT * FROM quotationids  WHERE id='$id'" );
$row = mysqli_fetch_assoc( $query );
$customername = $row['customername'];
$description = $row['description'];
$quotedate = $row['quotedate'];
$deliverydate = $row['deliverydate'];
$expirydate = $row['expirydate'];

if ( isset( $_POST['save'] ) ) {
    $itemname = addslashes( $_POST['item'] );
    $unitcost = addslashes( $_POST['unitcost'] );
    $quantity = addslashes( $_POST['quantity'] );
    $tax = addslashes( $_POST['tax'] );
    $totalcost = $unitcost*$quantity;
    if ( empty( $itemname ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the item name!';
    } else {
        if ( empty( $unitcost ) ) {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the unit cost';
        } else {
            if ( empty( $quantity ) ) {
                $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the quantity!';
            } else {
                if ( $tax == '' ) {
                    $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the tax!';
                } else {
                    if(empty($itmid)){
                        mysqli_query( $config, "INSERT INTO quotations(quotationid,item,unitcost,quantity,tax,totalcost) VALUES('$id','$itemname','$unitcost','$quantity','$tax','$totalcost')" );
                    $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left"> Item added to quotation successfully.';
                    }else{
                        mysqli_query($config,"UPDATE quotations SET item='$itemname',unitcost='$unitcost',quantity='$quantity',tax='$tax',totalcost='$totalcost' WHERE id='$itmid'");
                        $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left"> Item updated successfully.';
                        header('location:morequotedetails.php?id='.$id);
                    }
                    
                }
            }
        }
    }
}
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
<table style = 'border-collapse: collapse; width:98%'>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'><a href = 'newquotation.php'>New Quotation</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'proposals.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Proposals</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/icons/NOTE06.ico' width = '40' height = '40'><br><h4>New Quotation</h4>
<p>
<hr color = 'cyan'></p>
<div style = 'width:50%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' >
<tr>
<td>
<table width = '100%'><tr><td><a href="newquotation.php?id=<?php echo $id ?>"><img src = 'images/edit.png' width = '20' height = '20' align = 'right'></a></td></tr></table>
<table>
<tr><td>Customer Name:</td><td><?php echo $customername ?></td></tr>
<tr><td>Description:</td><td><?php echo $description ?></td></tr>
<tr><td>Quote Date:</td><td><?php echo $quotedate ?></td></tr>
<tr><td>Delivery Date:</td><td><?php echo $deliverydate ?></td></tr>
<tr><td>Expiry Date:</td><td><?php echo $expirydate ?></td></tr>
</table>
<?php
$itemsqry = mysqli_query( $config, "SELECT * FROM quotations WHERE quotationid='$id'" );
?>
<table width = '100%'><tr><th>List of items</th></tr></table>

<table width = '100%'><tr bgcolor = 'silver'><td>Item</td><td>Unit Cost</td><td>Quantity</td><td>Tax%</td><td>Total Cost</td><td></td></tr>
<?php
while( $itmsrow = mysqli_fetch_assoc( $itemsqry ) ) {
    $itemid=$itmsrow['id'];
    if($itmid==$itemid){
        $item=$itmsrow['item'];
        $uncost=$itmsrow['unitcost'];
        $qty=$itmsrow['quantity'];
        $itax=$itmsrow['tax'];
        $kvalue='Update';
    }
    echo '<tr><td>'.$itmsrow['item'].'</td><td>'.number_format( $itmsrow['unitcost'], 2 ).'</td><td>'.$itmsrow['quantity'].'</td><td>'.$itmsrow['tax'].'</td><td>'.number_format( $itmsrow['totalcost'], 2 ).'</td><td><a href="morequotedetails.php?id='.$id.'&itmid='.$itemid.'"><img src="images/edit.png" width="20" height="20"></a></td></tr>';
}

?>
</table>
</td>

</table>

</div>
<form method = 'post'>
<table><tr><td>Item Name: <input type = 'text' name = 'item' value="<?php echo $item ?>"></td><td>Unit Cost: <input type = 'text' name = 'unitcost' size = '5' value="<?php echo $uncost ?>"></td><td>Quantity: <input type = 'number' name = 'quantity' size = '5' value="<?php echo $qty ?>"></td><td>Tax: <input type = 'text' size = '5' name = 'tax' value="<?php echo $itax ?>"></td><td><input type = 'submit' name = 'save' value = '<?php echo $kvalue ?>'></td></tr></table>
</form>
<?php echo $info ?>
</td></tr>
<tr><td bgcolor = 'silver'><b>Documents</b></td></tr>
<tr><td><?php echo '<a href="quotationpdf.php?id='.$id.'" target="_new"><img src="images/pdf.png" width="20" height="20" align="left"> Quotation'.$id.'.pdf' ?></td></tr>
</table>
</td>
</tr></table>