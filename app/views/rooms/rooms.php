<?php require APPROOT . '/views/inc/header.php'; ?>
    <!-- check avilability room -->
    <div class="container availability-form" style="margin-top: 5rem;">
<div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="col-lg-3">Check Booking Availability</h5>
        <form method="POST" action ="<?= URLROOT ?>/rooms/searchRooms">
            <div class="row align-items-end">

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-in</label>
                    <input type="date" name="Check-in" class="form-control shadow-none">
                </div>

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-out</label>
                    <input type="date" name="Check-out" class="form-control shadow-none">
                </div>

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Chambre For</label>
                    <select class="form-select " id="select" name="type">
                        <option value="single">single</option>
                        <option value="double">double</option>
                        <option value="suite">suite...</option>
                    </select>
                </div>

                <div class="col-lg-2 mb-3">
                    <div id="content">

                    </div>

                </div>
                <div class="col-lg-1 mb-lg-3 mt-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>

const select = document.getElementById('select');
const content = document.getElementById('content');

select.addEventListener('change', function() {

    const selectedValue = select.value;
    content.innerHTML = ``;
    if(selectedValue == 'suite'){
        content.innerHTML = `
                        <label class="form-label" style="font-weight: 500;">Type of Chombre</label>
                        <select class="form-select shadow-none" name="genre">
                            <option value="Junior">Junior</option>
                            <option value="Presidential">Presidential</option>
                            <option value="Penthouse">Penthouse</option>
                            <option value="Honeymoon">Honeymoon</option>
                            <option value="Bridal">Bridal</option>
                        </select>`;
    }
});

</script>

<div class="container mt-3">
    <?php echo flash('room_message'); ?>
</div>

<div class="container availability-form " style="margin-top: 2rem;">
    <div class="row overflow-scroll">
        <!-- //overflow-scroll -->
        <div class="col-lg-12 p-4 rounded">
            <h5 class="col-lg-3 mb-2">Reservation Details</h5>
            <div class="row align-items-end flex-nowrap">
                    <?php foreach ($data['reservation'] as $reservation): ?>
                    <div class="col-lg-3 mb-3">
                        <div class="card-body text-center">
                            <h6 class="card-text">Check-in: <?= $reservation->date_from ?></h6>
                            <h6 class="card-text">Check-out: <?= $reservation->date_to ?></h6>
                            <p class="card-text">Reservation Time: <?= $reservation->reserved_at ?></p>
                            <button type="button" class="btn btn-warning"> <a href="<?= URLROOT ?>/rooms/deleteReservation/<?= $reservation->id ?>" class="text-decoration-none text-white">Annuler Reservation</a></button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                
            </div>
        </div>
    </div>
</div>


<div class="container mt-5 mb-5 mb-10 ">
    <div class="row">
    <?php foreach ($data['rooms'] as $room): ?>
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="    
                max-width: 360px;
                min-width: 360px;
                max-height: 450px;
                min-height: 450px; 
                margin: auto;
                ">
                <img src="../public/img/<?= $room->image ?>" class="card-img-top img-style" alt="" style="            
                max-height: 270px;
                min-height: 270px; ">
                <div class="card-body">
                <h5 class="card-title text-center"><?= $room->title ?></h5>
                <div class="d-flex justify-content-between mt-3 mb-2 mx-2">
                <h6 class="card-title">Type : <?= $room->type ?></h6>
                <h6 class="mb-4"><?= $room->price ?>$ per night </h6>
                </div>
                    <div class="d-flex justify-content-evenly align-items-center mb-2">
                        <a href="<?= URLROOT ?>/rooms/reservation/<?= $room->type ?>/<?= $room->id ?>" class="btn btn-primary">Order Now</a>
                        <a href="" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>




















