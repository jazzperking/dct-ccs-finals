<?php
$title='Students';
ob_start();
session_start();
include('../partials/header.php');
include('../partials/side-bar.php');
include '../../functions.php';

$errors = [];
$conn = connectToDatabase(); // Connect to the database

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input data
    $studentId = trim($_POST['studentId']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);

    // Validate input
    if (empty($studentId) || empty($firstName) || empty($lastName)) {
        $errors[] = "All fields are required.";
    } else {
        // Check for duplicate Student ID
        $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "Student ID already exists.";
        }
        $stmt->close();
    }

    // Insert data into the database if no errors
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, last_name) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $studentId, $firstName, $lastName);

        if ($stmt->execute()) {
            // Success: Redirect to refresh the form and show updated list
            header("Location: register.php");
            exit();
        } else {
            $errors[] = "Failed to add student. Please try again.";
        }
        $stmt->close();
    }
}

// Fetch student list from the database
$students = [];
$result = $conn->query("SELECT * FROM students");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
$conn->close();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <div class="d-flex">
        <div class="content flex-grow-1">
            <h2>Register a New Student</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
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

            <!-- Student Registration Form -->
            <div class="card p-3 mb-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="studentId">Student ID</label>
                        <input type="number" class="form-control mb-2" id="studentId" name="studentId" placeholder="Enter Student ID">
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control mb-2" id="firstName" name="firstName" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control mb-2" id="lastName" name="lastName" placeholder="Enter Last Name">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Student</button>
                </form>
            </div>

            <!-- Student List -->
            <div class="card p-3">
                <h4>Student List</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                    <td>
                                        <a href="edit.php?studentId=<?php echo $student['student_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="delete.php?studentId=<?php echo $student['student_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="attach-subject.php?studentId=<?php echo $student['student_id']; ?>" class="btn btn-warning btn-sm">Attach Subject</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php   
include('../partials/footer.php');
ob_end_flush();
?>