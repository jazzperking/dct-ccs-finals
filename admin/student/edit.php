<?php
include('../partials/header.php');
include ('../partials/side-bar.php');

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
    <div class="content flex-grow-1">   
            <h2>Edit Student</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/student/register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>
            <div class="form-container">
                <form>
                    <div class="mb-3">
                        <label for="studentId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studentId" value="1002" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="Charlie">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="Tullao">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Student</button>
                </form>
            </div>
        </div>
    </div>
<?php
include('../partials/footer.php');
?>