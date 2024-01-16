<?php
// Include database connection file
include_once("connection.php");

$student_id = $_GET['student_id'];
$currentDate = new DateTime('now');
$currentDate = $currentDate->format('Y-m-d');
$status ="X";

// Check if already marked attendance for that date
$sql = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id ={$student_id} AND attendance_date = '{$currentDate}'");
if(mysqli_num_rows($sql) > 0) {
    $sql2 = mysqli_query($conn, "UPDATE attendance SET attendance_status = '{$status}' WHERE student_id = {$student_id} AND attendance_date = '{$currentDate}'");
    header("Location: dashboard.php");
} else {
    $sql = mysqli_query($conn, "INSERT INTO attendance(student_id,attendance_date,attendance_status)
                    VALUES({$student_id},'{$currentDate}', '{$status}')");
    header("Location: dashboard.php");
}

?>

