<?php    
function connectToDatabase() {
    $server = 'localhost';
    $username = 'root';
    $userPassword = '';
    $database = 'dct-ccs-finals';

    $connection = new mysqli($server, $username, $userPassword, $database);

    if ($connection->connect_error) {
        die("Database connection failed: " . $connection->connect_error);
    }
    return $connection;
}

// Validate user login credentials
function validateLoginInputs($userEmail, $userPassword) {
    $validationErrors = [];
    $userEmail = htmlspecialchars(stripslashes(trim($userEmail)));
    $userPassword = htmlspecialchars(stripslashes(trim($userPassword)));

    if (empty($userEmail)) {
        $validationErrors[] = 'Email is required.';
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = 'Invalid email.';
    }

    if (empty($userPassword)) {
        $validationErrors[] = 'Password is required.';
    }

    return $validationErrors;
}

// Display error messages
function showErrorMessages($errorList) {
    $output = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    $output .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    $output .= '<strong>System Errors</strong>';
    $output .= '<ul>';
    foreach ($errorList as $error) {
        $output .= "<li>" . htmlspecialchars($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= '</div>';
    return $output;
}
?>
