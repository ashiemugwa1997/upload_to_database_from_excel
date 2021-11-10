<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "import_csv";
$con = new mysqli($localhost, $username, $password, $dbname);
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM food_products";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($con, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM food_products WHERE food_product LIKE '%$name%'";
}
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic Search form using mysqli</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<label>Search</label>
<form action="" method="GET">
<input type="text" placeholder="Type the name here" name="search"> 
<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
</form>
<h2>List of students</h2>
<table class="table table-striped table-responsive">
<tr>
<th>ID</th>
<th>food product</th>
<th>Brand/product description</th>
<th>quantity</th>
<th>price range(min)</th>
<th>price range(max)</th>
<th>average</th>
<th>parity (zar)</th>
<th>(zar)</th>
</tr>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['food_product']; ?></td>
    <td><?php echo $row['brand']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['price_range_min']; ?></td>
    <td><?php echo $row['price_range_max']; ?></td>
    <td><?php echo $row['average']; ?></td>
    <td><?php echo $row['parity']; ?></td>
    <td><?php echo $row['zar']; ?></td>
    </tr>
    <?php
}
?>
</table>
</div>
</body>
</html>