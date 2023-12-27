<!-- <?php
        // session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once "db.con.php";

            $connection = connectToDB();

            $username = $_POST["username"];
            $password = $_POST["password"];

            // Hash the entered password for comparison
            $hashed_password = hash("sha256", $password);

            $stmt = $connection->prepare("SELECT * FROM admin WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashed_password_db = $row["password"];

                // Verify hashed password
                if ($hashed_password === $hashed_password_db) {
                    $_SESSION["username"] = $username;
                    header("Location: admin_dashboard.php");
                    echo "das"; // Redirect to admin dashboard
                    exit();
                } else {
                    $login_error = "Invalid password!";
                }
            } else {
                $login_error = "Invalid username!";
            }

            $stmt->close();
            $connection->close();
        }
        ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

    <?php if (isset($login_error)) { ?>
        <p><?php echo $login_error; ?></p>
    <?php } ?>
</body>

</html> -->