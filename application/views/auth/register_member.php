<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/register.css">

    <title>Test PT K-24 Indonesia</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Member Registration Form</h3>
                <form action="" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input class="form-control form-control-lg" type="text" name="nama" id="nama" value="<?= set_value('nama'); ?>" />
                            <label class="form-label" for="nama">Nama</label>
                        </div>
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input class="form-control form-control-lg" type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= set_value('tanggal_lahir'); ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2 pb-1">Jenis Kelamin: </h6>
                        <div class="form-check form-check-inline">
                            <input
                            class="form-check-input"
                            type="radio"
                            name="jenis_kelamin"
                            id="laki"
                            value="L"
                            checked
                            />
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input
                            class="form-check-input"
                            type="radio"
                            name="jenis_kelamin"
                            id="perempuan"
                            value="P"
                            />
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>

                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input class="form-control form-control-lg" type="text" name="no_hp" id="no_hp" value="<?= set_value('no_hp'); ?>" onkeypress="javascript:return isNumber(event)" />
                            <label for="no_hp" class="form-label">No. HP</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2 pb-1 invisible">x</h6>
                        <div class="form-outline">
                            <input class="form-control form-control-lg" type="text" name="no_ktp" id="no_ktp" value="<?= set_value('no_ktp'); ?>" onkeypress="javascript:return isNumber(event)" />
                            <label for="no_ktp" class="form-label">No. KTP</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2 pb-1">Foto Diri: </h6>
                        <div class="form-outline">
                            <input class="form-control form-control-lg" name="foto" id="foto" type="file" />
                        </div>
                        <small class="text-danger">
                            <?php
                                if ($this->session->flashdata('error_message')) {
                                    echo $this->session->flashdata('error_message');
                                }
                            ?>
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="form-outline">
                            <input type="email" name="email" id="email" class="form-control form-control-lg" />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <small class="form-text text-danger"><?= form_error('email'); ?></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="password" name="password1" id="password1" class="form-control form-control-lg" />
                            <label class="form-label" for="password1">Password</label>
                        </div>
                        <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <input type="password" name="password2" id="password2" class="form-control form-control-lg" />
                            <label class="form-label" for="password2">Confirm Password</label>
                        </div>
                        <small class="form-text text-danger"><?= form_error('password2'); ?></small>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                </div>

                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <script>
        // WRITE THE VALIDATION SCRIPT.
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
        }
    </script>
</body>
</html>

