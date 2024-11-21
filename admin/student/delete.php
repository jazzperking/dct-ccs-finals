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
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <p>Are you sure you want to delete the following student record?</p>
                    <ul>
                        <li><strong>Student ID:</strong> 1002</li>
                        <li><strong>First Name:</strong> Charlie</li>
                        <li><strong>Last Name:</strong> Tullao</li>
                    </ul>
                    <button class="btn btn-secondary">Cancel</button>
                    <button class="btn btn-primary">Delete Student Record</button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include('../partials/footer.php');
?>