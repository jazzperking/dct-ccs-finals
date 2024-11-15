<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
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
            <div class="card p-3 mb-4">
                <form>
                    <input type="text" class="form-control mb-3" placeholder="Subject Code">
                    <input type="text" class="form-control mb-3" placeholder="Subject Name">
                    <button type="submit" class="btn btn-primary w-100">Add Subject</button>
                </form>
            </div>
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
                       
                            <td>1003</td>
                            <td>Science</td>
                            <td>
                        <a href="../subject/edit.php" class="btn btn-info btn-sm">Edit</a>   
                        <a href="../subject/delete.php" class="btn btn-danger btn-sm">Delete</a>
                         </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

