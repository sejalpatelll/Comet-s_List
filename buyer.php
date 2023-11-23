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
      $stmt->execute();
    }

    $conn->close();
?>