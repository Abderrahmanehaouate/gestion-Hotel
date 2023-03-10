<?php require APPROOT . '/views/inc/header.admin.php';?>

	<div class="container-fluid mb-5">
		<div class="row">
			<div class="col-2 d-flex justify-content-center" style="background-color: #e3f2fd;">
				<nav class="nav flex-column text-center mt-5">
				<a class="nav-link text-black" href="<?= URLROOT ?>/rooms/rooms">Rooms</a>
					<a class="nav-link text-black" href="<?= URLROOT ?>/admins/add" class="text-decoration-none"> Add Rooms<i class='bx bx-plus-circle' ></i></a>
					<a class="nav-link text-black" href="#">Rooms</a>
				</nav>
			</div>
			<div class="col-10 mt-5">
            <?php echo flash('room_message') ?>
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Users</h5>
								<p class="card-text"><?= count($data['users'])?></p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Rooms</h5>
								<p class="card-text"><?= count($data['rooms'])?></p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Reservation</h5>
								<p class="card-text"><?= count($data['reservation'])?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
						<div>
							<h4><a href="<?= URLROOT ?>/admins/add" class="text-decoration-none"> Add Rooms<i class='bx bx-plus-circle' ></i></a></h4>
						</div>
					<div class="col">
						<div class="card">
							<div class="card-header" style="background-color: #87cefa;">
								<h5 class="card-title">Recent Rooms</h5>
							</div>
							<div class="card-body">
								<table class="table">
									<thead>
										<tr class="text-start">
											<th>Title</th>
											<th>Description</th>
											<th>Price</th>
											<th>Type</th>
											<th>Genre</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data['rooms'] as $room) :?>
										<tr class="text-start">
											<td><?= $room->title ?></td>
											<td><?= $room->description ?></td>
											<td><?= $room->price ?> $</td>
											<td><?= $room->type ?></td>
											<td><?= $room->genre ?></td>
											<td><a href="<?= URLROOT ?>/admins/edit/<?= $room->id ?>" class="btn btn-sm btn-primary"><i class='bx bx-edit'></i></a></td>
											<td><a href="<?= URLROOT ?>/admins/delete/<?= $room->id ?>" class="btn btn-sm btn-danger"><i class='bx bxs-trash'></i></a></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>



				<div class="row mt-5">
					<div class="col">
						<div class="card">
							<div class="card-header" style="background-color: #8fbc8f;">
								<h5 class="card-title">Recent Reservation</h5>
							</div>
							<div class="card-body">
								<table class="table">
									<thead>
										<tr class="text-start">
											<th>Username</th>
											<th>Email</th>
											<th>Type Of Room</th>
											<th>Genre Of Room</th>
											<th>Check-in</th>
											<th>Check-out</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data['usersReservation'] as $room) :?>
										<tr class="text-start">
											<td><?= $room->name ?></td>
											<td><?= $room->email ?></td>
											<td><?= $room->type ?></td>
											<td><?= $room->genre ?></td>
											<td><?= $room->date_from ?></td>
											<td><?= $room->date_to ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="<?php echo URLROOT?>/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>