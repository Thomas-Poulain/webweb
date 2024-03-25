<?php
include __ROOT__."/views/header.html";
?>

<body>
    <div class="card">
        <div class="card-body d-flex align-items-center">
            <div class="flex-shrink-0">
            <i class="fas fa-user fa-5x"></i>
            </div>
            <div class="flex-grow-1 ms-3">
            <h2 class="card-title"><?php echo $data[0]; ?></h2>
            <p class="card-text"><i class="fas fa-user-tag"></i> <?php echo $data[2]; ?></p>
            <p class="card-text"><i class="fas fa-graduation-cap"></i> <?php echo $data[3]; ?></p>
            <a href="/sa_usersList" class="btn btn-primary">Modifier les informations</a>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            margin: 0;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .card-text {
            margin: 0;
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #0062cc;
            border-color: #005cbf;
        }

    </style>
</body>