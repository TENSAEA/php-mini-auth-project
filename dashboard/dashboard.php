
<?php
//include auth_session.php file on all user panel pages
include("../session/auth_session.php");
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <title>Dashboard Page</title>
</head>

<body>

<div class="form container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <p class="h4">Hey, <?php echo $_SESSION['username']; ?>!</p>
            <p>You are now on the user dashboard page.</p>
            <p><a class="btn btn-primary" href="../logout.php">Logout</a></p>
        </div>
    </div>
</div>

    
</body>

</html>