<?php
include 'headers.php';
$config2=mysqli_connect('macrasystems.com','macrasys','playgroundkasa2015','macrasys_mpesa') or die('Error! Connection to Mpesa failed!');
$qry=mysqli_query($config2,"SELECT * FROM mpesa_payments ORDER BY id DESC");
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
<table style = 'border-collapse: collapse; width:98%'><tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'allpayments.php'><img src = 'images/view.png' width = '20' height = '20' align = 'left'>All Payments</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'><a href = 'paybillpayments.php'>MPesa Paybill</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'proposals.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Proposals</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/pay.png' width = '40' height = '40'><br><h4>Confirmed Payments</h4>
<p>

<hr color = 'cyan'></p>
<div style = 'width:100%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<th>Trans ID</th><th>Amount</th><th>From</th><th>Phone Number</th><th>Status</th><th>Action</th>
</tr>
<?php
while($row=mysqli_fetch_assoc($qry)){
    $transID=$row['TransID'];
    $amount=$row['TransAmount'];
    $msisdn=$row['MSISDN'];
    $names=$row['FirstName'].' '.$row['MiddleName'].' '.$row['LastName'];
    $status=$row['status'];
    echo '<tr><td>'.$transID.'</td><td>'.number_format($amount,2).'</td><td>'.$names.'</td><td>'.$msisdn.'</td><td>'.$status.'</td><td>'.'</td><td></tr>';
}
?>
</table>
</div>

</td></tr></table>
</td>
</tr></table>