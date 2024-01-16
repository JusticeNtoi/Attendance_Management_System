<?php
    session_start();
    include_once "connection.php";

    if(isset($_POST['submit'])) {
      $student_id = trim($_POST['student_id']);
      $name = trim($_POST['name']);
      $surname = trim($_POST['surname']);

      if(!empty($student_id) && !empty($name) && !empty($surname)) {
        $sql = mysqli_query($conn, "SELECT * FROM students WHERE student_id = {$student_id}");

        if(mysqli_num_rows($sql) > 0) {
          $error_msg = "Student ID already exist";
        } else {
          $sql2 = mysqli_query($conn, "INSERT INTO students(student_id,name,surname)
                            VALUES({$student_id},'{$name}', '{$surname}')");
          $success_msg = "New Student record successfully created";
        }
      } else {
          $error_msg = "All input fields are required!";
      }
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Signup Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body >
<div>
  <nav>
      <ul class="nav-links">
          <li><a href="dashboard.php">Home</a></li>  
          <li><a class="active" href="student_register.php">Register Student</a></li>
          <li><a href="student_attendance.php">View Attendance</a></li>
          <li> <a href="logout.php">Logout</a></li> 
      </ul>
  </nav>
</div>
<div class="register-body">
  <div class="register-wrapper">
      <section class="form signup">
          <header>Register Student</header>
          <form action="student_register.php" method="post">

              <?php if (isset($error_msg)) { ?>
              <div class="error-txt">
                  <?php echo $error_msg; ?>
              </div>
              <?php } ?>
              <?php if (isset($success_msg)) { ?>
              <div class="success-txt">
                  <?php echo $success_msg; ?>
              </div>
              <?php } ?>

              <div class="field input">
                  <label>Student ID</label>
                  <input name="student_id" type="text" placeholder="ID" required>
              </div>
              <div class="field input">
                  <label>Name</label>
                  <input name="name" type="text" placeholder="name" required>
              </div>
              <div class="field input">
                  <label>Surname</label>
                  <input name="surname" type="text" placeholder="surname" required>
              </div>
              <div class="field button">
                  <input type="submit" name="submit" value="Register">
              </div>
          </form>
      </section>
  </div>
</div>
</body>
</html>

