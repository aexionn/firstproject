<?= $this->extend('layout/static') ?>   

<?= $this->section('content') ?>
    <div class="container">
        <h1 class="text-center my-4">Beranda</h1>
        <?php foreach ($note as $array): ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body"> 
                            <h5 class="card-title"><?= $array['title'] ?></h5>
                            <p class="card-text"><?= $array['content'] ?></p>
                            <p class="card-text">Kategori: <?= $array['kategori'] ?></p>
                            <a href="/edit/<?= $array['id'] ?>" class="btn btn-primary">Ubah</a>
                            <form action="/delete/<?= $array['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?= $this->endSection() ?>