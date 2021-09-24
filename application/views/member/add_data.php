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
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="nama">Nama <font color="red">*</font></label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" value="<?= set_value('nama'); ?>" />
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="tanggal_lahir">Tanggal Lahir <font color="red">*</font></label>
                        <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= set_value('tanggal_lahir'); ?>" />
                        <small class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group col-sm-4">
                        <label for="jenis_kelamin">Jenis Kelamin <font color="red">*</font></label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="" hidden>Pilih Jenis Kelamin</option>
                            <option value="L" <?= set_select('jenis_kelamin', 'L'); ?>>Laki-laki</option>
                            <option value="P" <?= set_select('jenis_kelamin', 'P'); ?>>Perempuan</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></small>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="no_hp">No. HP</label>
                        <input class="form-control" type="text" name="no_hp" id="no_hp" placeholder="No. HP" value="<?= set_value('no_hp'); ?>" onkeypress="javascript:return isNumber(event)" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="no_ktp">No. KTP</label>
                        <input class="form-control" type="text" name="no_ktp" id="no_ktp" placeholder="No. KTP" value="<?= set_value('no_ktp'); ?>" onkeypress="javascript:return isNumber(event)" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="foto">Foto</label>
                        <input class="form-control-file" type="file" name="foto" id="foto" />
                        <small class="text-danger">
                            <?php
                                if ($this->session->flashdata('error_message')) {
                                    echo $this->session->flashdata('error_message');
                                }
                            ?>
                        </small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label>Email <font color="red">*</font></label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="<?= set_value('email'); ?>"  />
                        <small class="form-text text-danger"><?= form_error('email'); ?></small>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Password <font color="red">*</font></label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
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