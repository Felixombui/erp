<?php
include 'headers.php';
$id = $_GET['id'];
$qry = mysqli_query( $config, "SELECT * FROM quotationids WHERE id='$id'" );

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
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Quotation list</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/view.png' width = '40' height = '40'><br><h4>Quotation Details</h4>
<p>
<hr color = 'cyan'></p>
<div style = 'width:50%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<tr><th>Quotation <?php echo $id ?></th></tr>
<table width = '100%'>
<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $id = $row['id'];
    $description = $row['description'];
    $customername = $row['customername'];
    $projectname = $row['projectname'];
    $quotedate = $row['quotedate'];
    $status = $row['status'];
    echo '<tr><td>Quotation ID: </td><td>'.$id.'</td></tr>
    <tr><td>Customer Name: </td><td>'.$customername.'</td></tr>
    <tr><td>Project Name: </td><td>'.$projectname.'</td></tr>
    <tr><td>Invoice Date: </td><td>'.$quotedate.'</td></tr>
    <tr><td>Status: </td><td>'.$status.'</div></td></tr>
    <tr><td>Document: </td><td><a href="quotationpdf.php?id='.$id.'"><img src="images/pdf.png" width="20" height="20" align="left">Quotation'.$id.'.pdf</a></td></tr>';

}
if ( $status == 'Waiting' ) {
    echo '<tr><td>Change status to</td><td><div><a href = "updateqstatus.php?id='.$id.'&status=yes" style = "color:blue;
    ">Accepted</a> | <a href = "updateqstatus.php?id='.$id.'&status=no" style = "color:blue;">Rejected</a></td></tr>';
} else {
    echo '<tr><td>Change status to</td><td><div style="background-color:grey; color:white;">Status change disabled</div> </td></tr>';
    if ( $status == 'Accepted' ) {
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
$quotqry = mysqli_query( $config, "SELECT * FROM quotations WHERE quotationid='$id'" );
while( $quotrow = mysqli_fetch_assoc( $quotqry ) ) {
    echo '<tr><td>'.$quotrow['item'].'</td><td>'.number_format( $quotrow['unitcost'], 2 ).'</td><td>'.$quotrow['quantity'].'</td><td>'.$quotrow['tax'].'</td><td>'.number_format( $quotrow['totalcost'], 2 ).'</td></tr>';
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