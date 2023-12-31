<!-- Begin Page Content -->
<div class="container-fluid">
    
<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img mt-1">
            </div>
            <div class="col-md-8">
                
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">member since <?= date('d F Y', strtotime($user['date_created'])); ?></small></p>
                </div>
                
            </div>
        </div>
    </div>
    
    <a class="btn btn-primary" href="<?= base_url('pengguna/profile') ?>">Edit</a>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->