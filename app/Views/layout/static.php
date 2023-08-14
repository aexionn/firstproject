<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Catatan Pribadi</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
</head>
<style type="text/css">
    .card { width: 400px; }
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
                        <a class="nav-link" href="/dashboard">Beranda</a>
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
        <?= $this->renderSection('content') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>