<?php

    ## Standard
    $host = "localhost";
    $username = "root";
    $passwordDB = "";
    $database = "list";
    $conn = new mysqli($host, $username, $passwordDB, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    header('Content-type: text/plain');

    ##

    $sid = $_GET['sellerID'];
    $businessName = $_GET['businessName'];
    $payableAccount = $_GET['payableAccount'];

    $sqlNewSeller = "INSERT INTO Seller (sid, Business_Name) VALUES ($sid, $businessName)";
    if ($conn->query($sqlNewSeller)==TRUE){
      echo "Successfully added new seller";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sqlNewSellerAccount = "INSERT INTO SellerPayableAccount (SellerID, PayableAccount) VALUES ($sid, $payableAccount)";
    if ($conn->query($sqlNewSellerAccount)==TRUE){
      echo "Successfully added new seller payable account";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>