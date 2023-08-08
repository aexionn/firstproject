<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data</title>
    <!-- Masukkan link CSS Bootstrap di sini -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Ubah Data</h1>
        <form method="post" action="/editProcess/<?= $note->id ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" class="form-control" id="judul" name="title" value="<?= $note->title ?>" required>
            </div>
            <div class="form-group">
                <label for="konten">Konten:</label>
                <textarea class="form-control" id="konten" name="content" rows="5" required><?= $note->content ?></textarea>
            </div>
            <div class="form-group">
              <label for="kategori">Kategori:</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>------</option>
                <?php foreach ($kategori as $listKategori) : ?>
                    <option value="<?=$listKategori['id_kategori']?>"><?=$listKategori['kategori']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_user">User:</label>
                <select class="form-control" id="id_user" name="id_user">
                    <option>------</option>
                <?php foreach ($user as $listUser) : ?>
                    <option value="<?=$listUser['id_user']?>"><?=$listUser['nama']?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-4">Simpan Perubahan</button>
                <a href="/Note/Dashboard" class="btn btn-primary mt-4">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
