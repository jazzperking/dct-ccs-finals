<?php
session_start();

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Destroy session and log out
    session_unset();
    session_destroy();

    // Redirect to login page after logging out
    header("Location: /index.php");  // Make sure this path is correct
    exit();
} else {
    // Show confirmation message
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Logout Confirmation</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container d-flex justify-content-center align-items-center vh-100'>
            <div class='card shadow-lg p-4' style='max-width: 500px; width: 100%;'>
                <div class='card-header text-center'>
                    <h4 class='mb-0'>Are you sure you want to log out?</h4>
                </div>
                <div class='card-body text-center'>
                    <div class='d-flex justify-content-center gap-3'>
                        <a href='logout.php?confirm=yes' class='btn btn-danger'>
                            <i class='fas fa-sign-out-alt'></i> Yes, Log Out
                        </a>
                        <a href='dashboard.php' class='btn btn-primary'>
                            <i class='fas fa-times'></i> No, Stay Logged In
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}
?>
