<?php
	/*
	*
	* export.php - Generates a CSV file from a MySQL query.
	* 
	* Created on: 4/16/15
	* Created by: Dan Salmon
	*
	*/

	// Import the files we need.
	require_once("db/sql.php");
	require_once("template/security.php");

	// Get the ID of the project we're exporting the products of.
	if (isset($_POST['projID'])) {
		$projID = $_POST['projID'];
	} else (
		die("Couldn't locate that project.")
	)

	$qryGetProducts = "SELECT * FROM 'tbl_products' WHERE 'project_id'=".$projID;

	// Execute query
	$rsltGetProducts = mysqli_query($conn,$qryGetProducts);


	$num_fields = mysqli_num_fields($rsltGetProducts);
	$headers = array();
	for ($i = 0; $i < $num_fields; $i++) {
	    $headers[] = mysqli_field_name($result , $i);
	}
	$fp = fopen('php://output', 'w');
	if ($fp && $result) {
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachment; filename="export.csv"');
	    header('Pragma: no-cache');
	    header('Expires: 0');
	    fputcsv($fp, $headers);
	    while ($row = $result->fetch_array(MYSQLI_NUM)) {
	        fputcsv($fp, array_values($row));
	    }
	    die;
	}


?>