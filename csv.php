<?php
$query = <<<eof
    LOAD DATA INFILE '$fileName'
     INTO TABLE tableName
     FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
     LINES TERMINATED BY '\n'
     IGNORE 1 LINES
    (field1,field2,field3,etc)
eof;

$db->query($query);
?>