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
?>