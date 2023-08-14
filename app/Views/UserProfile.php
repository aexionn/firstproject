<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
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
                        <a class="nav-link" href="/saveNote">Tambah Catatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/userProfile">Profil Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="my-4">Profil Pengguna</h1>
        <?php foreach ($user as $userData) { ?>
        <div class="card mb-3">
            <div>
                <!-- <div class="col-md-4">
                    <img src="#" alt="Foto Profil" class="img-fluid">
                </div> -->
                <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $userData['nama']; ?></h5>
                        <p class="card-text"><?= $userData['email']; ?></p>
                        <a href="edit_user.php?id=<?= $userData['id_user'];?>" class="btn btn-primary">Edit Profil</a> 
                    </div>
                </div>
            </div>
        </div>
        <?php   
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.js"></script>
</body>
</html>
