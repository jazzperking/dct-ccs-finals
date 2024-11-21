<?php
ob_start(); // Start output buffering to prevent headers already sent error
session_start(); // Start the session

include('../partials/header.php');
include('../partials/side-bar.php');
include('../../functions.php'); // Assuming this file contains your DB connection function

// Connect to the database
$conn = connectToDatabase();

// Get the subject code from the URL
if (isset($_GET['subjectCode'])) {
    $subjectCode = $_GET['subjectCode'];

    // Fetch the subject details based on the subject code
    $stmt = $conn->prepare("SELECT subject_code, subject_name FROM subjects WHERE subject_code = ?");
    $stmt->bind_param("s", $subjectCode);
    $stmt->execute();
    $stmt->store_result();

    // Check if the subject exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($subjectCode, $subjectName);
        $stmt->fetch();
    } else {
        // If the subject is not found, redirect to the subject list page
        header("Location: add.php");
        exit();
    }
    $stmt->close();
} else {
    // If no subject code is provided, redirect to the subject list page
    header("Location: add.php");
    exit();
}

// Handle the delete action when the button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete the subject from the database
    $stmt = $conn->prepare("DELETE FROM subjects WHERE subject_code = ?");
    $stmt->bind_param("s", $subjectCode);

    if ($stmt->execute()) {
        // Redirect to the subject list page after successful deletion
        header("Location: add.php");
        exit();
    } else {
        // Display an error message if the deletion fails
        $errorMessage = "Failed to delete subject. Please try again.";
    }
    $stmt->close();
}

$conn->close();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <div class="d-flex">
        <div class="content flex-grow-1">
            <h2>Delete Subject</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/subject/add.php">Add Subject</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <!-- Display error message if deletion fails -->
                    <?php if (isset($errorMessage)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
                    <?php endif; ?>

                    <p>Are you sure you want to delete the following subject record?</p>
                    <ul>
                        <li><strong>Subject Code:</strong> <?php echo htmlspecialchars($subjectCode); ?></li>
                        <li><strong>Subject Name:</strong> <?php echo htmlspecialchars($subjectName); ?></li>
                    </ul>
                    <form method="POST">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Subject Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('../partials/footer.php');
ob_end_flush(); // End output buffering
?>
    