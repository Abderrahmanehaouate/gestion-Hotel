<?php require APPROOT . '/views/inc/header.admin.php';?>
            <!-- form login -->

    <div class="row mb-5">
        <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login Admin</h2>
            <p>Please fill in your credentials to log in</p>
            <form action="<?php echo URLROOT; ?>/admins/login" method="post">

            <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password: <sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="row mt-3">
                <div class="col">
                <input type="submit" value="Login" class="btn btn-success btn-block">
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>