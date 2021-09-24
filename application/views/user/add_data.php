<!-- Page Heading -->
<header class="bg-white mb-4" id="title">
    <div class="mx-auto py-4">
        <h5 class="font-semibold text-gray-800 pl-5">
            <?= $title ?>
        </h5>
    </div>
</header>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?= base_url('member') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <p></p>
    <div class="card my-2">
        <div class="card-body">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="username">Username <font color="red">*</font></label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" value="<?= set_value('username'); ?>" />
                        <small class="form-text text-danger"><?= form_error('username'); ?></small>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Password <font color="red">*</font></label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="new-password"  value="<?= set_value('password'); ?>" />
                        <small class="form-text text-danger"><?= form_error('password'); ?></small>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="insert" id="insert">Save</button>
            </form>
        </div>

        <div class="card-footer small text-muted">
            <font color="red">*</font> wajib diisi
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
</script>