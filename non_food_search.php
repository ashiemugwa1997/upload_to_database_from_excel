<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "import_csv";
$con = new mysqli($localhost, $username, $password, $dbname);
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM non_food";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($con, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM non_food WHERE non_food_product LIKE '%$name%'";
}
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 800px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<title>NON FOOD TABLE</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
     <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a href="index.php" class="nav-link">search food table</a></li>
              <li class="nav-item active"><a href="non_food_search.php" class="nav-link">search non-food table</a></li>
              <li class="nav-item"><a href="import_from_csv.php" class="nav-link">insert into food products from csv</a></li>
              <li class="nav-item"><a href="import_nonfood_from_csv.php" class="nav-link">insert into non food products from csv</a></li>
            </ul>
          </div>
<div class="container">
<label>Search</label>
<form action="" method="GET">
<input type="text" placeholder="Type the name here" name="search"> 
<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
</form>
<h2>non food products</h2>
<table class="table table-striped table-responsive">
<tr>
<th>ID</th>
<th>non food product</th>
<th>Brand/product description</th>
<th>quantity</th>
<th>price range(min)</th>
<th>price range(max)</th>
<th>average</th>
<th>parity</th>
<th>(zar)</th>
</tr>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['non_food_product']; ?></td>
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