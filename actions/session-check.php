<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
    header("Location:index.php");
}
$id = $_SESSION['user'];
include 'connect.php';

$sql = "SELECT username, id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_username = $row['username'];
        $user_id = $row['id'];
    }
} else {
    echo "No records found.";
}

$stmt->close();
$conn->close();

?>