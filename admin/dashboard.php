<?php
$title='Dashboard';
include('./partials/header.php');
include('./partials/side-bar.php');
include('../functions.php');
// Include functions.php to access the database connection

// Connect to the database
$conn = connectToDatabase();

// Get the count of students
$studentsCount = 0;
$subjectsCount = 0;
$failedCount = 0; // If needed to calculate failed students
$passedCount = 0; // If needed to calculate passed students

// Count the total number of students
$result = $conn->query("SELECT COUNT(*) AS student_count FROM students");
if ($result) {
    $row = $result->fetch_assoc();
    $studentsCount = $row['student_count'];
}

// Count the total number of subjects
$result = $conn->query("SELECT COUNT(*) AS subject_count FROM subjects");
if ($result) {
    $row = $result->fetch_assoc();
    $subjectsCount = $row['subject_count'];
}

// Check if 'grade' column exists in the 'students' table
$gradeColumnResult = $conn->query("SHOW COLUMNS FROM students LIKE 'grade'");

if ($gradeColumnResult->num_rows > 0) {
    // If the 'grade' column exists, run the queries for passed and failed students
    $failedResult = $conn->query("SELECT COUNT(*) AS failed_count FROM students WHERE grade < 50");
    if ($failedResult) {
        $row = $failedResult->fetch_assoc();
        $failedCount = $row['failed_count'];
    }

    $passedResult = $conn->query("SELECT COUNT(*) AS passed_count FROM students WHERE grade >= 50");
    if ($passedResult) {
        $row = $passedResult->fetch_assoc();
        $passedCount = $row['passed_count'];
    }
}

// Close the database connection
$conn->close();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2">Dashboard</h1>        
        
    <div class="row mt-5">
        <!-- Number of Subjects Card -->
        <div class="col-12 col-xl-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white border-primary">Number of Subjects:</div>
                <div class="card-body text-primary">
                    <h5 class="card-title"><?php echo $subjectsCount; ?></h5>
                </div>
            </div>
        </div>
        
        <!-- Number of Students Card -->
        <div class="col-12 col-xl-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white border-primary">Number of Students:</div>
                <div class="card-body text-success">
                    <h5 class="card-title"><?php echo $studentsCount; ?></h5>
                </div>
            </div>
        </div>
        
        <!-- Number of Failed Students Card -->
        <div class="col-12 col-xl-3">
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger text-white border-danger">Number of Failed Students:</div>
                <div class="card-body text-danger">
                    <h5 class="card-title"><?php echo $failedCount; ?></h5>
                </div>
            </div>
        </div>
        
        <!-- Number of Passed Students Card -->
        <div class="col-12 col-xl-3">
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white border-success">Number of Passed Students:</div>
                <div class="card-body text-success">
                    <h5 class="card-title"><?php echo $passedCount; ?></h5>
                </div>
            </div>
        </div>
    </div>   
</main>

<!-- Footer --> 
<?php
include('partials/footer.php');
ob_end_flush();?>
