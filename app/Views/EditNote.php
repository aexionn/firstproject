<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data</title>
    <!-- Masukkan link CSS Bootstrap di sini -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url() ?>vendor/summernote/summernote.css" rel="stylesheet">
    <script src="<?= base_url() ?>vendor/summernote/summernote.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Catatan Pribadi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/saveNote">Tambah Catatan</a>
                    </li>
                    <li class="nav-item dropdown dropdown-end">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, <?=userData()->nama ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/userProfile">Profile</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item text-danger" href="/logout">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">    
        <h1 class="text-center my-4">Ubah Data</h1>
        <form method="post" action="/editProcess/<?= $note->id ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" class="form-control" id="judul" name="title" value="<?= $note->title ?>" required>
            </div>
            <div class="form-group mt-4">
                <textarea class="summernote" name="content" value="<?= $note->content ?>"></textarea>
                    <script>
                        $(document).ready(function() {
                            $('.summernote').summernote({
                                tabsize: 2,
                                height: 100,
                                toolbar: true
                            });
                        });
                    </script>
            </div>
            <div class="form-group">
              <label for="kategori">Kategori:</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>------</option>
                <?php foreach ($kategori as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>"><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="id_user" value="<?= session()->get('id'); ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/dashboard" class="btn btn-primary mt-4">Kembali</a>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</html>
