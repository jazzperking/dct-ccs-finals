
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
</head>

<?php

session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $userEmail = $_POST['email'];
    $userPassword = md5($_POST['password']);

    $dbConnection = connectToDatabase(); 
    $query = $dbConnection->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->bind_param("ss", $userEmail, $userPassword);
    $query->execute();
    $queryResult = $query->get_result();

    if ($queryResult->num_rows > 0) {
        $_SESSION['loggedInUser'] = $userEmail; // Updated session variable name
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $loginError = "Invalid email or password!";
    }
    $query->close();
    $dbConnection->close();
}
?>

<body class="bg-secondary-subtle">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-4 fw-normal">Login</h1>
                    <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="user1@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            <a href="./admin/dashboard.php">button</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
include include('../partials/footer.php');
?>