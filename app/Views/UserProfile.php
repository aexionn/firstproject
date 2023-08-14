<?= $this->extend('layout/static') ?>   

<?= $this->section('content') ?>    
<div class="container">
        <h1 class="my-4">Profil Pengguna</h1>
        <?php foreach ($user as $userData) { ?>
        <div class="card mb-3">
            <div>
                <div class="col-md-4">
                    <img src="<?= base_url() ?>vendor/image/user.png" alt="Foto Profil" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $userData['nama']; ?></h5>
                        <p class="card-text"><?= $userData['email']; ?></p>
                        <a href="edit_user.php?id=<?= $userData['id_user'];?>" class="btn btn-primary">Edit Profil</a> 
                    </div>
                </div>
            </div>
        </div>
        <?php   
            }
        ?>
    </div>
<?= $this->endSection() ?>
