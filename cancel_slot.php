<?php
session_start();
include 'conection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $time = $_POST['time'];
    $userEmail = $_SESSION['email'];
    $query = "DELETE FROM SlotTable WHERE booking_date = '$day' AND booking_time = '$time' AND user_email = '$userEmail'";
    $result = mysqli_query($db, $query);
    if ($result) {
        echo 'Slot canceled successfully';
    } else {
        echo 'Slot cancellation failed';
    }
}
