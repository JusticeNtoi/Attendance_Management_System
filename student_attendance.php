<?php
    session_start();
    include_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul class="nav-links">
            <li><a href="dashboard.php">Home</a></li>  
            <li><a href="student_register.php">Register Student</a></li>
            <li><a class="active" href="student_attendance.php">View Attendance</a></li>
            <li> <a href="logout.php">Logout</a></li> 
        </ul>
    </nav>
    <div class="wrapper">
    <div class="attendence-list">
        <br><br><br>
        <table class="tablecustom">
        <thead>
            <tr>
                <th>Date	</th>
                <th>Student ID	</th>
                <th>Name		</th>
                <th>Surname		</th>
                <th>Status		</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM attendance
                INNER JOIN students ON students.student_id = attendance.student_id";

                $result = mysqli_query($conn, $sql) or die("bad query");
                if(mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                            echo "<td>". $row['attendance_date'] ."</td>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['surname'] . "</td>";
                            echo "<td>" . $row['attendance_status'] . "</td>";
                        echo "</tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>