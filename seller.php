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

    $sqlNewSeller = "INSERT INTO Seller (sid, Business_Name)
                     VALUES (?, ?)";
    if($stmt = $conn->prepare($sqlNewSeller))
    {
      $stmt->bind_param("is", $sid, $businessName);
      if($stmt->execute())
      {
        echo "Successfully added new seller";
      }
      else{
        echo "Error: " . $sqlNewSeller . "<br>" . $conn->error;
      }
    }
    $stmt->close();

    $sqlNewSellerAccount = "INSERT INTO SellerPayableAccount (SellerID, PayableAccount)
                         VALUES (?, ?)";
    if($stmt = $conn->prepare($sqlNewSellerAccount))
    {
      $stmt->bind_param("is", $sid, $payableAccount);
      if($stmt->execute())
      {
        echo "Successfully added new seller payable account";
      }
      else{
        echo "Error: " . $sqlNewSellerAccount . "<br>" . $conn->error;
      }
    }
    $stmt->close();

    $conn->close();
?>