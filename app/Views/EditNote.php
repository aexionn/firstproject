<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">
        <?php if(session()->getFlashData('editMsg')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('editMsg'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session()->getFlashData('editMsgGagal')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('editMsgGagal'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>    
        <h1 class="text-center my-4">Ubah Data</h1>
        <form method="post" action="/editProcess/<?= $note->id ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group" style="float:left;">
                <label for="judul">Judul</label>
                <input type="text" style="width: 60rem;" class="form-control" id="judul" value="<?= $note->title ?>" name="title" required>
                <span class="text-danger form-text"><?= validation_show_error('title'); ?></span>
            </div>
            <div class="form-group" style="float:right;">
                <label for="kategori">Kategori:</label>
                <select class="form-control" id="kategori" name="id_kategori">
                <option value="<?= $note->id_kategori ?>"><?=$note->kategori ?></option>
                    <?php foreach ($kategori as $kat) { ?>
                        <option value="<?= $kat['id_kategori'] ?>"><?=$kat['kategori']?></option>
                    <?php } ?>
                </select>
                <span class="text-danger form-text"><?= validation_show_error('id_kategori'); ?></span>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <textarea id="mytextarea" name="content"><?= $note->content ?></textarea>
                <span class="text-danger form-text"><?= validation_show_error('content'); ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/dashboard" class="btn btn-primary mt-4">Batal</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>