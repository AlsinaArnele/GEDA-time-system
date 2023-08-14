<?php
include 'session-check.php';
include 'connect.php';

if (isset($_POST['data'])) {
    $taskId = urldecode($_POST['data']);
    $sql = "UPDATE `time-system` SET status = 'complete' WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $taskId);
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Task marked as complete."));
            echo $taskId;
        } else {
            echo json_encode(array("success" => false, "message" => "Task update failed."));
        }
        $stmt->close();
    } else {
        echo json_encode(array("success" => false, "message" => "Error."));
    }
    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Task ID not provided."));
}
?>
