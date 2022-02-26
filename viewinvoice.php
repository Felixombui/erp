<?php
include 'headers.php';
$id = $_GET['id'];
$qry = mysqli_query( $config, "SELECT * FROM invoiceids WHERE id='$id'" );

?>

<table style = 'width:100%; height:100%'><tr>
<td>
<div style = 'width: 15%; border-collapse:collapse; border-right:1px solid pink; background-color:cyan; height:100%;float:left;'>
<div align = 'center'><img src = 'images/logo.png' width = '100' height = '80' align = 'center'><hr color = 'pink'</div>
<div align = 'center'>
<table style = 'border-collapse: collapse; width:98%'>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'><a href = 'newquotation.php'>New Quotation</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Quotation list</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/view.png' width = '40' height = '40'><br><h4>Invoice Details</h4>
<p>
<hr color = 'cyan'></p>
<div style = 'width:50%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<tr><th>Invoice <?php echo $id ?></th></tr>
<table width = '100%'>
<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $id = $row['id'];
    $description = $row['description'];
    $customername = $row['customername'];
    //$projectname = $row['projectname'];
    $quotedate = $row['invoicedate'];
    $status = $row['status'];
    echo '<tr><td>Invoice ID: </td><td>'.$id.'</td></tr>
    <tr><td>Customer Name: </td><td>'.$customername.'</td></tr>
    
    <tr><td>Invoice Date: </td><td>'.$quotedate.'</td></tr>
    <tr><td>Status: </td><td>'.$status.'</div></td></tr>
    <tr><td>Document: </td><td><a href="invoicepdf.php?id='.$id.'"><img src="images/pdf.png" width="20" height="20" align="left">Invoice'.$id.'.pdf</a></td></tr>';

}
if ( $status == 'Pending' ) {
    echo '<tr><td></td><td><div><a href = "payinvoice.php?id='.$id.'" style = "color:blue;
    ">Enter Payment</a></td></tr>';
} elseif ( $status == 'Partial' ) {
    echo '<tr><td></td><td><div><a href = "payinvoice.php?id='.$id.'" style = "color:blue;
    ">Enter Payment</a></td></tr>';
} else {
    if ( $status == 'Paid' ) {
        //check if invoice exists
        $invqry = mysqli_query( $config, "SELECT * FROM invoiceids WHERE quotationid='$id'" );
        if ( mysqli_num_rows( $invqry )>0 ) {
            $invrow = mysqli_fetch_assoc( $invqry );
            $invoice = 'Invoice'.$invrow['id'];
            echo '<tr><td><td><a href="viewinvoice.php?qid='.$id.'" style="color:blue;">'.$invoice.'</a></td></tr>';
        } else {
            echo '<tr><td><td><a href="createinvoice.php?qid='.$id.'" style="color:blue;">Create Invoice</a></td></tr>';
        }

    }
}

?>

</table>
</tr>
<tr><td>
<table width = '50%' class = 'datatable'><tr><th>Item List <?php
if ( $status == 'Waiting' ) {
    echo '<a href="morequotedetails.php?id='.$id.'" style="color:blue;">Edit</a>';
}

?></th></tr>
<tr><td>
<table width = '100%'><tr><td>Item</td><td>Unit Cost</td><td>Quantity</td><td>Tax</td><td>Total Cost</td></tr>
<?php
$quotqry = mysqli_query( $config, "SELECT * FROM invoices WHERE invoiceid='$id'" );
while( $quotrow = mysqli_fetch_assoc( $quotqry ) ) {
    echo '<tr><td>'.$quotrow['item'].'</td><td>'.number_format( $quotrow['unitcost'], 2 ).'</td><td>'.$quotrow['quantity'].'</td><td>'.$quotrow['vat'].'</td><td>'.number_format( $quotrow['netcost'], 2 ).'</td></tr>';
}
?>
</table>
</td></tr>
</table>
</td></tr>
</table>
</div>

</td></tr></table>
</td>
</tr></table>
<style>
<?php echo include 'styles.css';
?>
</style>