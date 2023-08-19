<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>    
<div class="container">
    <h1 class="my-4 text-center">Profil Pengguna</h1>
    <?php foreach ($user as $userData) { ?>
        <div class="card my-4">
				<div class="card-header">
					<b>Avatar</b>
				</div>
				<div class="card-body">
					<?php
					// $avatar = $current_user->avatar ?
					// 	base_url('upload/avatar/' . $current_user->avatar)
					// 	: get_gravatar($current_user->email)
					?>
					<img src="<?= base_url('vendor/image/Default_pfp.jpg') ?>" alt="<?= htmlentities($userData['nama'], TRUE) ?>" height="80" width="80">
                    <div style="display: flex; gap: 1em">
						<a href="<?= site_url('admin/setting/remove_avatar') ?>" class="txt-red">Remove Avatar</a>
						<a href="<?= site_url('admin/setting/upload_avatar') ?>">Change Avatar</a>
					</div>
				</div>
			</div>
			<div class="card my-4">
				<div class="card-header">
					<b>Data Singkat Pengguna</b>
                    <a href="#" style="float:right;">Ubah Data</a>
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
					<a href="#" style="float:right;">Ubah Kata Sandi</a>
				</div>
				<div class="card-body">
					Your Password: <span class="text-gray">******</span>
					<br>
					Last Changed: <span class="text-gray">22-08-2020</span>
				</div>
			</div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus Akun</button>

    <form action="/deleteUser/<?= $userData['id_user'] ?>" method="post" class="d-inline">
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
    <?php   
        }
    ?>
</div>
<?= $this->endSection() ?>
