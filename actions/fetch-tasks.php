<?php
include 'connect.php';

$sql = "SELECT id, title,  `description` FROM `time-system` WHERE status ='pending' ";
$sql2 = "SELECT id, title,  `description` FROM `time-system` WHERE status ='complete' ";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

$html = "";
$html2 = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $title = $row["title"];
        $description = $row["description"];
        $html .= "
            <div class=\"tasks\" title=\"Click to complete task\" onclick=\"sendTask()\">
                <h1 style=\"display:none;\" id=\"idPlaceholder\">{$id}</h1>
                <h1>{$title}</h1>
                <ul>
                    <li>{$description}</li>
                </ul>
            </div>
        ";
    }
}
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $id2 = $row2["id"];
        $title2 = $row2["title"];
        $description2 = $row2["description"];
        $html2 .= "
            <div class=\"c-tasks\">
                <h1>{$title2}</h1>
            </div>
        ";
    }
}
$conn->close();
?>