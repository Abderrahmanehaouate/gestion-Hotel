<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITENAME ?></title>
    <link rel="stylesheet" href="<? URLROOT ?>/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Nunito:ital,wght@1,200&family=Poppins:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,200&family=Poppins:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>


</head>
<body>
<nav style="background-color: #e3f2fd;"  class="navbar navbar-expand-lg  px-lg-3 py-lg-2 shadow-sm sticky-top ">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Hotel Elkhayer</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= URLROOT ?>/home">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="<?= URLROOT ?>/rooms/rooms">Rooms</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="<?= URLROOT ?>/rooms/contact">Contact Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="<?= URLROOT ?>/rooms/about">About</a>
            </li>
        </ul>
        <?php if(isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) ) : ?>

            <div class="d-flex" >
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2"><a class="nav-link me-2" href="<?= URLROOT ?>/users/logout">Logout</a></button>
            </div>

            <?php else : ?>

        <div class="d-flex" >
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2"><a class="nav-link me-2" href="<?= URLROOT ?>/users/login">Login</a></button>
            <button type="button" class="btn btn-outline-dark shadow-none" ><a class="nav-link me-2" href="<?= URLROOT ?>/users/register">Register</a></button>
        </div>

        <?php endif;?>

        </div>
    </div>
    </nav>
    
