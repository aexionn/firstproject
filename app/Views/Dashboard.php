<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Catatan Pribadi</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
</head>
<style type="text/css">
    .card {
        width: 400px;
        
    }
</style>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.js"></script>
</body>
</html>