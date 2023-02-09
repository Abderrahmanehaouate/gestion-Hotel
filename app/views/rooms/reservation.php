<?php require APPROOT . '/views/inc/header.php';?>

<div class="container mt-5 mb-5 ml-10">
    <div class="row">
        <div class="col-6">
            <div class="bg-white rounded shadow">
                <form action="">
                    <div class="border bg-light p-3 rounded mb-3">

                        <h5 class="mb-3" style="font-size: 18px; text-align: center;">Take reservation</h5>
                        <label class="form-label">From</label>
                        <input type="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" class="form-control shadow-none mb-3" >
                        <label class="form-label">To</label>
                        <input type="date" value="<?= date('Y-m-d', strtotime("+1 day")) ?>" min="<?= date('Y-m-d', strtotime("+1 day")) ?>" class="form-control shadow-none">

                    </div>

                    <div class="border bg-light p-3 rounded mb-3">
                            <div class="me-2">
                                <label class="form-label">nombre des personnes</label>
                                <input type="number" min="1" max="6" class="form-control shadow-none" id="person-number">
                            </div>
                    </div>

                    <div class="border bg-light p-3 rounded mb-3">

                        <label class="form-label">date de naissance</label>
                        <input type="date" class="form-control shadow-none mb-3">
                        <label class="form-label">le nom complet</label>
                        <input type="text" class="form-control shadow-none">

                    </div>

                    <div class="col d-flex justify-content-center">
                        <input type="submit" value="Register" class="btn btn-success btn-block mb-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let input = document.getElementById('person-number');
    input.onchange = () => {
        if(isNaN(input.value) || input.value <= 0 || input.value === 'e') input.value = 1;
        if(input.value > 6) input.value = 6;
    }
</script>




<?php require APPROOT . '/views/inc/footer.php';?>