<?php require APPROOT . '/views/inc/header.php'; ?>

<style>
    .bg-image{
        background: url('./public/img/lycs-architecture-kUdbEEMcRwE-unsplash (1).jpg') no-repeat center center /cover;
        height: 600px;
        filter: blur(2px);
        -webkit-filter: blur(1px);
    }
    .bg-text{
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.4);
    color: white;
    border: 3px solid #f1f1f1;
    border-radius: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    width: 80%;
    padding: 20px;
    text-align: center;
    }

</style>


<div class="bg-image d-flex justify-content-center align-items-center"></div>
<div>
<div class="bg-text"> <h1> Welcom To Hotel Elkhayer </h1 class="fw-bold font-monospace text-white-50"> <br><span class="bg-success rounded-2 "><a href="<?= URLROOT ?>/rooms/rooms" class="text-decoration-none px-2 text-white" >Get Started With Us</a>
</span></div>
</div>









<?php require APPROOT . '/views/inc/footer.php'; ?>
