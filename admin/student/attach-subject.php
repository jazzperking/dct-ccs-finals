<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="content flex-grow-1">
            <h2>Attach Subject to Student</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/admin/student/register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attach Subject to Student</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <h5>Selected Student Information</h5>
                    <ul>
                        <li><strong>Student ID:</strong> 1001</li>
                        <li><strong>Name:</strong> Renmark Salalila</li>
                    </ul>
                    <hr>
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="subject1">
                            <label class="form-check-label" for="subject1">
                                1001 - English
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="subject2">
                            <label class="form-check-label" for="subject2">
                                1002 - Mathematics
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="subject3">
                            <label class="form-check-label" for="subject3">
                                1003 - Science
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Attach Subjects</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Subject List</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Grade</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1002</td>
                                <td>Mathematics</td>
                                <td>95.00</td>
                                <td>
                                <a href="/admin/student/dettach-subject.php" class="btn btn-danger">Detach Subject</a>
                                <a href="/admin/student/assigngrade.php" class="btn btn-success">Assign Grade</a>
                                </td>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include include('../partials/footer.php');
?>
