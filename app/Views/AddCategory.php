<?= $this->extend('layout/dynamic'); ?>
<?= $this->section('content'); ?>

    <div class="container">
        <?php if(session()->getFlashData('gagal')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('gagal'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Kategori</h1>
        
        <form action="/cateProcess" method="post">
            <?= csrf_field(); ?>
            <div class="form-group " style="float:left; width:100%">
                <label for="kat">Kategori</label>
                <input type="text" class="form-control my-2" id="kat" name="kategori" value="<?= set_value('kategori'); ?>">
                <span class="text-danger form-text"><?= validation_show_error('kategori'); ?></span>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <label for="mytextarea">Deskripsi (Opsional)</label>
                <textarea id="mytextarea" name="deskripsi"><?= set_value('deskripsi'); ?></textarea>
                <span class="text-danger form-text "><?= validation_show_error('deskripsi'); ?></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="id_user" value="<?= session()->get('id'); ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </div>

<?= $this->endSection(); ?>