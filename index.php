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
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
</style>
<title>FOOD TABLE</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
     <nav class="navbar px-md-0 navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a href="index.php" class="nav-link">search food table</a></li>
              <li class="nav-item active"><a href="non_food_search.php" class="nav-link">search non-food table</a></li>
              <li class="nav-item"><a href="import_from_csv.php" class="nav-link">insert into food products from csv</a></li>
              <li class="nav-item"><a href="import_nonfood_from_csv.php" class="nav-link">insert into non food products from csv</a></li>
            </ul>
          </div>
        </div>
      </nav>
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
<th>parity</th>
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