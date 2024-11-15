<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
<div class="d-flex">
        <div class="content flex-grow-1">
            <h2>Edit Subject</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Add Subject</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
                </ol>
            </nav>
            <div class="form-container">
                <div class="mb-3">
                    <label for="subjectId" class="form-label">Subject ID</label>
                    <input type="text" class="form-control" id="subjectId" value="1002" readonly>
                </div>
                <div class="mb-3">
                    <label for="subjectName" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" id="subjectName" value="Mathematics">
                </div>
                <button type="button" class="btn btn-primary w-100">Update Subject</button>
            </div>
        </div>
    </div>