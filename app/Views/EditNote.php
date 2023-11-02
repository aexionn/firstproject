<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">
        <?php if(session()->getFlashData('gagal')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('gagal'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>    
        <h1 class="text-center my-4">Ubah Data</h1>
        <?php foreach ($note as $notes) { ?>
            <form method="post" action="/editProcess/<?= $notes['id_diary'] ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group" >
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control my-3" id="judul" value="<?= $notes['title'] ?>" name="title" required>
                </div>
                <p>Kategori Terpilih: <span class="badge text-bg-info"><?= $notes['kategoris'] . ',' ?></span></p>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select multiple="multiple" class="multiple-select" id="kategori" name="kategori[]">
                        <option value="">-------</option>
                        <?php foreach ($kategori as $kat) { ?>
                        <option value="<?= $kat['id_kategori'] ?>"><?=$kat['kategori']?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger form-text"><?= validation_show_error('id_kategori'); ?></span>
                </div>
                <div class="form-group" style="padding-top: 8em;">
                    <textarea id="mytextarea" name="content"><?= $notes['content'] ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                    <a href="/dashboard" class="btn btn-primary mt-4">Batal</a>
                </div>
            </form>
        <?php } ?>
    </div>
<?= $this->endSection() ?>