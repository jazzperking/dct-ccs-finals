<?php
$title='Edit Subject';
ob_start(); // Start output buffering
include('../partials/header.php');
include('../partials/side-bar.php');
include('../../functions.php'); // Your DB connection function

$conn = connectToDatabase();

// Initialize variables
$subjectCode = '';
$subjectName = '';
$errorMessage = '';

// Check if subjectCode is passed for editing an existing subject
if (isset($_GET['subjectCode'])) {
    $subjectCode = $_GET['subjectCode'];

    // Fetch the subject details based on subjectCode
    $stmt = $conn->prepare("SELECT subject_code, subject_name FROM subjects WHERE subject_code = ?");
    $stmt->bind_param("s", $subjectCode);
    $stmt->execute();
    $stmt->store_result();

    // Check if subject exists in the database
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($subjectCode, $subjectName);
        $stmt->fetch();
    } else {
        // If subject is not found, redirect to the subject list page
        header("Location: add.php");
        exit();
    }
    $stmt->close();
} 

// Handle form submission for updating or adding subject
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectCode = trim($_POST['subjectCode']);
    $subjectName = trim($_POST['subjectName']);

    // Validate form inputs
    if (empty($subjectCode) || empty($subjectName)) {
        $errorMessage = 'Subject code and name are required.';
    }

    // If no errors, either update an existing subject or add a new one
    if (empty($errorMessage)) {
        if (isset($_GET['subjectCode'])) {
            // Check if the subject name is being changed to a name that already exists, but not the same subject code
            $stmt = $conn->prepare("SELECT COUNT(*) FROM subjects WHERE subject_name = ? AND subject_code != ?");
            $stmt->bind_param("ss", $subjectName, $subjectCode);
            $stmt->execute();
            $stmt->bind_result($duplicateCount);
            $stmt->fetch();
            
            if ($duplicateCount > 0) {
                $errorMessage = 'A subject with this name already exists. Please use a different name.';
            }
            $stmt->close();

            // If no duplicates, update the existing subject
            if (empty($errorMessage)) {
                $stmt = $conn->prepare("UPDATE subjects SET subject_name = ? WHERE subject_code = ?");
                $stmt->bind_param("ss", $subjectName, $subjectCode);
                if ($stmt->execute()) {
                    header("Location: add.php"); // Redirect after successful update
                    exit();
                } else {
                    $errorMessage = 'Failed to update subject. Please try again.';
                }
            }
        } else {
            // Add new subject: Check if the subject code or name already exists
            $stmt = $conn->prepare("SELECT COUNT(*) FROM subjects WHERE subject_code = ? OR subject_name = ?");
            $stmt->bind_param("ss", $subjectCode, $subjectName);
            $stmt->execute();
            $stmt->bind_result($duplicateCount);
            $stmt->fetch();
            
            if ($duplicateCount > 0) {
                $errorMessage = 'A subject with this code or name already exists. Please use a different code or name.';
            }
            $stmt->close();

            // If no duplicates, insert the new subject
            if (empty($errorMessage)) {
                $stmt = $conn->prepare("INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)");
                $stmt->bind_param("ss", $subjectCode, $subjectName);
                if ($stmt->execute()) {
                    header("Location: add.php"); // Redirect after successful insert
                    exit();
                } else {
                    $errorMessage = 'Failed to add new subject. Please try again.';
                }
            }
        }
    }
}

$conn->close();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
    <div class="d-flex">
        <div class="content flex-grow-1">
            <h2><?php echo isset($_GET['subjectCode']) ? 'Edit Subject' : 'Add Subject'; ?></h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/subject/add.php">Subjects</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo isset($_GET['subjectCode']) ? 'Edit Subject' : 'Add Subject'; ?></li>
                </ol>
            </nav>

            <!-- Display error message -->
            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
            <?php endif; ?>

            <div class="form-container">
                <form method="POST">
                    <div class="mb-3">
                        <label for="subjectCode" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="<?php echo htmlspecialchars($subjectCode); ?>" <?php echo isset($_GET['subjectCode']) ? 'readonly' : ''; ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="subjectName" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo htmlspecialchars($subjectName); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <?php echo isset($_GET['subjectCode']) ? 'Update Subject' : 'Add Subject'; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include('../partials/footer.php');
ob_end_flush(); // End output buffering
?>
