<?php require APPROOT . '/views/inc/header.php';?>
    <!-- check avilability room -->
    <div class="container availability-form" style="margin-top: 5rem;">
<div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="col-lg-3">Check Booking Availability</h5>
        <form method="POST" action ="<?= URLROOT ?>/rooms/search" >
            <div class="row align-items-end">

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-in</label>
                    <input type="date" name="Check-in" min="<?= date('Y-m-d') ?>" class="form-control shadow-none <?php echo (!empty($data['Check-in-err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Check-in']; ?>">
                        <span class="invalid-feedback"><?php echo $data['Check-in-err']; ?></span>
                </div>

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-out</label>
                    <input type="date" name="Check-out" min="<?= date('Y-m-d', strtotime("+1 day")) ?>" class="form-control shadow-none <?php echo (!empty($data['Check-out-err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Check-out']; ?>">
                        <span class="invalid-feedback"><?php echo $data['Check-out-err']; ?></span>
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

    <div class="container mt-5 mb-5 mb-10 ">
    <div class="row">

    <?php echo flash('room_message') ?>
    <?php if(isset($data['rooms'])){ ?>

        <?php foreach($data['rooms'] as $room) :?>
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; min-with: 350px; margin: auto;">
                <img src="../public/img/<?= $room->image?>" class="card-img-top img-style" alt="">
                <div class="card-body">
                <h5 class="card-title"><?= $room->title ?></h5>
                <h6 class="mb-4"><?= $room->price ?>$ per night </h6>
                    <div class="d-flex justify-content-evenly mb-2">
                        <a href="<?= URLROOT ?>/rooms/reservation/<?= $room->type ?>/<?= $room->id ?>" class="btn btn-primary">Order Now</a>
                        <a href="" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <?php }else{ ?>
        
        <div class="alert alert-primary" role="alert">
        <h4 class="alert-heading">Looking for the perfect room for your next event?</h4>
        <p>Use our search function to easily find available rooms by selecting your preferred time, genre, and room type. Our intuitive search system will quickly show you all the available options, making it easy to find the perfect space for your needs.</p>
        <hr>
        <p class="mb-0"> simply use our search function to filter by date, genre, and room type . </p>
        </div>

<?php } ?> 
        
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>
