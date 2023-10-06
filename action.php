<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST["day"];
    $time = $_POST["time"];
    $title=$_POST["title"];
    $description = $_POST["description"];
    $res="INSERT INTO `SlotTable` (`booking_date`, `booking_time`,`user_email`, `booking_title`, `booking_des`) VALUES ('$day', '$time','{$_SESSION['email']}','$title', '$description')";
    $result = mysqli_query($db, $res);
    if($result)
    {
        header('Location: week.php');

    }

}
echo "hh";

?>
