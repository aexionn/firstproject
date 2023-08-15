<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">    
        <h1 class="text-center my-4">Ubah Data Pengguna</h1>
        <form method="post" action="/editUserProcess/<?= $user->id_user ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/userProfile" class="btn btn-primary mt-4">Batal</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>