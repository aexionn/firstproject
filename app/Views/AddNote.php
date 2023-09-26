<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>    
<div class="container">
        <?php if(session()->getFlashData('addMsg')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('addMsg'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Catatan</h1>
        
        <form action="/saveProcess" method="post">
            <?= csrf_field(); ?>
            <div class="form-group" style="float:left;">
                <label for="judul">Judul</label>
                <input type="text" style="width: 60rem;" class="form-control" id="judul" name="title" value="<?= set_value('title'); ?>">
                <span class="text-danger form-text"><?= validation_show_error('title'); ?></span>
            </div>
            <div class="form-group" style="float:right;">
                <label for="category">Kategori:</label>
                <select class="form-control" id="category" name="kategori">
                    <option <?= set_select('kategori', '------', true) ?>>------</option>
                <?php foreach ($data as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>" <?= set_select('kategori', $listKategori['id_kategori']) ?>><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
                <span class="text-danger form-text"><?= validation_show_error('kategori'); ?></span>
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