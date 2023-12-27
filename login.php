<?php
session_start();

// Check if the user is logged in, redirect to index if true
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit();
}

require_once('php/db.con.php');

// Login form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDB();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #4F4F4F;
        }

        .unique {
            padding: 20px;
            opacity: 0;

            animation: fadeIn .5s ease forwards;

            border-radius: 15px;
            background: #4f4f4f;
            box-shadow: 5px 5px 10px #414141,
                -5px -5px 10px #5d5d5d;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;

            }
        }


        .top {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }


        @media (min-width: 768px) {
            .unique {
                width: 300px;
            }
        }
    </style>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <div class="container top ">
        <div class="row justify-content-center">
            <div class="col-md-3 border unique shadow">
                <div class="d-flex justify-content-center align-items-center flex-md-column">
                    <div class="ms-3"> <img src="images/admin.png" height="80px" alt=""></div>
                    <div>
                        <h2 class="mb-4 d-flex justify-content-center align-items-center text-light">ADMIN</h2>
                    </div>
                </div>
                <form method="post" class="text-light" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center mt-3">
                        <input type="submit" class="btn btn-success" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>

</html>

<?php
$conn = connectToDB();
$conn->close();
?>