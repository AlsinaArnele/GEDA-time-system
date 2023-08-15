<?php
include 'connect.php';

$sql = "SELECT * FROM time WHERE user_email = ? AND time_out IS NOT NULL";
$sql2 = "SELECT * FROM `time-system` WHERE `user-email` = ? AND status='pending'";
$sql3 = "SELECT * FROM `time-system` WHERE `user-email` = ? AND status='complete'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $id); 
$stmt2->execute();
$result2 = $stmt2->get_result();

$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("s", $id); 
$stmt3->execute();
$result3 = $stmt3->get_result();

if ($result->num_rows > 0) {
    $total = 0; 
    while ($row = $result->fetch_assoc()) {
        $timeIn = strtotime($row["time_in"]);
        $timeOut = strtotime($row["time_out"]); 
        $duration = $timeOut - $timeIn;

        $total = $duration + $total;
    }
    $hours = floor($total / 3600);
    $minutes = floor(($total % 3600) / 60);
    $seconds = $total % 60;
}else{
    $hours = "00";
    $minutes = "00";
    $seconds = "00";
}
$pendingTasks = mysqli_num_rows($result2);
$completeTasks = mysqli_num_rows($result3);

$conn->close();
?>