<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center my-4">Beranda</h1>
        <form class="d-flex" action="/cari" method="get" role="search">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari Berdasarkan Judul" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
        <?php foreach ($note as $array): ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body"> 
                            <h5 class="card-title"><?= $array['title'] ?></h5>
                            <p class="card-text"><?= $array['content'] ?></p>
                            <p class="card-text">Kategori: <?= $array['kategori'] ?></p>
                            <a href="/edit/<?= $array['id'] ?>" class="btn btn-primary">Ubah</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <form action="/delete/<?= $array['id'] ?>" method="post" class="d-inline">
            <?php
                endforeach;
            ?>
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title">Peringatan !</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Apakah Anda Yakin Ingin Menghapus Catatan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?= $pager->links('note', 'bootstrap_full') ?>
<?= $this->endSection() ?>