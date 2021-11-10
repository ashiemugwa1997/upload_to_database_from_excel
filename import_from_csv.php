<?php
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $product_id = "";
            if (isset($column[0])) {
                $product_id = mysqli_real_escape_string($conn, $column[0]);
            }
            $food_product = "";
            if (isset($column[1])) {
                $food_product = mysqli_real_escape_string($conn, $column[1]);
            }
            $brand = "";
            if (isset($column[2])) {
                $brand = mysqli_real_escape_string($conn, $column[2]);
            }
            $quantity = "";
            if (isset($column[3])) {
                $quantity = mysqli_real_escape_string($conn, $column[3]);
            }
            $price_range_min = "";
            if (isset($column[4])) {
                $price_range_min = mysqli_real_escape_string($conn, $column[4]);
            }
            $price_range_max = "";
            if (isset($column[5])) {
                $price_range_max = mysqli_real_escape_string($conn, $column[5]);
            }
            $average = "";
            if (isset($column[6])) {
                $average = mysqli_real_escape_string($conn, $column[6]);
            }

            $parity = "";
            if (isset($column[7])) {
                $parity = mysqli_real_escape_string($conn, $column[7]);
            }

             $zar = "";
            if (isset($column[8])) {
                $zar = mysqli_real_escape_string($conn, $column[8]);
            }

            $sqlInsert = "INSERT into food_products (product_id,food_product,brand,quantity,price_range_min,price_range_max,average,parity,zar)
                   values (?,?,?,?,?,?,?,?,?)";
            $paramType = "isssiiiii";
            $paramArray = array(
                
                $product_id,
                $food_product,
                $brand,
                $quantity,
                $price_range_min,
                $price_range_max,
                $average,
                $parity,
                $zar
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">search food table</a></li>
              <li class="nav-item active"><a href="non_food_search.php" class="nav-link">search non-food table</a></li>
              <li class="nav-item"><a href="import_from_csv.php" class="nav-link">insert into food products from csv</a></li>
              <li class="nav-item"><a href="import_nonfood_from_csv.php" class="nav-link">insert into non food products from csv</a></li>
            </ul>
          </div>
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
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM food_products";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='userTable'>
            <thead>
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
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
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
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>

</html>