<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Catatan Pribadi</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
    
    <script src="<?= base_url() ?>vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    <script>
        function prevImage() {
            const avatar = document.querySelector('#avatar');
            const avatarLabel = document.querySelector('.input-group-text');
            const previewAvatar = document.querySelector('.img-preview');
            
            avatarLabel.text_context = avatar.files[0].name;

            const fileAvatar = new FileReader();
            fileAvatar.readAsDataURL(avatar.files[0]);

            fileAvatar.onload = function(e) {
                previewAvatar.src = e.target.result; 
            }
        }
    </script>
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
                    <li class="nav-item dropdown dropdown-end">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, <?=session()->get('nama')?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/userProfile">Profile</a></li>
                            <!-- <li><a class="dropdown-item" href="/editUser/<?=session()->get('id')?>">Edit Profile</a></li> -->
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalLogout" style="cursor: pointer;">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
    <div class="container">
        <?= $this->renderSection('content') ?>
        <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan !</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Anda Yakin Logout !</p>
                </div>
                <div class="modal-footer">
                    <a href="/logout" role="button" class="btn btn-primary">Ya</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>