<?php

$host = "localhost";
$username = "root";
$passwordDB = "";
$database = "list";
$conn = new mysqli($host, $username, $passwordDB, $database);

if($conn -> connect_error) {
  die("Connection failed: " . $conn -> connect_error);
}

$shipmentID = $_GET['shipmentID'];
$shipDate = $_GET['update'];

if($shipdate == "shipmentSent") {
    $sql = "UPDATE Shipment 
        SET ship_date = date('m/d/Y'), status='in Transit'
        WHERE shipment_id = $shipmentID;";
}
else {
    $sql = "UPDATE Shipment 
        SET arrival_date = date('m/d/Y'), status='ARRIVED'
        WHERE shipment_id = $shipmentID;";
}


if ($conn->query($sql)==TRUE){
  echo "Form submitted successfully";
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>