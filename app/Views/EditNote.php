<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">    
        <h1 class="text-center my-4">Ubah Data</h1>
        <form method="post" action="/editProcess/<?= $note->id ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group" style="float:left;">
                <label for="judul">Judul</label>
                <input type="text" style="width: 60rem;" class="form-control" id="judul" value="<?= $note->title ?>" name="title" required>
            </div>
            <div class="form-group" style="float:right;">
                <label for="kategori">Kategori:</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>------</option>
                <?php foreach ($kategori as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>"><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="padding-top: 100px;">
                <textarea id="mytextarea" name="content"><?= $note->content ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/dashboard" class="btn btn-primary mt-4">Batal</a>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>