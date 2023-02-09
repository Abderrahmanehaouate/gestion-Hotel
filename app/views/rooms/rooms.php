<?php require APPROOT . '/views/inc/header.php';?>
    <!-- check avilability room -->
    <div class="container availability-form" style="margin-top: 5rem;">
<div class="row">
    <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="col-lg-3">Check Booking Availability</h5>
        <form>
            <div class="row align-items-end">

                <!-- <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-in</label>
                    <input type="date" class="form-control shadow-none">
                </div>

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Check-out</label>
                    <input type="date" class="form-control shadow-none">
                </div> -->

                <div class="col-lg-3 mb-3">
                    <label class="form-label" style="font-weight: 500;">Chambre For</label>
                    <select class="form-select " onchange="select()"; id="1">

                        <option value="1">single</option>
                        <option value="2">double</option>
                        <option value="3">suite...</option>
                    </select>
                </div>

                <div class="col-lg-2 mb-3" id="id2">
                    <label class="form-label" style="font-weight: 500;">Type of Chombre</label>
                    <select class="form-select shadow-none">
                        
                        <option value="1">Junior</option>
                        <option value="2">Presidential</option>
                        <option value="3">Penthouse </option>
                        <option value="3">Honeymoon  </option>
                        <option value="3">Bridal  </option>
                    </select>
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
    function select(){
            let x = document.getElementById("1").value;
    if(x==3 ){
        document.getElementById("id2").style.display= "block";
    }else {
        document.getElementById("id2").style.display= "none";
    }
    }

</script>
<style>
    #id2{
        display: none ;
    }
</style>



<div class="container mt-5 mb-10 ">
    <div class="row">
    <?php echo flash('room_message') ?>
    <?php foreach($data['rooms'] as $room) :?>

        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="../public/img/<?= $room->image?>" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title"><?= $room->title ?></h5>
                <h6 class="mb-4"><?= $room->price ?>$ per night </h6>
                    <div class="d-flex justify-content-evenly mb-2">
                        <a href="<?= URLROOT ?>/rooms/reservation" class="btn btn-primary">Order Now</a>
                        <a href="<?= URLROOT ?>/rooms/edit" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>




















