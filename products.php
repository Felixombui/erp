<?php
include 'headers.php';
$getid = $_GET['id'];
$cartqry = mysqli_query( $config, 'SELECT * FROM cart' );
$cartitems = mysqli_num_rows( $cartqry );
$getqry = mysqli_query( $config, "SELECT * FROM products WHERE id='$getid'" );
$getrow = mysqli_fetch_assoc( $getqry );
$qry = mysqli_query( $config, 'SELECT * FROM products' );
if ( isset( $_POST['save'] ) ) {
    if ( empty( $getid ) ) {
        $productname = addslashes( $_POST['productname'] );
        $unitcost = addslashes( $_POST['unitcost'] );
        $date = date( 'd/m/Y' );
        if ( empty( $productname ) ) {
            $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the product name!</div>';
        } else {
            if ( empty( $unitcost ) ) {
                $info = '<div class="error"><img src="images/error.png" width="20" height="20" align="left"> You must enter the product unit cost!</div>';

            } else {
                mysqli_query( $config, "INSERT INTO products(productname,unitcost,dateofentry) VALUES('$productname','$unitcost','$date')" );
                $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left"> Product saved successfully. <a href="products.php"><input type="submit" value="Ok"></a></div>';
                //header( 'location:products.php' );
            }
        }
    } else {
        $productname = addslashes( $_POST['productname'] );
        $unitcost = addslashes( $_POST['unitcost'] );
        $date = date( 'd/m/Y' );
        mysqli_query( $config, "UPDATE products SET productname='$productname',unitcost='$unitcost',dateofentry='$date' WHERE id='$getid'" );
        $info = '<div class="success"><img src="images/success.png" width="20" height="20" align="left"> Product updated successfully. <a href="products.php"><input type="submit" value="Ok"></a></div>';

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
<img src = 'images/view.png' width = '40' height = '40'><br><h4>Products</h4>
<p>
<div align = 'left'><a href = 'productsales.php'><img src = 'images/emptycart.png' width = '20' height = '20' align = 'left'><?php echo $cartitems ?></a></div>
<hr color = 'cyan'></p>
<div style = 'width:60%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<th>Product Name</th><th>Unit Cost</th><th>Entry Date</th><th>&nbsp;
</th>
</tr>
<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $id = $row['id'];
    $productname = $row['productname'];
    $unitcost = $row['unitcost'];
    $entrydate = $row['dateofentry'];
    echo '<tr align="left"><td>'.$productname.'</td><td>'.number_format( $unitcost, 2 ).'</td><td>'.$entrydate.'</td><td><a href="products.php?id='.$id.'"><img src="images/edit.png" width="20" height="20"></a> | <a href="addcart.php?id='.$id.'"><img src="images/emptycart.png" width="20" height="20"></a> | <a href="deleteproduct.php?id='.$id.'"><img src="images/delete.ico" width="20" height="20"></a></td></tr>';
}
?>
</table>
</div>
<div style = 'margin-left: 5px;'>
<form action = '' method = 'post'>
<table align = 'center'>
<tr><td>Product Name:</td><td><input type = 'text' name = 'productname' value = "<?php echo $getrow['productname'] ?>"></td></tr>
<tr><td>Unit Cost</td><td><input type = 'text' name = 'unitcost' value = "<?php echo $getrow['unitcost'] ?>"></td></tr>
<tr><td></td><td align = 'right'><input type = 'submit' name = 'save' value = 'Save Product'></td></tr>
</table>

</form>
<table width = '40%' align = 'right'><tr><td><?php echo $info ?></td></tr></table>
</div>
</td></tr></table>
</td>
</tr></table>