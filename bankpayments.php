<?php
include 'headers.php';
$id=$_GET['id'];
$bank=$_GET['bank'];
$amount=$_GET['amount'];
set_time_limit(0);
if(isset($_POST['submit'])){
    //find customer
    $custqry=mysqli_query($config,"SELECT * FROM invoiceids WHERE id='$id'");
    $custrow=mysqli_fetch_assoc($custqry);
    $customer=$custrow['customername'];
    $paid=addslashes($_POST['amount']);
    $balance=$amount-$paid;
    $paymentmode='Bank';
    $slipno=addslashes($_POST['transid']);
    $date=date('d-m-Y');
    if(mysqli_query($config,"INSERT INTO payments(invoiceno,customer,amountpayable,amountpaid,balance,paymentmode,Bank,account,receiptno,pdate) VALUES('$id','$customer','$amount','$paid','$balance','Bank','$bank','$bank','$slipno','$date')")){
        mysqli_query($config,"UPDATE invoiceids SET status='Paid' WHERE id='$id'");
        $pmtqry=mysqli_query($config,"SELECT * FROM payments ORDER BY id desc limit 1");
        $pmtrow=mysqli_fetch_assoc($pmtqry);
        $pid=$pmtrow['id'];
        $result='<img src="images/success.png" width="30" height="30" align="left"> Payment was received successfully. <a href="receiptpdf.php?pid='.$pid.'" style="color:blue;">Print Receipt Here';
    }else{
        $result='<img src="images/error.png" width="30" height="30" align="left"> Payment Failed!';
    }

}
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
<tr><th>Invoice <?php echo $id ?> payments <?php echo $bank ?> </th></tr>
<table width = '100%'>
<tr><td>
    <form method="post">
        <table>
            <tr><td>Enter Amount Paid:</td><td><input type="text" name="amount" size="32"></td></tr>
            <tr><td>Slip Number:</td><td><input type="text" name="transid" size="32"></td></tr>
            <tr><td></td><td><input type="submit" name="submit" value="Submit Payment"></td></tr>
    </table>
         <br>
         <?php echo $result ?>
    </form>
</td></tr>
<tr><td><?php echo $info ?></td></tr>
</table>
</tr>
</table>
</div>

</td></tr></table>
</td>
</tr></table>
<style>
<?php echo include 'styles.css';
?>
</style>