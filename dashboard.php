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
            <li><a class="active" href="dashboard.php">Home</a></li>  
            <li><a href="student_register.php">Register Student</a></li>
            <li><a href="student_attendance.php">View Attendance</a></li>
            <li> <a href="logout.php">Logout</a></li> 
        </ul>
    </nav>
    <div class="wrapper">
    <div class="attendence-list">
        <table class="tablecustom">
        <thead>
            <tr>
                <th>Student ID	</th>
                <th>Name		</th>
                <th>Surname		</th>
                <th>Mark <?php $currentDate = new DateTime('now');
                                $currentDate = $currentDate->format('Y-m-d'); 
                                echo "( $currentDate )";
                        ?> Attendance </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM students";
                $result = mysqli_query($conn, $sql) or die("bad query");

                if(mysqli_num_rows($result) > 0) {
                    // Loop through each row and output the data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['surname'] . "</td>";
                            echo "<td>
                                    <a href='mark_present.php?student_id=" . $row['student_id'] . "'>Present</a>
                                    <a href='mark_absent.php?student_id=" . $row['student_id'] . "'>Absent</a>
                                    <a href='mark_absent_with_reason.php?student_id=" . $row['student_id'] . "'>Valid</a>
                                </td>";
                        echo "</tr>";
                    }
                }
                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>