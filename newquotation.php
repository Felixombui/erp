<?php
include 'headers.php';
$id=$_GET['id'];
if(empty($id)){
    //do nothing
    $selvalue='Select Customer';
}else{
    //find quotation info
    $qtqry=mysqli_query($config,"SELECT * FROM quotationids WHERE id='$id'");
    $qtrow=mysqli_fetch_assoc($qtqry);
    $custname=$qtrow['customername'];
    $desc=$qtrow['description'];
    $payterms=$qtrow['paymentterms'];
    $qdate=$qtrow['quotedate'];
    $deldate=$qtrow['deliverydate'];
    $expdate=$qtrow['expirydate'];
    $selvalue=$custname;
}
if ( isset( $_POST['submit'] ) ) {
    $customername = addslashes( $_POST['customername'] );
    $description = addslashes( $_POST['description'] );
    $quotationdate = addslashes( $_POST['quotdate'] );
    $deliverydate = addslashes( $_POST['deliverydate'] );
    $expirydate = addslashes( $_POST['expirydate'] );
    $paymentterms = addslashes( $_POST['paymentterms'] );
    if ( empty( $description ) ) {
        $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the description!';
    } else {
        if ( empty( $quotationdate ) ) {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must select the date!';
        } else {
            if ( empty( $deliverydate ) ) {
                $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must select the delivery date!';
            } else {
                if ( empty( $expirydate ) ) {
                    $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must set the expiry date!';
                } else {
                    if(empty($id)){
                        if ( mysqli_query( $config, "INSERT INTO quotationids(`description`,customername,quotedate,deliverydate,expirydate,paymentterms) VALUES('$description','$customername','$quotationdate','$deliverydate','$expirydate','$paymentterms')" ) ) {
                            $qry = mysqli_query( $config, "SELECT * FROM quotationids WHERE customername='$customername' ORDER BY id DESC LIMIT 1" );
                            $row = mysqli_fetch_assoc( $qry );
                            $id = $row['id'];
                            header( 'location:morequotedetails.php?id='.$id );
                        }
                    }else{
                        if(mysqli_query($config,"UPDATE quotationids SET description='$description',customername='$customername',quotedate='$quotationdate',deliverydate='$deliverydate',expirydate='$expirydate',paymentterms='$paymentterms' WHERE id='$id'")){
                            header( 'location:morequotedetails.php?id='.$id );
                        }
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
<form method = 'post'>
<table><tr><td>Customer Name:</td><td><select name = 'customername'>
    <option selected><?php echo $selvalue ?></option>
<?php
$customerqry = mysqli_query( $config, 'SELECT * FROM customers' );
while ( $custrow = mysqli_fetch_assoc( $customerqry ) ) {
    echo '<option>'.$custrow['Names'].'</option>';
}
?>
</select><a href = 'customers.php' style = 'color:blue'> Add Customer</a></td></tr>
<tr><td>Description</td><td><textarea name = 'description' rows = '5' cols = '24'><?php echo $desc ?></textarea></td></tr>
<tr><td>Date:</td><td><input type = 'date' name = 'quotdate' value="<?php echo $qdate ?>"></td></tr>
<tr><td>Planned Delivery Date:</td><td><input type = 'date' name = 'deliverydate' value="<?php echo $deldate ?>"></td></tr>
<tr><td>Quotation Expiry Date:</td><td><input type = 'date' name = 'expirydate' value="<?php echo $expdate ?>"></td></tr>
<tr><td>Payment Terms:</td><td><textarea cols = '24' rows = '5' name="paymentterms"><?php echo $payterms ?></textarea></td></tr>
<tr><td></td><td align = 'right'><input type = 'submit' name = 'submit' value = 'Submit'></td></tr>
</table>
<table width = '80%' align = 'center'><tr><td><?php echo $info ?></td></tr></table>
</form>
</td>

</table>
</div>

</td></tr></table>
</td>
</tr></table>