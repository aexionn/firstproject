<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>    
<div class="container">
    <h1 class="my-4 text-center">Profil Pengguna</h1>
    <?php foreach ($user as $userData) { ?>
    <div class="card mb-3" style="width: 35rem;" >
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url() ?>vendor/image/user.png" alt="Foto Profil" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $userData['nama']; ?></h5>
                    <p class="card-text"><?= $userData['email']; ?></p>
                    <p class="card-text"><small class="text-body-secondary">Account Created <?= $userData['created_at']; ?></small></p>
                    <!-- <p class="card-text"><small class="text-body-secondary">Last Update <?= $userData['updated_at']; ?></small></p> -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
    <?php   
        }
    ?>
    <form action="/deleteUser/<?= $userData['id_user'] ?>" method="post" class="d-inline">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="DELETE">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title">Peringatan !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah Anda Yakin Ingin Menghapus Akun ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ya</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                </div>
                </div>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection() ?>
