<?php
include 'headers.php';
$id=$_GET['id'];
$qry=mysqli_query($config,"SELECT * FROM invoiceids  WHERE id='$id'");
$row=mysqli_fetch_assoc($qry);
$pstatus=$row['status'];
if($pstatus=='Paid'){
	$details='<img src="images/success.png" width="20" height="20" align="left"> This invoice has been paid';
}elseif($pstatus=="Partial"){
		$pqry=mysqli_query($config,"SELECT * FROM payments WHERE invoiceno='$id' ORDER BY id DESC LIMIT 1");
		$prow=mysqli_fetch_assoc($pqry);
		$payable=$prow['balance'];
		$details='<form method="post"><table><tr><td>Amount Payable:</td><td>'.number_format($payable,2).'</td></tr>
		<tr><td>Select Payment Mode:</td><td><select name="mode"><option>Mpesa Paybill</option><option>Co-operative Bank</option></select></td></tr>
		<tr><td></td><td><input type="submit" name="next" value="Next >>"></td></tr></table>';
	
}else{
	$pqry=mysqli_query($config,"SELECT * FROM invoices WHERE invoiceid='$id'");
	$payable=0;
	while($prow=mysqli_fetch_assoc($pqry)){
		$payable=$payable+$prow['netcost'];
	}
	$details='<form method="post"><table><tr><td>Amount Payable:</td><td>'.number_format($payable,2).'</td></tr>
	<tr><td>Select Payment Mode:</td><td><select name="mode"><option>Mpesa Paybill</option><option>Co-operative Bank</option></select></td></tr>
	<tr><td></td><td><input type="submit" name="next" value="Next >>"></td></tr></table>';
}
if(isset($_POST['next'])){
	$mode=$_POST['mode'];
	if($mode=='Mpesa Paybill'){
		header('location:mpesapayments.php?id='.$id.'&amount='.$payable);
	}else{
		header('location:bankpayments.php?id='.$id.'&amount='.$payable.'&bank='.urlencode($mode));
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
<tr><th>Invoice <?php echo $id ?> payments <?php echo $bank_account ?></th></tr>
<table width = '100%'>
<tr><td><?php echo $details ?> </td></tr>

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