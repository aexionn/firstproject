<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>    
    <div class="container">
        <?php if(session()->getFlashData('gagal')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('gagal'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Catatan</h1>
        
        <form action="/saveProcess" method="post">
            <?= csrf_field(); ?>
            <div class="form-group" style="width: 70%; float: left;">
                <label for="judul">Judul</label>
                <input type="text" class="form-control my-2" id="judul" name="title" value="<?= set_value('title'); ?>">
                <span class="text-danger form-text"><?= validation_show_error('title'); ?></span>
            </div>
            <div class="form-group my-2" style="float:right;">
                <div class="col-sm-10">
                    <label for="kategori">Kategori:</label>
                    <select multiple="multiple" class="multiple-select" id="kategori" name="kategori[]">
                        <option value="">-------</option>
                        <?php foreach ($data as $kat) { ?>
                        <option value="<?= $kat['id_kategori'] ?>"><?=$kat['kategori']?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger form-text"><?= validation_show_error('id_kategori'); ?></span>
                </div>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <textarea id="mytextarea" name="content"><?= set_value('content'); ?></textarea>
                <span class="text-danger form-text "><?= validation_show_error('content'); ?></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="id_user" value="<?= session()->get('id'); ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </div>
<?= $this->endSection() ?>