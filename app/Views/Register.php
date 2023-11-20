<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Halaman Daftar</h1>
                <div class="card mt-5">
                    <div class="card-body">
                        <?php if(session()->getFlashData('regMsg')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <b>Error !</b>
                                <?= session()->getFlashData('regMsg'); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <form action="/registerProcess" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" placeholder="Nama" value="<?= set_value('name') ?>" class="form-control" >
                                <span class="text-danger form-text"><?= validation_show_error('name'); ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" >
                                <span class="text-danger form-text"><?= validation_show_error('email'); ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" name="password" placeholder="Password" value="<?= set_value('password') ?>" class="form-control" >
                                <span class="text-danger form-text"><?= validation_show_error('password'); ?></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="confpassword" class="form-label">Ulangi Kata Sandi</label>
                                <input type="password" name="confpassword" placeholder="Ulangi Password" value="<?= set_value('confpassword') ?>" class="form-control" >
                                <span class="text-danger form-text"><?= validation_show_error('confpassword'); ?></span>
                            </div>
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                                <a href = "/login" role="button" class="btn btn-success">Masuk</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.js"></script>
</body>
</html>

