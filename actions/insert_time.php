<?php
include 'session-check.php';

if (isset($_POST['startTime'])) {
    $id = $_SESSION['user'];
    
    include 'connect.php';

    $currentTime = date("H:i:s");
    $currentDate = date("Y-m-d");

    $checkSql = "SELECT * FROM `time` WHERE user_email = ? AND date = ?";
    $checkStmt = $conn->prepare($checkSql);
    
    if ($checkStmt) {
        $checkStmt->bind_param("ss", $id, $currentDate);
        $checkStmt->execute();
        
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $response = "Error: Cannot have two sessions in a day.";
            echo json_encode($response);
        } else {
            $sql = "INSERT INTO `time` (user_email, time_in, date) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("sss", $id, $currentTime,$currentDate);
                $stmt->execute();
                $stmt->close();
            } else {
                $response = "Error: Statement preparation error.";
                echo json_encode($response);
            }
            $response = "Success: Session started successfully.";
            echo json_encode($response);
            $conn->close();
            
            header("Location: ../index.php");
            exit();
        }

        $checkStmt->close();
    } else {
        $response = "Error: Statement preparation error.";
        echo json_encode($response);
    }
} else {
    $response = "Error: Error.";
    echo json_encode($response);
}
?>

