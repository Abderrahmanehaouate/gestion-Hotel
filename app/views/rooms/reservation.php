<?php require APPROOT . '/views/inc/header.php';?>
<?php

    $param = explode("/",$_GET['url'])[2];

if($param == 'suite') {
    $formFields = '
        <div class="border bg-light p-3 rounded mb-3">
            <div class="me-2">
                <label class="form-label">nombre des personnes</label>
                <input type="number" id="form-count" onchange="createForms()" class="form-control ">
            </div>
        </div>
        <div class="border bg-light p-3 rounded mb-3" id="forms-container"></div>
    ';
} elseif($param == 'double') {
        $formFields = '
        <label class="form-label">Date of Birth</label>
        <input name="birthday[]" type="date" class="form-control shadow-none mb-3 " required>
        <label  class="form-label" >Full Name</label>
        <input name="fullname[]" type="text" class="form-control shadow-none mb-3 " required>
        ';
}else{
    $formFields ='';
}
?>

<div class="container mt-5 mb-5 ml-10">
    <div class="row justify-content-center">
        <div class="col-6">
        <?php echo flash('room_message') ?>
            <div class="bg-white rounded shadow">
                <form method="POST" action="">
                    <div class="border bg-light p-3 rounded mb-3">
                        <h5 class="mb-3" style="font-size: 18px; text-align: center;">Take reservation</h5>
                        <label class="form-label">Check-in</label>
                        <input name="from" type="date" min="<?= date('Y-m-d') ?>" class="form-control shadow-none <?php echo (!empty($data['date_from_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($data['date_from'])) ? $data['date_from'] : '';?>" >
                        <span class="invalid-feedback"><?php echo $data['date_from_err']; ?></span>
                        <label class="form-label">Check-out</label>
                        <input name="to" type="date" min="<?= date('Y-m-d', strtotime("+1 day")) ?>" class="form-control shadow-none <?php echo (!empty($data['date_to_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo (isset($data['date_from'])) ? $data['date_from'] : '';?>">
                        <span class="invalid-feedback"><?php echo $data['date_to_err']; ?></span>
                    </div>
                    <?php echo $formFields; ?>
                    <div class="col d-flex justify-content-center">
                        <input type="submit" value="Register" class="btn btn-success btn-block mb-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function createForms() {
        const formCount = document.getElementById("form-count");
        const minFormCount = 0;
        const maxFormCount = 5;

        if (formCount.value < minFormCount || isNaN(formCount.value)){
            formCount.value = minFormCount;
        } else if (formCount.value > maxFormCount){
            formCount.value = maxFormCount;
        }

        const formsContainer = document.getElementById("forms-container");
        formsContainer.innerHTML = ``;

        for (let i = 0; i < formCount.value; i++) {

            const form = document.createElement("div");
            form.innerHTML = `
            <label class="form-label">Date of Birth</label>
            <input name="birthday[]" type="date" class="form-control shadow-none mb-3" >
            <label  class="form-label" >Full Name</label>
            <input name="fullname[]" type="text" class="form-control shadow-none mb-3" >
            `;
            formsContainer.appendChild(form);
        }
}


</script>
