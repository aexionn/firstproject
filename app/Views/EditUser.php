<?= $this->extend('layout/dynamic') ?>   

<?= $this->section('content') ?>
    <div class="container">
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="/editUserProcess/<?= $user->id_user ?>" >
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" height="250" width="250" src="" id="image_preview_container">
                    <span class="font-weight-bold">
                        <input type="file" name="profile_image" id="profile_image"  class="form-control">
                    </span>
                </div>
            </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row" id="res"></div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="name" class="form-control" placeholder="first name" value="<?= $user->email ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Nama</label>
                        <input type="text" name="email" disabled class="form-control" value="<?= $user->nama ?>" placeholder="Email">
                    </div>
                </div>
                <!-- <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
                    </div>
                </div> -->
                <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>  
    </form>    
        <!-- <h1 class="text-center my-4">Ubah Data Pengguna</h1>
        <form method="post" action="/editUserProcess/<?= $user->id_user ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/userProfile" class="btn btn-primary mt-4">Batal</a>
            </div>
        </form> -->
    </div>
<?= $this->endSection() ?>