<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>    
<div class="container">
        <?php if(session()->getFlashData('addMsg')): ?>
            <div class="alert alert-warning">
               <?= session()->getFlashData('addMsg'); ?>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Catatan</h1>
        <form action="/saveProcess" method="post">
            <?= csrf_field(); ?>
            <div class="form-group" style="float:left;">
                <label for="judul">Judul</label>
                <input type="text" style="width: 60rem;" class="form-control <?php ($validation->hasError('title') ? 'is-invalid' : '') ?>" id="judul" name="title" value="<?= old('title'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>

            </div>
            <div class="form-group" style="float:right;">
                <label for="kategori">Kategori:</label>
                <select class="form-control <?php ($validation->hasError('kategori') ? 'is-invalid' : '') ?>" id="kategori" name="kategori">
                    <option>------</option>
                <?php foreach ($data as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>"><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('kategori');?>
                </div>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <textarea id="mytextarea" name="content"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="id_user" value="<?= session()->get('id'); ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </div>
<?= $this->endSection() ?>