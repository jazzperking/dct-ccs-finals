<?php
$title='Edit Students';
ob_start(); // Start output buffering to prevent headers already sent error
session_start(); // Start the session

include('../partials/header.php');
include('../partials/side-bar.php');
include '../../functions.php';

// Check if student ID is provided via GET parameter
if (isset($_GET['studentId'])) {
    $studentId = $_GET['studentId'];

    // Connect to the database
    $conn = connectToDatabase();

    // Fetch student details from the database based on studentId
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the student exists, populate the form fields
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $firstName = $student['first_name'];
        $lastName = $student['last_name'];
    } else {
        // Redirect if student not found
        header("Location: register.php");
        exit();
    }
    $stmt->close();

    // Handle form submission for editing student
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect input data
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);

        // Validate input
        if (empty($firstName) || empty($lastName)) {
            $errors[] = "First name and last name are required.";
        }

        // If no errors, update the student details
        if (empty($errors)) {
            $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ? WHERE student_id = ?");
            $stmt->bind_param("ssi", $firstName, $lastName, $studentId);

            if ($stmt->execute()) {
                // On success, redirect to register.php to show updated student list
                header("Location: register.php");
                exit();
            } else {
                $errors[] = "Failed to update student. Please try again.";
            }
            $stmt->close();
        }
    }

    $conn->close();
} else {
    // Redirect if no studentId is provided
    header("Location: register.php");
    exit();
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <div class="content flex-grow-1">
        <h2>Edit Student</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
            </ol>
        </nav>

        <!-- Display Errors -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Edit Student Form -->
        <div class="form-container">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="studentId" value="<?php echo htmlspecialchars($studentId); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Student</button>
            </form>
        </div>
    </div>
</main>

<?php
include('../partials/footer.php');
ob_end_flush(); // End output buffering
?>
