<?php
include 'headers.php';
$qid = $_GET['qid'];
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
<img src = 'images/discounted.png' width = '40' height = '40'><br><h4>Invoices</h4>
<p>
<hr color = 'cyan'></p>

<div width = '100%'>
<div style = 'float: left; width:49%;'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid cyan'><tr><th style = 'background-color: orange; color:white;'>Create Invoice</th></tr>
<tr><td>
<form method = 'post'>
<table width = '100%' style = 'border-collapse: collapse;'>
<?php
$quotqry = mysqli_query( $config, "SELECT * FROM quotationids WHERE id='$qid'" );
$qrow = mysqli_fetch_assoc( $quotqry );
$quotid = $qrow['id'];
$ref = $qrow['description'];
$customer = $qrow['customername'];
$terms = $qrow['paymentterms'];
echo '<tr><td> Customer: '.$customer.'</td></tr>
      <tr><td> Ref: '.$ref.'</td></tr>
      <tr><td> Payment Mode: <select name="pmode"><option>Cash</option><option>Mpesa</option><option>Cheque</option><option>Bank Transfer</option></select></td></tr>
      <tr><td> Bank: <select name="bank"><option>Cash</option><option>Mpesa Paybill</option><option>Co-operative Bank</option><option>Equity Bank</option></select></td></tr><tr><td align="center"><b>Quoted Items</b><table width="100%"><tr style="background-color:brown;"><th>Item</th><th>Unit Cost</th><th>Quantity</th><th>tax</th><th>Total Cost</th></tr>';
$itmqry = mysqli_query( $config, "SELECT * FROM quotations WHERE quotationid='$qid'" );
$cummtotal = 0;
$totaltax = 0;
while( $itmrow = mysqli_fetch_assoc( $itmqry ) ) {
    $cummtotal = $cummtotal+$itmrow['totalcost'];
    $indivtax = $itmrow['tax']/100*$itmrow['totalcost'];
    $totaltax = $totaltax+$indivtax;
    echo '<tr><td>'.$itmrow['item'].'</td><td>'.$itmrow['unitcost'].'</td><td>'.$itmrow['quantity'].'</td><td>'.$itmrow['tax'].'</td><td align="right">'.number_format( $itmrow['totalcost'], 2 ).'</td></tr>';
}
echo '<tr><td></td><td></td><td></td><td><b>Total Cost</b></td><td align="right"><b>'.number_format( $cummtotal, 2 ).'</b></td></tr>';
echo '<tr><td></td><td></td><td></td><td><b>Total tax</b></td><td align="right"><b>'.number_format( $totaltax, 2 ).'</b></td></tr>';
$inctax = $cummtotal+$totaltax;
echo '<tr><td></td><td></td><td></td><td><b>Total incl. tax (Ksh)</b></td><td align="right"><b>'.number_format( $inctax, 2 ).'</b></td></tr>';
echo '</table></td></td><tr><td><input type = "submit" name = "draft" Value = "Create Invoice"></td></tr>';
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

<?php
if ( isset( $_POST['draft'] ) ) {
    $checkvalues = mysqli_query( $config, "SELECT * FROM quotationids WHERE id='$qid'" );
    $valRow = mysqli_fetch_assoc( $checkvalues );
    $paymentterms = addslashes( $valRow['paymentterms'] );
    $ref = addslashes( $valRow['description'] );
    $customer = addslashes( $valRow['customername'] );
    $bankname = addslashes( $_POST['bank'] );
    $paymentmode = addslashes( $_POST['pmode'] );
    $bankqry = mysqli_query( $config, "SELECT * FROM banks WHERE bankname='$bankname'" );
    $bankrow = mysqli_fetch_assoc( $bankqry );
    $accountno = $bankrow['accountno'];
    $paymentaccount = $bankname.'-'.$accountno;
    //add to quotationids
    if ( mysqli_query( $config, "INSERT INTO invoiceids(customername,`description`,paymentmode,paymentaccount,paymentterms,quotationid) values('$customer','$ref','$paymentmode','$paymentaccount','$paymentterms','$qid')" ) ) {
        $invdetails = mysqli_query( $config, "SELECT * FROM invoiceids WHERE quotationid='$qid'" );
        $invrow = mysqli_fetch_assoc( $invdetails );
        $invid = $invrow['id'];
        //create quotation
        $qtqry = mysqli_query( $config, "SELECT * FROM quotations WHERE quotationid='$qid'" );
        while( $qtrow = mysqli_fetch_assoc( $qtqry ) ) {
            $item = $qtrow['item'];
            $unitcost = $qtrow['unitcost'];
            $quantity = $qtrow['quantity'];
            $tax = $qtrow['tax'];
            $totalcost = $qtrow['totalcost'];
            $vat = $tax/100*$totalcost;
            $netcost = $totalcost+$vat;
            if ( mysqli_query( $config, "INSERT INTO invoices(invoiceid,item,unitcost,quantity,gross,vat,netcost) VALUES('$invid','$item','$unitcost','$quantity','$totalcost','$vat',$netcost)" ) ) {
                header( 'location:invoices.php' );
            }
        }
        //header( 'location:invoicedetails.php?qid = '.$qid.'&invid = '.$invid );
    } else {
        echo 'Error creating draft!';
    }
}
?>
<style>
<?php echo include 'styles.css';
?>
</style>