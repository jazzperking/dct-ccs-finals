<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
    <div class="content flex-grow-1">
        <h2>Delete a Student</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/student/register.php">Register Student</a></li>
                <li class="breadcrumb-item"><a href="/admin/student/attach-subject.php">Attach Subject to Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detach Subject from Student</li>
            </ol>
        </nav>
        <div class="card">
            <p>Are you sure you want to detach this subject from this student record?</p>
                <ul>
                    <li><strong>Student ID:</strong> 1001</li>
                    <li><strong>First Name:</strong> Renmark</li>
                    <li><strong>Last Name:</strong> Salalila</li>
                    <li><strong>Subject Code:</strong> 1001</li>
                    <li><strong>Subject Name:</strong> English</li>
                </ul>
            <div class="d-flex">
                <button class="btn btn-secondary me-2">Cancel</button>
                <button class="btn btn-primary">Detach Subject from Student</button>
            </div>
        </div>
    </div>
</main>
<?php
include include('../partials/footer.php');
?>
