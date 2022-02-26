<?php
include 'headers.php';
$id=$_GET['id'];
$amount=$_GET['amount'];
set_time_limit(0);
if(isset($_POST['confirm'])){
    $config2=mysqli_connect('macrasystems.com','macrasys','playgroundkasa2015','macrasys_mpesa') or die('Error connecting to Mpesa!');
    $TransId=addslashes($_POST['transid']);
    $mpesaqry=mysqli_query($config2,"SELECT * FROM mpesa_payments WHERE TransID='$TransId'");
    if(mysqli_num_rows($mpesaqry)>0){
    $mpesarow=mysqli_fetch_assoc($mpesaqry);
    $status=$mpesarow['status'];
    if($status=='Unused'){
        $payable=$amount;
        $paid=$mpesarow['TransAmount'];
        $date=date('Y-m-d');
        $balance=$payable-$paid;
        $invqry=mysqli_query($config,"SELECT * FROM invoiceids WHERE id='$id'");
        $invrow=mysqli_fetch_assoc($invqry);
        $customer=$invrow['customername'];
        if(mysqli_query($config,"INSERT INTO payments(invoiceno,customer,amountpayable,amountpaid,balance,paymentmode,Bank,account,receiptno,pdate) VALUES('$id','$customer','$payable','$paid','$balance','Mpesa Paybill','Mpesa','5354881','$TransId','$date')")){
            //update mpesa
            mysqli_query($config2,"UPDATE mpesa_payments SET status='Used' WHERE TransID='$TransId'");
            //update invoice status
            if($balance>0){
            $newstatus='Partial';
            $msg=urlencode('Dear '.$customer.', Your invoice number '.$id.' has been partially paid with Ksh.'.$paid.'. Mpesa Transaction ID:' .$TransId.' Invoice balance is Ksh.'.$balance.'. Thank you for choosing Macra Systems.');
            }else{
                $newstatus="Paid";
                $msg=urlencode('Dear '.$customer.', Your invoice number '.$id.' has been fully paid with Ksh.'.$paid.'. Mpesa Transaction ID:'.$TransId.' Thank you for choosing Macra Systems.');
            }
            mysqli_query($config,"UPDATE invoiceids SET status='$newstatus' WHERE id='$id'");
            //fetch customer mobile phone number
            $custqry=mysqli_query($config,"SELECT * FROM customers WHERE Names='$customer'");
            $custrow=mysqli_fetch_assoc($custqry);
            $phonenumber=$custrow['PhoneNumber'];
            $chars=strlen($phonenumber);
            if($chars<11){
                $trim=ltrim($phonenumber,'0');
                $newphone='254'.$trim;
                $phonenumber=$newphone;
            }
            $url='https://sms.macrasystems.com/sendsms/index.php?username=Macra&senderid=SMARTLINK&phonenumber='.$phonenumber.'&message='.$msg;
            file_get_contents($url);
            $info='<img src="images/success.png" width="20" height="20" align="left"> Payments have been received successfully.';
        }
    }else{
        $info='<img src="images/error.png" width="20" height="20" align="left"> This transaction has already been used!';
    }
}else{
    $info='<img src="images/error.png" width="20" height="20" align="left"> Payments associated with this transaction ID have not been received!';
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
<tr><th>Invoice <?php echo $id ?> payments Mpesa Till 5354881</th></tr>
<table width = '100%'>
<tr><td>
    <form method="post">
        Enter Mpesa Transaction ID: <input type="text" name="transid" size="32"><input type="submit" name="confirm" value="Confirm">
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