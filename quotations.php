<?php
include 'headers.php';
$qry = mysqli_query( $config, 'SELECT * FROM quotationids' );

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
<table style = 'border-collapse: collapse; width:98%'>
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
<hr color = 'cyan'></p>
<div style = 'width:50%; float:left; background-color:cyan'>
<table width = '100%' style = 'border-collapse: collapse; border:1px solid pink; margin-right:5px;' class = 'datatable'>
<tr bgcolor = 'pink'>
<tr><th>List of quotations</th></tr>
<table width = '100%'>
<?php
while( $row = mysqli_fetch_assoc( $qry ) ) {
    $id = $row['id'];
    $description = $row['description'];
    $customername = $row['customername'];
    $projectname = $row['projectname'];
    $quotedate = $row['quotedate'];
    $status = $row['status'];
    echo '<tr><td><a href="quotationdetails.php?id='.$id.'">'.$id.'</td><td>'.$customername.'</td><td>'.$quotedate.'</td><td>'.$status.'</td><td><a href="quotationpdf.php?id='.$id.'"><img src="images/pdf.png" width="20" height="20" align="left">Quotation'.$id.'.pdf</a></td></tr>';

}

?>
</table>

</table>
</div>

</td></tr></table>
</td>
</tr></table>