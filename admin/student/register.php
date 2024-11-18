<?php
include('../partials/header.php');
include('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
    <body>
        <div class="d-flex">
            <div class="content flex-grow-1">
                <h2>Register a New Student</h2>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
                </ol>
                </nav>
                <div class="card p-3 mb-4">
                    <form action="/admin/student/update.php" method="POST">
                        <div class="form-group">
                            <label for="studentId">Student ID</label>
                            <input type="text" class="form-control mb-2" id="studentId" name="studentId" value="1002" readonly>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control mb-2" id="firstName" name="firstName" value="Charlie">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control mb-2" id="lastName" name="lastName" value="Tullao">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Student</button>
                    </form>
                </div>
                <div class="card p-3">
                    <h4>Student List</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1002</td>
                                <td>Charlie</td>
                                <td>Tullao</td>
                                <td>
                                    <a href="/admin/student/edit.php" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="/admin/student/delete.php?" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="/admin/student/attach-subject.php?" class="btn btn-warning btn-sm">Attach Subject</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</main>
<?php
include('../partials/footer.php');
?>
