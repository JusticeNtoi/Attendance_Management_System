<?php
    session_start();
    include_once "connection.php";

    if (isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(!empty($email) && !empty($password)) {
            $sql = mysqli_query($conn, "SELECT * FROM teachers WHERE email = '{$email}' AND password = '{$password}'");
            if(mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['email'] = $row['email'];
                header("Location: dashboard.php");
            }
            else {
                $error_msg = "Email or Password is incorrect!";
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
<body class="login-body">
    <div class="login-wrapper">
        <section class="form login">
            <header>Login</header>
            <form action="login.php" method="post">
                
                <?php if (isset($error_msg)) { ?>
                <div class="error-txt">
                    <?php echo $error_msg; ?>
                </div>
                <?php } ?>

                <div class="field input">
                    <label>Email Address</label>
                    <input name="email" type="text" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input name="password" type="password" placeholder="Enter your password" required>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
            <div class="link"><a href="signup.php">Sign up</a></div>
        </section>
    </div>
</body>
</html>