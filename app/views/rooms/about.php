<?php require APPROOT . '/views/inc/header.php'; ?>

<style>
		.cover-image {
			background-image: url('../public/img/sasha-kaunas-67-soi7mvik-unsplash-1677335074.jpg');
			height: 400px;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
		}
		/* Style for title */
		.title {
			color: #fff;
			font-size: 36px;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			text-align: center;
			text-shadow: 2px 2px #000;
		}
		/* Style for contact form */
		form {
			margin-top: 50px;
		}
		.form-group {
			margin-bottom: 25px;
		}
		label {
			font-weight: bold;
		}
		.btn-click {
			background-color: #7F0808;
			color: #fff;
			font-size: 20px;
			padding: 10px 30px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
		}
		.btn-click:hover {
			background-color: #540505;
		}
	</style>
</head>
<body>
	<div class="container-fluid mb-5">
		<div class="row">
			<div class="col-12 cover-image">
				<div class="title">ABOUT US</div>
			</div>
		</div>

<div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>

        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
        </p>
        </div>

        <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3 class="mb-3">Lorem Ipsum doler sit</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
            </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="../public/img/about.jpg" class="w-100">
            </div>
        </div>
        </div>

        <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="../public/img/hotel.svg" width="70px">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="../public/img/customers.svg" width="70px">
                <h4 class="mt-3">200+ CUSTOMERS</h4>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="../public/img/rating.svg" width="70px">
                <h4 class="mt-3">150+ REVIEWS</h4>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="../public/img/staff.svg" width="70px">
                <h4 class="mt-3">200+ STAFFS</h4>
            </div>
            </div>
        
        </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
