<!-- Page Heading -->
<header class="bg-white mb-4" id="title">
    <div class="mx-auto py-4">
        <h5 class="font-semibold text-gray-800 pl-5">
            Profile
        </h5>
    </div>
</header>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="<?= base_url('uploads/foto_profil/' . $this->session->userdata('foto')); ?>" width="150">
                <div class="mt-3">
                    <h4><?= $this->session->userdata('nama') ?></h4>
                    <p class="text-secondary mb-3"><?= $this->session->userdata('email') ?></p>
                    <p class="text-secondary mb-3">Tanggal Lahir : <?= $this->session->userdata('tanggal_lahir') ?></p>
                    <p class="text-secondary mb-3">Jenis Kelamin : <?= $this->session->userdata('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                    <p class="text-secondary mb-3">No. HP : <?= $this->session->userdata('no_hp') != '' ? $this->session->userdata('no_hp') : '-' ?></p>
                    <p class="text-secondary mb-3">No. KTP : <?= $this->session->userdata('no_ktp') != 0 ? $this->session->userdata('no_ktp') : '-' ?></p>
                </div>
                
                <a href="<?= base_url('member/edit/') . $this->session->userdata('id') ?>" class="btn btn-primary btn-lg">Edit</a>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->