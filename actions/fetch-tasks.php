<?php
include 'connect.php';


$sql = "SELECT title, description FROM `time-system` WHERE status ='pending' ";
$sql2 = "SELECT title, description FROM `time-system` WHERE status ='complete' ";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

$html = "";
$html2 = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = $row["title"];
        $description = $row["description"];
        $html .= "
            <div class=\"tasks\">
                <h1>{$title}</h1>
                <ul>
                    <li>{$description}</li>
                </ul>
            </div>
        ";
    }
} else {
    echo "No data found.";
}
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $title2 = $row["title"];
        $description2 = $row["description"];
        $html2 .= "
            <div class=\"c-tasks\">
                <h1>{$title2}</h1>
                <ul>
                    <li>{$description2}</li>
                </ul>
            </div>
        ";
    }
} else {
    echo "No data found.";
}

$conn->close();
?>