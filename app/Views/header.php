<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Post Website</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/503516ccb2.js" crossorigin="anonymous"></script>

    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>
<body>
    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item home-nav-item">
                <a class="nav-link" aria-current="page" href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="nav-item home-nav-item">
                <a class="nav-link" href="<?php echo base_url('post/list'); ?>">View Post List</a>
            </li>
            <li class="nav-item home-nav-item">
                <a class="nav-link" href="<?php echo base_url('post/create'); ?>">Add New Job Post</a>
            </li>
            <?php if (!empty($user_id)): ?>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="<?php echo base_url('profile'); ?>"><?php echo $user->first_name.' '.$user->last_name; ?></a>
                </li>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="<?php echo base_url('login'); ?>">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

<!-- Modal -->
<form action="<?php echo base_url('logout'); ?>" method="get">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="logout_btn" value="true" class="btn btn-primary">Yes, Logout</button>
                </div>
            </div>
        </div>
    </div>
</form>
