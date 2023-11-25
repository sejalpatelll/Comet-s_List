<?php
    $host = "localhost";
    $username = "root";
    $passwordDB = "";
    $database = "list";
    $conn = new mysqli($host, $username, $passwordDB, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    header('Content-type: text/plain');

    $bid = $_GET['buyerID'];
    $fName = $_GET['firstName'];
    $lName = $_GET['lastName'];
    $address = $_GET['address'];
    $card = $_GET['creditCard'];

    $sqlBuyer = "INSERT INTO Buyer (bid, F_Name, L_Name)
                 VALUES (?, ?, ?)";
    if($stmt = $conn->prepare($sqlBuyer))
    {
      $stmt->bind_param("iss", $bid, $fName, $lName);
      if($stmt->execute())
      {
        echo "Form submitted successfully";
      }
      else{
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    $stmt->close();

    $sqlAddress = "INSERT INTO Buyer_Addresses (BuyerID, Buyer_Address)
                   VALUES (?, ?)";
    if($stmt = $conn->prepare($sqlAddress))
    {
      $stmt->bind_param("is", $bid, $address);
      $stmt->execute();
    }
    $stmt->close();

    $sqlCard = "INSERT INTO Buyer_Cards (BuyerID, Buyer_Card)
                   VALUES (?, ?)";
    if($stmt = $conn->prepare($sqlCard))
    {
      $stmt->bind_param("is", $bid, $card);
      $stmt->execute();
    }

    $conn->close();
?>