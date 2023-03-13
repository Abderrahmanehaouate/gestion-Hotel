<?php require APPROOT . '/views/inc/header.php'; ?>

	<style>
		/* Style for cover image */
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
				<div class="title">Contact Us</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form>
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="subject">Subject:</label>
						<input type="text" class="form-control" id="subject" name="subject" required>
					</div>
					<div class="form-group">
						<label for="message">Message:</label>
						<textarea class="form-control" id="message" name="message" rows="5" required></textarea>
					</div>
					<button type="submit" class="btn-click btn-block">Send Message</button>
				</form>
			</div>
		</div>
	</div>
























	
	<?php require APPROOT . '/views/inc/footer.php'; ?>
