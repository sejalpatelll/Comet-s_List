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
$shipDate = $_GET['shipmentSent'];
$arriveDate = $_GET['shipmentArrived'];

if(!empty($shipDate)) {
    $sql = "UPDATE Shipment 
        SET ship_date = $shipDate, status='in Transit'
        WHERE shipment_id = $shipmentID;";
}
else {
    $sql = "UPDATE Shipment 
        SET arrival_date = $arriveDate, status='ARRIVED'
        WHERE shipment_id = $shipmentID;";
}


if ($conn->query($sql)==TRUE){
  echo "Form submitted successfully";
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>