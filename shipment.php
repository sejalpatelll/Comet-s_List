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
    $associatedWarehouse = $_POST['associatedWarehouse'];
    $productCount = $_POST['productCount'];

    $currentDate = date('Y-m-d');

    $sqlShipment = "INSERT INTO Shipment (shipment_id, order_date, ship_date, arrival_date, status)
                                VALUES (?, ?, null, null, 'TRANSIT')";
    if($stmt = $conn->prepare($sqlShipment)) {
        $stmt->bind_param("is", $shipmentID, $currentDate);
        if($stmt->execute()) {
            echo "Shipment added to database\n";
        } else {
            echo "Error: " . $conn->error . "\n";
        }
    }

    if(isset($_POST['isIncomingShipment'])) {
        $sourceAddress = $_POST['sourceAddress'];
        $sellerID = $_POST['sellerID'];
        $sqlIncomingShipment = "INSERT INTO incomingShipment (shipment_id, order_date, seller_id, source_address, warehouse_id)
                                    VALUES (?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($sqlIncomingShipment)) {
            $stmt->bind_param("isisi", $shipmentID, $currentDate, $sellerID, $sourceAddress, $associatedWarehouse);
            if($stmt->execute()) {
                echo "Incoming Shipment added to database\n";
            } else {
                echo "Error: " . $conn->error . "\n";
            }
        }
        $stmt->close();
        for ($i = 0; $i < $productCount; $i++) {
            $productID = $_POST['productID' . $i];
            $productXCount = $_POST['productCount' . $i];
            $sqlIncomingShipmentProduct = "INSERT INTO incomingShipmentProducts (shipment_id, seller_id, product_id, count)
                                                VALUES (?, ?, ?, ?)";
            if($stmt = $conn->prepare($sqlIncomingShipmentProduct)) {
                $stmt->bind_param("iiii", $shipmentID, $sellerID, $productID, $productXCount);
                if($stmt->execute()) {
                    echo "Incoming Shipment Product added to database\n";
                } else {
                    echo "Error: " . $conn->error . "\n";
                }
            }
            $stmt->close();
        }
    } else {
        $buyerID = $_POST['buyerID'];
        $sqlOutgoingShipment = "INSERT INTO outgoingShipment (shipment_id, order_date, buyer_id, warehouse_id)
                                    VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sqlOutgoingShipment)) {
            $stmt->bind_param("isii", $shipmentID, $currentDate, $buyerID, $associatedWarehouse);
            if ($stmt->execute()) {
                echo "Outgoing Shipment added to database\n";
            } else {
                echo "Error: " . $conn->error . "\n";
            }
        }
        $stmt->close();
        for ($i = 0; $i < $productCount; $i++) {
            $productID = $_POST['productID' . $i];
            $productXCount = $_POST['productCount' . $i];
            $sqlOutgoingShipmentProduct = "INSERT INTO outgoingShipmentProducts (shipment_id, buyer_id, product_id, count)
                                                VALUES (?, ?, ?, ?)";
            if ($stmt = $conn->prepare($sqlOutgoingShipmentProduct)) {
                $stmt->bind_param("iiii", $shipmentID, $buyerID, $productID, $productXCount);
                if ($stmt->execute()) {
                    echo "Outgoing Shipment Product added to database\n";
                } else {
                    echo "Error: " . $conn->error . "\n";
                }
            }
            $stmt->close();
        }
    }

    $conn->close();

?>