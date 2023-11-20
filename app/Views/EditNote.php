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
                <p>Kategori Terpilih: <a href="#" data-bs-toggle="modal" data-bs-target="#ubahKategori" class="badge text-bg-info"><?= $notes['kategoris'] . ',' ?></a></p>
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
        <div class="modal fade" id="ubahKategori" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="ubahKategoriLabel" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">    
                    <?php foreach ($ubahkat as $kat) { ?>
                        <div class="card mb-4">
                            <div class="card-body"> 
                                <h5 class="card-title"><?= $kat['kategori'] ?></h5>
                                <button class="btn btn-outline-danger my-3" data-bs-target="#delKategori" data-bs-toggle="modal">Hapus Kategori</button>
                                <!-- <span class='badge text-bg-info'></span>  -->
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($ubahkat as $kat) { ?>
        <form action="/delcateonnote/<?= $kat['id_diary'] ?>/<?= $kat['id_kategori'] ?>" method="post" class="d-inline"> 
        <?php } ?>
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade modal-lg" id="delKategori" tabindex="-1" aria-labelledby="delKategoriLabel" aria-hidden="true">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-danger">PERINGATAN !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Menghapus Kategori ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning">Ya</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-target="#ubahKategori" data-bs-toggle="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>