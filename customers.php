<?php
include 'headers.php';
$getid = $_GET['id'];
$getqry = mysqli_query( $config, "SELECT * FROM customers WHERE id='$getid'" );
$getrow = mysqli_fetch_assoc( $getqry );
$qry = mysqli_query( $config, 'SELECT * FROM customers' );
if ( isset( $_POST['save'] ) ) {
    if ( empty( $getid ) ) {
        $names = addslashes( $_POST['names'] );
        $address = addslashes( $_POST['address'] );
        $emailaddress = addslashes( $_POST['emailaddress'] );
        $phonenumber = $_POST['phonenumber'];
        $website = addslashes( $_POST['website'] );
        if ( empty( $names ) ) {
            $info = '<div style="background-color:red; border-radius:5px; width:auto;"><img src="images/error.png" width="20" height="20" align="left"> You must enter the customer names.';
        } else {
            if ( mysqli_query( $config, "INSERT INTO customers(Names,`Address`,EmailAddress,PhoneNumber,website) VALUES('$names','$address','$emailaddress','$phonenumber','$website')" ) ) {
                $info = '<div style="background-color:green; border-radius:5px; width:auto;"><img src="images/success.png" width="20" height="20" align="left"> Customer saved successfully.';
            } else {
                $info = '<div style="background-color:red; border-radius:5px; width:auto;"><img src="images/error.png" width="20" height="20" align="left"> Error! Saving failed. Check values.';

            }
        }

    } else {
        $names = addslashes( $_POST['names'] );
        $address = addslashes( $_POST['address'] );
        $emailaddress = addslashes( $_POST['emailaddress'] );
        $phonenumber = $_POST['phonenumber'];
        $website = addslashes( $_POST['website'] );
        mysqli_query( $config, "UPDATE customers SET Names='$names',`Address`='$address',EmailAddress='$emailaddress',PhoneNumber='$phonenumber',website='$website' WHERE id='$getid'" );
        $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left"> Customer updated successfully. <a href="customers.php"><input type="submit" value="Ok"></a></div>';

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
<table style = 'border-collapse: collapse; width:98%'><tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'products.php'><img src = 'images/view.png' width = '20' height = '20' align = 'left'>Product List</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'><a href = 'newquotation.php'>New Quotation</a></td></tr>
<!--<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'proposals.php'><img src = 'images/edit.png' width = '20' height = '20' align = 'left'>Proposals</a></td></tr>
<tr style = 'border-bottom: 1px solid pink;'><td style = 'padding: 5px;'><a href = 'quotations.php'><img src = 'images/icons/NOTE06.ico' width = '20' height = '20' align = 'left'>Quotations</a></td></tr>-->
</table>
</div>
</div>
</div>
<table style = 'width:84%; float:right;'><tr><td>
<img src = 'images/customers.png' width = '40' height = '40'><br><h4>Customers</h4>
<p>
<hr color = 'cyan'></p>
<div style = 'width:50%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<th>Customer Name</th><th>&nbsp;
</th>
</tr>
<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $id = $row['id'];
    $names = $row['Names'];
    //$unitcost = $row['unitcost'];
    //$entrydate = $row['dateofentry'];
    echo '<tr align="left"><td>'.$names.'</td><td><a href="customers.php?id='.$id.'"><img src="images/edit.png" width="20" height="20"></a> <a href="customercard.php?id='.$id.'"><img src="images/view.png" width="20" height="20"></a></td></tr>';
}
?>
</table>
</div>
<div style = 'margin-left: 5px;'>
<form action = '' method = 'post'>
<table align = 'center'>
<tr><td>Customer Name:</td><td><input type = 'text' name = 'names' value = "<?php echo $getrow['Names'] ?>"></td></tr>
<tr><td>Address:</td><td><input type = 'text' name = 'address' value = "<?php echo $getrow['Address'] ?>"></td></tr>
<tr><td>Email Address:</td><td><input type = 'text' name = 'emailaddress' value = "<?php echo $getrow['EmailAddress'] ?>"></td></tr>
<tr><td>Phone Number:</td><td><input type = 'text' name = 'phonenumber' value = "<?php echo $getrow['PhoneNumber'] ?>"></td></tr>
<tr><td>Web Address:</td><td><input type = 'text' name = 'website' value = "<?php echo $getrow['website'] ?>"></td></tr>
<tr><td>Logo:</td><td><input type = 'file' name = 'image'></td></tr>
<tr><td></td><td><input type = 'submit' name = 'save' value = 'Save Customer'></td></tr>
</table>

</form>
<table width = '40%' align = 'right'><tr><td><?php echo $info ?></td></tr></table>
</div>
</td></tr></table>
</td>
</tr></table>