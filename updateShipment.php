<?php

$host = "localhost";
$username = "root";
$passwordDB = "";
$database = "list";
$conn = new mysqli($host, $username, $passwordDB, $database);

if($conn -> connect_error) {
  die("Connection failed: " . $conn -> connect_error);
}

$shipmentID = $_POST['shipmentID'];
$shipDate = $_POST['update'];
$tdate = date('Y-m-d');

if($shipDate == "shipmentSent") {
    $sql = "UPDATE Shipment 
        SET ship_date = $tdate, status='in Transit'
        WHERE shipment_id = $shipmentID;";
}
else {
    $sql = "UPDATE Shipment 
        SET arrival_date = $tdate, status='ARRIVED'
        WHERE shipment_id = $shipmentID;";
}


if ($conn->query($sql)==TRUE){
  echo "Form submitted successfully";
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>