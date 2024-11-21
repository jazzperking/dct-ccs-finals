<?php
ob_start(); // Start output buffering to prevent headers already sent error
session_start(); // Start the session

include('../partials/header.php');
include('../partials/side-bar.php');
include('../../functions.php'); // Assuming this file contains your DB connection function

// Connect to the database
$conn = connectToDatabase();

// Initialize error messages
$errors = [];

// Handle form submission for adding a subject
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the input data
    $subjectCode = trim($_POST['subjectCode']);
    $subjectName = trim($_POST['subjectName']);

    // Validate the input
    if (empty($subjectCode) || empty($subjectName)) {
        $errors[] = "Both Subject Code and Subject Name are required.";
    } else {
        // Check if subject code or subject name already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM subjects WHERE subject_code = ? OR subject_name = ?");
        $stmt->bind_param("ss", $subjectCode, $subjectName);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $errors[] = "A subject with this code or name already exists.";
        } else {
            // Insert subject into the database
            $stmt = $conn->prepare("INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)");
            $stmt->bind_param("ss", $subjectCode, $subjectName);

            if ($stmt->execute()) {
                // Redirect to refresh the page and show updated list
                header("Location: add.php");
                exit();
            } else {
                $errors[] = "Failed to add subject. Please try again.";
            }
            $stmt->close();
        }
    }
}

// Fetch the list of subjects from the database
$subjects = [];
$result = $conn->query("SELECT * FROM subjects");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
}
$conn->close();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <div class="flex-grow-1 p-4">
        <h2>Add a New Subject</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
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

        <!-- Subject Form -->
        <div class="card p-3 mb-4">
            <form action="" method="POST">
                <!-- Prepopulate input fields with previously entered values if they exist -->
                <input type="text" class="form-control mb-3" name="subjectCode" placeholder="Subject Code" value="<?php echo isset($subjectCode) ? htmlspecialchars($subjectCode) : ''; ?>" >
                <input type="text" class="form-control mb-3" name="subjectName" placeholder="Subject Name" value="<?php echo isset($subjectName) ? htmlspecialchars($subjectName) : ''; ?>" >
                <button type="submit" class="btn btn-primary w-100">Add Subject</button>
            </form>
        </div>

        <!-- Subject List -->
        <div class="card p-3">
            <h4>Subject List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($subjects)): ?>
                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                <td><?php echo htmlspecialchars($subject['subject_name']); ?></td>
                                <td>
                                    <a href="edit.php?subjectCode=<?php echo $subject['subject_code']; ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="delete.php?subjectCode=<?php echo $subject['subject_code']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No subjects found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include('../partials/footer.php');
ob_end_flush(); // End output buffering
?>
