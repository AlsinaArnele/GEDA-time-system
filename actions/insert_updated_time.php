<?php
include 'session-check.php';
if (isset($_POST['stopTime'])) {
    $time_out = $_POST['stopTime'];

    include 'connect.php';

    $currentDateTime = date("H:i:s");

    $sql = "UPDATE `time` SET time_out = ? WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",  $currentDateTime, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
}else {
    echo "error";
}
?>

