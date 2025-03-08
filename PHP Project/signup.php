<?php
$firstname = "";
$lastname = "";
$email = "";
$gender = "";
$pass1 = "";
$pass2 = "";
$err = array();
$congra = "";
$user = "";

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['SIGNUP'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);

    // Validation
    if ($pass1 != $pass2) {
        array_push($err, "The two passwords do not match!");
    }

    $user_check_query = "SELECT * FROM users WHERE Firstname='$firstname' OR Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // Check if $user is not null
        if ($user['Firstname'] === $firstname) {
            array_push($err, "Username already exists!");
        } else if ($user['Email'] === $email) {
            array_push($err, "Email already exists!");
        }
    }

    // Finally register
    if (count($err) === 0) {
        // Store the password as plain text
        $query = "INSERT INTO users (Firstname, Lastname, Gender, Email, Passworrd) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sssss", $firstname, $lastname, $gender, $email, $pass1); // Store plain text password
            if ($stmt->execute()) {
                $congra = "You are successfully registered! Please login";
            } else {
                array_push($err, "Database error: " . $stmt->error);
            }
            $stmt->close();
        } else {
            array_push($err, "Database error: " . $conn->error);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register System</title>
    <link rel="stylesheet" href="CSS/signupstyle.css">
</head>
<body>
   <div class="box2">
    <h1>Register Here</h1>
    <div class="err">
        <?php
        if (!empty($err)) {
            foreach ($err as $error) {
                echo "<p>$error</p>";
            }
        }
        ?>
    </div>
    <?php
    echo $congra;
    ?>
    <form action="signup.php" method="post">
        <input type="text" name="firstname" placeholder="Enter firstname" required>
        <input type="text" name="lastname" placeholder="Enter lastname" required>
        <input type="email" name="email" placeholder="Enter email" required>
        <label>Gender</label>
        <input type="radio" name="gender" value="Male" required>Male
        <input type="radio" name="gender" value="Female" required>Female
        <input type="password" name="pass1" placeholder="Enter password" required>
        <input type="password" name="pass2" placeholder="Confirm password" required>
        <input type="submit" value="SIGNUP" name="SIGNUP">
        Already a member? <a href="login.php" style="color:#ffc107">LOGIN</a>
    </form>
   </div> 
</body>
</html>