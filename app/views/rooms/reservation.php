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
        <input name="birthday[]" type="date" class="form-control shadow-none mb-3" required>
        <label  class="form-label" >Full Name</label>
        <input name="fullname[]" type="text" class="form-control shadow-none mb-3" required>
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
                        <label class="form-label">From</label>
                        <input name="from" type="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" class="form-control shadow-none mb-3" >
                        <label class="form-label">To</label>
                        <input name="to" type="date" value="<?= date('Y-m-d', strtotime("+1 day")) ?>" min="<?= date('Y-m-d', strtotime("+1 day")) ?>" class="form-control shadow-none">
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
        const formCount = document.getElementById("form-count").value;
        const minFormCount = 0;
        const maxFormCount = 5;

        if (formCount < minFormCount || isNaN(formCount)){
            formCount = minFormCount;
        } else if (formCount > maxFormCount){
            formCount = maxFormCount;
        }

        const formsContainer = document.getElementById("forms-container");
        formsContainer.innerHTML = ``;

        for (let i = 0; i < formCount; i++) {

            const form = document.createElement("div");
            form.innerHTML = `
            <label class="form-label">Date of Birth</label>
            <input name="birthday[]" type="date" class="form-control shadow-none mb-3" required>
            <label  class="form-label" >Full Name</label>
            <input name="fullname[]" type="text" class="form-control shadow-none mb-3" required>
            `;
            formsContainer.appendChild(form);
        }
}


</script>
