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

    $pid = $_GET['productID'];
    $productName = $_GET['productName'];
    $productPrice = $_GET['productPrice']; #number
    $productDescription = $_GET['productDescription'];

    $newProductQuery = "INSERT INTO Seller (pid, Product_name, Product_desc, Price) VALUES ($pid, $productName, $productDescription, $productPrice)";
    if ($conn->query($newProductQuery)==TRUE){
      echo "Successfully added new product";
    }
    else {
      echo "Error: " . $newProductQuery . "<br>" . $conn->error;
    }

    $conn->close();
?>