<?php

$host = "localhost";
$username = "root";
$passwordDB = "";
$database = "list";
$conn = new mysqli($host, $username, $passwordDB, $database);

if($conn -> connect_error) {
  die("Connection failed: " . $conn -> connect_error);
}

$warehouseID = $_GET['warehouseID'];
$warehouseLocation = $_GET['warehouseLocation'];
$warehouseAddress = $_GET['warehouseAddress'];

$sql = "INSERT INTO Warehouse(warehouse_id, warehouse_location, warehouse_addr) VALUES ($warehouseID, $warehouseLocation, $warehouseAddress)";

// select statement for updated values

if ($conn->query($sql)==TRUE){
  echo "Form submitted successfully";
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>