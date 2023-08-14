<?php
include 'session-check.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["task-title"];
    $description = $_POST["task-desc"];
    $status = "pending";
 
    include 'connect.php';

    $sql = "INSERT INTO `time-system` (title, description, `user-email`, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $id, $status);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
}
?>