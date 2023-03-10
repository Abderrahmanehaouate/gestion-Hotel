<?php require APPROOT . '/views/inc/header.admin.php';?>

<div class="container">
    <div class="row my-4">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">
                        Add Room
                    </h3>
                </div>
                <div class="card-body">
                    <form method="POST" class="mr-1"  enctype="multipart/form-data">

                        <div class="form-group mt-3">
                            <input type="text" name="title" placeholder="Title"  class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                        </div>

                        <div class="form-group mt-3">
                            <input  name="description" placeholder="Description" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>">
                            <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                        </div>

                        <div class="form-group mt-3">
                            <select class="form-select" name="type" id="select">
                                <option value="single">single</option>
                                <option value="double">double</option>
                                <option value="suite">suite...</option>
                            </select>
                        </div>

                        <div class="form-group mt-3" id="content">

                        </div>
                        
                        <div class="form-group mt-3">
                            <input type="number" min="1" placeholder="Price" name="price" class="form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                            <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <input type="file" accept="image/*" name="image" class="form-control <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['image']; ?>">
                            <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <button name="submit" class="btn btn-primary">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
                        <select class="form-select shadow-none" id="genre" name="genre">
                            <option value="Junior">Junior</option>
                            <option value="Presidential">Presidential</option>
                            <option value="Penthouse">Penthouse</option>
                            <option value="Honeymoon">Honeymoon</option>
                            <option value="Bridal">Bridal</option>
                        </select>`;
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php';?>