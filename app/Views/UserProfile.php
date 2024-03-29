<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?> 
<div class="container">
    <?php if(session()->getFlashData('userEditMsg')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('userEditMsg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif(session()->getFlashData('userEditMsgGagal')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('userEditMsgGagal'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <h1 class="my-4 text-center">Profil Pengguna</h1>
        <?php foreach($user as $userData):?>
            <div class="card my-4">
				<div class="card-header">
					<b>Avatar</b>
				</div>
				<div class="card-body">
                    <?php
                        if(!$userData['image']){
                            $avatar = 'defaultuser.jpg';
                        }
                        else{
                            $avatar = $userData['image'];
                        }
					?>
					<img src="/image/<?= $avatar; ?>" alt="<?= htmlentities($userData['nama'], TRUE) ?>" height="128" width="128" class="">
                    <div style="display: flex; gap: 1em">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <a href="#modalRemoveAvatar" data-bs-toggle="modal" class="txt-red">Remove Avatar</a>
                        <a href="#modalEditAvatar" data-bs-toggle="modal">Change Avatar</a>
                    </div>
				</div>
			</div>
			<div class="card my-4">
				<div class="card-header">
					<b>Data Singkat Pengguna</b>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditUser" style="float:right;">Ubah Data</a>
				</div>
				<div class="card-body">
					Name: <span class="text-gray"><?= esc($userData['nama']) ?></span>
					<br>
					Email: <span class="text-gray"><?= esc($userData['email']) ?></span>
				</div>
			</div>
			<div class="card my-4">
				<div class="card-header">
					<b>Kata Sandi & Keamanan</b>
					<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditPass" style="float:right;">Ubah Kata Sandi</a>
				</div>
				<div class="card-body">
					Your Password: <span class="text-gray">******</span>
					<br>
					Last Changed: <span class="text-gray"><?= $userData['password_updated_at'] ?></span>
				</div>
			</div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteUser">Hapus Akun</button>
</div>

        <form action="/deleteAvatar/<?= $userData['id_user'] ?>" method="post" class="d-inline">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade" id="modalRemoveAvatar" tabindex="-1" aria-labelledby="modalRemoveAvatarLabel" aria-hidden="true">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title">Peringatan !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Menghapus Foto Profil Anda ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ya</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--- Modal notif Delete User -->
        <form action="/deleteUser/<?= $userData['id_user'] ?>" method="post" class="d-inline">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-labelledby="modalDeleteUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title">Peringatan !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Menghapus Akun ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ya</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal hide fade" id="modalEditAvatar" tabindex="-1" aria-labelledby="modalEditAvatarLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Avatar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                            helper('form');
                        ?>
                        <form action="/editAvatar/<?= $userData['id_user']?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="input-group mb-3">
                                    <img src="/image/defaultuser.jpg" class="img-thumbnail img-preview">
                                    <input type="file" class="form-control" id="avatar" name="avatar" onchange="prevImage()">
                                    <label class="input-group-text" for="avatar">Upload</label>
                                </div>
                            <div class="form-group modal-footer">
                                <button type="submit" class="btn btn-primary" value="upload">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal hide fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/editProfile/<?=$userData['id_user']?>" method="post">
                            <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group mb-3">
                                    <label for="name" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="nama" value="<?= $userData['nama'] ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"  value="<?= $userData['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal hide fade" id="modalEditPass" tabindex="-1" aria-labelledby="modalEditPassLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editPassModalLabel">Ubah Kata Sandi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/editPassword/<?=$userData['id_user']?>" method="post">
                        <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group mb-3">
                                <label for="oldpass" class="col-form-label">Kata Sandi Lama</label>
                                <input type="password" class="form-control" id="oldpass" name="oldpassword">
                            </div>
                            <div class="form-group mb-3">
                                <label for="newpass" class="col-form-label">Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="newpass" name="newpassword" value="<?= set_value('newpassword'); ?>">
                            </div>
                            </div>
                            <div class="form-group modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php   
        endforeach;
    ?>
<?= $this->endSection() ?>
