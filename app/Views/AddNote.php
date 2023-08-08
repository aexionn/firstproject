<!DOCTYPE html>
<html>
<head>
    <title>Tambah Catatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet" type="text/css">
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
                        <a class="nav-link" href="/dashboard">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/saveNote">Tambah Catatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/userProfile">Profil Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" disabled>Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if(session()->getFlashData('addMsg')): ?>
            <div class="alert alert-warning">
               <?= session()->getFlashData('addMsg'); ?>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Tambah Catatan</h1>
        <form action="/saveProcess" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="title" required>
            </div>

            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control" id="konten" name="content" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>------</option>
                <?php foreach ($data as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>"><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_user">User:</label>
                <select class="form-control" id="id_user" name="id_user">
                    <option>------</option>
                <?php foreach ($data2 as $listNote) : ?>
                    <option value="<?=$listNote['id_user']?>"><?=$listNote['nama']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.js"></script>
</body>
</html>


