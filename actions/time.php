<?php
session_start();
if (isset($_POST['variable'])) {
    $_SESSION['time_in'] = $_POST['variable'];
    $_SESSION['time_out'] = $_POST['variable2'];
    echo $_SESSION['time_in'];
    echo $_SESSION['time_out'];
} else {
    echo "error";
}
?>
