<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="content flex-grow-1">
            <h2>Assign Grade to Subject</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/student/register.php">Register Student</a></li>
                    <li class="breadcrumb-item"><a href="/admin/student/attach-subject.php">Attach Subject to Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Assign Grade to Subject</li>
                </ol>
            </nav>
            <div class="card" style="margin: 20px;">    
            <h5 style="margin-bottom: 15px;">Selected Student and Subject Information</h5>
            <ul style="margin-bottom: 15px;">
                <li><strong>Student ID:</strong> 1001</li>
                <li><strong>Name:</strong> Renmark Salalila</li>
                <li><strong>Subject Code:</strong> 1001</li>
                <li><strong>Subject Name:</strong> English</li>
            </ul>
            <form>
                <div class="mb-3" style="margin-bottom: 15px;">
                    <label for="grade" class="form-label">Grade</label>
                    <input type="number" class="form-control" id="grade" value="99.00">
                </div>
                <div class="mb-5" style="margin-top: 15px;">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Grade to Subject</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
<?php
include('../partials/footer.php');
?>

