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

    $sqlNewProduct = "INSERT INTO Product (pid, Product_name, Product_desc, Price)
                      Values (?, ?, ?, ?)";
    if($stmt = $conn->prepare($sqlNewProduct))
    {
      $stmt->bind_param("issd", $pid, $productName, $productDescription, $productPrice);
      if($stmt->execute()){
        echo"Successfully added new product";
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    $stmt->close();

    $conn->close();
?>