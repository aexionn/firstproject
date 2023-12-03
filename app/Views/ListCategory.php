<?= $this->extend('layout/dynamic'); ?>
<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center my-4">Daftar Kategori</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                foreach ($data as $value) { 
            ?>
                <tr>
                    <td><?= $i += 1 ?></td>
                    <td><?= $value['kategori'] ?></td>
                    <td><?= $value['deskripsi'] ?></td>
                    <td>
                        <a href="/editCate/<?= $value['id_kategori'] ?>" class="btn btn-outline-primary my-3">Ubah</a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
                    </td>
                </tr>
        </tbody>
        <form action="/deletecate/<?= $value['id_kategori'] ?>" method="post" class="d-inline">    
            <?php } ?>
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal fade modal-lg" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-danger">PERINGATAN !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Menghapus Kategori Ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning">Ya</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </table>
</div>

<?= $this->endSection() ?>
