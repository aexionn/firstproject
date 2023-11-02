<?= $this->extend('layout/dynamic'); ?>
<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center my-4">List Kategori</h1>
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
            <?php } ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
