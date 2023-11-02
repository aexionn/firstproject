<?= $this->extend('layout/dynamic'); ?>
<?= $this->section('content') ?>

    <div class="container">
        <?php if(session()->getFlashData('gagal')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('gagal'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Kategori</h1>
        <?php foreach ($data as $value) { ?>
        <form action="/editCateProcess/<?= $value['id_kategori'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group " style="float:left; width:100%">
                <label for="kat">Kategori</label>
                <input type="text" class="form-control my-2" id="kat" name="kategori" value="<?= $value['kategori']; ?>">
                <span class="text-danger form-text"><?= validation_show_error('kategori'); ?></span>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <label for="mytextarea">Deskripsi (Opsional)</label>
                <textarea id="mytextarea" name="deskripsi"><?= $value['deskripsi']; ?></textarea>
                <span class="text-danger form-text "><?= validation_show_error('deskripsi'); ?></span>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
        <?php } ?>
    </div>

<?= $this->endSection() ?>