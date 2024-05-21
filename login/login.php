<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Login Page</title>
</head>

<body>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../database/connect.php');

session_start();
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `SignUp` WHERE username='$username'"; 
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($row = mysqli_fetch_assoc($result)) { 
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: ../dashboard/dashboard.php'); 
        } else {
            echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Incorrect Username or Password</h4>        
          </div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Incorrect Username or Password</h4>        
      </div>';
    }
}
?>


    <h1 class="text-center">Login Page</h1>
    <div class="container mt-5">
        <section class="vh-80" style="background-color: #508bfc;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Sign in</h3>
                                <div class="container">
                                    <form  method="post">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" id="typeEmailX-2" name="username" class="form-control form-control-lg" autocomplete="off"/>
                                            <label class="form-label" for="typeEmailX-2">Username</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" autocomplete="off" />
                                            <label class="form-label" for="typePasswordX-2">Password</label>
                                        </div>

                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>