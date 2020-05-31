
<?php
    //Step 1: Open MySQL Database Connection in PHP
    //open connection to mysql db
    $connection = mysqli_connect("127.0.0.1","root","","2proj") or die("Error " . mysqli_error($connection));


    //Step 2: Fetch Data from MySQL Database

    //fetch table rows from mysql db
    $sql = "select * from tbl_employee";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));


    //Step 3: Convert MySQL Result Set to PHP Array

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    //Step 4: Convert PHP Array to JSON String
 
    //echo json_encode($emparray);
    
    //Step 5: Convert MySQL to JSON File in PHP

    //write to json file
    $fp = fopen('empdata.json', 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);
?>