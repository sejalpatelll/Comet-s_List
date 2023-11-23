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

    $tid = $_GET['transactionID'];
    $bid = $_GET['buyerID'];
    $sid = $_GET['sellerID'];
    $count = $_GET['productCount'];
    $tdate = date('Y-m-d');

    printf($tdate);
    printf("\n");

    $products = array();
    $productCounts = array();

    for($i=0; $i<$count; $i++)
    {
        $currentProduct = $_GET[("productID" . $i)];
        $currentProductCount = $_GET[("productCount" . $i)];
        array_push($products, $currentProduct);
        array_push($productCounts, $currentProductCount);
    }

    $sql = "INSERT INTO transaction (transaction_id, transaction_date, buyer_id, seller_id)
            Values (?, ?, ?, ?)";
    if($stmt = $conn->prepare($sql))
    {
      $stmt->bind_param("isii", $tid, $tdate, $bid, $sid);
      $stmt->execute();
    }
    $stmt->close();

    for($i=0; $i<$count; $i++)
    {
        
    }

    /*echo "<pre>";
    print_r($products);
    echo "</pre>";

    echo "<pre>";
    print_r($productCounts);
    echo "</pre>";*/

    $conn->close();
?>