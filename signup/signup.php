<?php
$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require '../database/connect.php';
    
    if (!isset($conn) || $conn === null) {
        die("Database connection not established.");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT * FROM `SignUp` WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'User already exists.';
        } else {
            // Insert new user with hashed password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO `SignUp` (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $success = true;
                header('Location: ../login/login.php');
                exit();
            } else {
                $error = 'Error creating user: ' . $conn->error;
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <title>Sign Up Page</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"><?php echo $error; ?></h4>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">User successfully registered!</h4>
        </div>
    <?php endif; ?>

    <h1 class="text-center">Sign Up Page</h1>
    <div class="container mt-5">
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" autocomplete="off" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
            <p class="link"><a href="../login/login.php">Click to Login</a></p>
        </form>
    </div>
</body>
</html>