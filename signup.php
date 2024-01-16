<?php
    session_start();
    include_once "connection.php";

    if(isset($_POST['submit'])) {
        $teacher_id = $_POST['teacher_id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($teacher_id) && !empty($name) && !empty($surname) && !empty($email) && !empty($password)) {
            $sql = mysqli_query($conn, "SELECT * FROM teachers WHERE teacher_id = {$teacher_id}");
            if(mysqli_num_rows($sql) > 0) {
                $error_msg = "ID already exist";
            } else {
                $sql2 = mysqli_query($conn, "INSERT INTO teachers (teacher_id, name, surname, email, password)
                                                VALUES ({$teacher_id},'{$name}', '{$surname}', '{$email}', '{$password}')");
                if($sql2)
                {
                    $_SESSION['email'] = $email;
                    header("Location: dashboard.php");
                }
                else
                {
                    $error_msg = "failed to register!";
                }
            }
        } else {
            $error_msg = "All input fields are required!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="signup-body">
    <div class="signup-wrapper">
        <section class="form signup">
            <header>Sign up</header>
            <form action="signup.php" method="post">

                <?php if (isset($error_msg)) { ?>
                <div class="error-txt">
                    <?php echo $error_msg; ?>
                </div>
                <?php } ?>

                <div class="name-details">
                    <div class="field input">
                        <label>Teacher ID</label>
                        <input name="teacher_id" type="text" placeholder="ID" required>
                    </div>
                    <div class="field input">
                        <label>Name</label>
                        <input name="name" type="text" placeholder="name" required>
                    </div>
                    <div class="field input">
                        <label>Surname</label>
                        <input name="surname" type="text" placeholder="surname" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email</label>
                    <input name="email" type="text" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input name="password" type="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Sign in">
                </div>
            </form>
            <div class="link">Back to Login: <a href="login.php">Login now</a></div>
        </section>
    </div>


</body>
</html>