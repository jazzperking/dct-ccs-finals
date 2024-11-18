<?php
include('../partials/header.php');
include ('../partials/side-bar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="d-flex">
        <div class="content flex-grow-1">
            <h2>Delete Subject</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Add Subject</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <p>Are you sure you want to delete the following subject record?</p>
                    <ul>
                        <li><strong>Subject Code:</strong> 1001</li>
                        <li><strong>Subject Name:</strong> English</li>
                    </ul>
                    <button class="btn btn-secondary">Cancel</button>
                    <button class="btn btn-primary">Delete Subject Record</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include include('../partials/footer.php');
    ?>