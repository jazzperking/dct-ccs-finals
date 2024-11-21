<?php
$title='Delete Students';
ob_start(); // Start output buffering to prevent headers already sent errors
session_start(); // Ensure session starts before any output

include('../partials/header.php');
include('../partials/side-bar.php');
include '../../functions.php';

$conn = connectToDatabase(); // Connect to the database

// Check if the studentId is passed
if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];

    // Fetch the student information
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "<p class='alert alert-danger'>Student not found.</p>";
    } else {
        // Show confirmation form
        ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
            <div class="content flex-grow-1">
                <h2>Delete a Student</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-body">
                        <p>Are you sure you want to delete the following student record?</p>
                        <ul>
                            <li><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></li>
                            <li><strong>First Name:</strong> <?php echo htmlspecialchars($student['first_name']); ?></li>
                            <li><strong>Last Name:</strong> <?php echo htmlspecialchars($student['last_name']); ?></li>
                        </ul>
                        <a href="register.php" class="btn btn-secondary">Cancel</a>
                        <a href="delete.php?studentId=<?php echo $student['student_id']; ?>&confirm=true" class="btn btn-danger">Delete Student Record</a>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }

    $stmt->close();
}

// Process deletion if confirmed
if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    // Get the studentId from the URL
    $studentId = $_GET['studentId'];

    // Prepare the delete query
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("i", $studentId);

    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect after successful deletion
        header("Location: register.php");
        exit(); // Important to call exit() after a header redirect to stop script execution
    } else {
        echo "<p class='alert alert-danger'>Error deleting student. Please try again.</p>";
    }

    $stmt->close();
}

include('../partials/footer.php');
$conn->close();
ob_end_flush(); // End output buffering
?>



