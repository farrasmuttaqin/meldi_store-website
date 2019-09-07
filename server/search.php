<?php

//CREDENTIALS FOR DB

//LET'S INITIATE CONNECT TO DB
$con = mysqli_connect("localhost", "root", "", "dbsepatu");


//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = "SELECT * FROM tb_users WHERE userFullName LIKE '%{$query}%' OR detailAlamat LIKE '%{$query}%'";
	$result = mysqli_query($con,$sql);
	$array = array();
	$subArray = array();
	while($row = mysqli_fetch_array($result))
	{
		
			$subArray['label'] = $row['userFullName'];
			$subArray['value'] = $row['detailAlamat'];
        
	}
    echo'{"fields":{"records":'.json_encode($array).'}}';   
}

?>