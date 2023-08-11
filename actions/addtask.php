<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["task-title"];
    $description = $_POST["task-desc"];
    $user_email = "arnele@gmail.com";
    $status = "pending";
 
    include 'connect.php';

    $sql = "INSERT INTO `time-system` (title, description, `user-email`, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $user_email, $status);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
}
?>