<?php
session_start();
if(empty($_SESSION['username'])){
    header('location:login.php');
}
include 'config.php';
echo '<title>Macra IMS</title>';
echo "<div class = 'headertable'><table><tr><td><a href = 'index.php'><img src = 'images/home.png' width = '20' height = '20'> Home </a></td><td><a href = 'hrm.php'><img src = 'images/personnel.png' width = '20' height = '20' align = 'left'>Human Resource</a></td>
<td><a href = 'procurement.php'><img src = 'images/pay.png' width = '20' height = '20'>Procurement</a></td>
<td><a href = 'sales.php'><img src = 'images/discounted.png' width = '20' height = '20'>Sales</a></td>
<td><a href = 'accounts.php'><img src = 'images/bank.png' width = '20' height = '20'>Accounts</a></td>
<td><a href = 'admin.php'><img src = 'images/settings.png' width = '20' height = '20'>Admin</a></td>
</tr></table>
<div style='float:right;width:250px;'><a href='profile.php'><img src='images/user.png' width='25' height='25' align='left'>".$_SESSION['fullnames']."</a></div>
</div>";
?>

