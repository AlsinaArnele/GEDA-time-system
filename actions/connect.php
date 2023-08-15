<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'dca-portal';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $_SESSION['user'];
 ?>