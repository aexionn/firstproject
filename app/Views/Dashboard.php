<?= $this->extend('layout/dynamic') ?>   
<?= $this->section('content') ?>    
    <div class="container">
        <?php if(session()->getFlashData('sukses')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('sukses'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h1 class="text-center my-4">Beranda</h1>
        <form class="d-flex mb-3" action="/cari" method="get" role="search">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari Berdasarkan Judul" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
        <button class="btn btn-secondary" type="button" id="recently-update">
            Baru Diubah
        </button>
        <button class="btn btn-secondary" type="button" id="recently-create">
            Baru Dibuat
        </button>
        <?php 
            foreach ($note as $noteData):
            $updateDate = strtotime($noteData['updated_at']);
            $createDate = strtotime($noteData['created_at']);
            $formattedUpdate = date('Y-m-d H:i:s', $updateDate);
            $formattedCreate = date('Y-m-d H:i:s', $createDate);
        ?>
        <div id="card-container-note">
            <div class="card my-3 w-100" id="card-note" data-date-update="<?= $formattedUpdate; ?>" data-date-create="<?= $formattedCreate; ?>">
                <div class="card-body"> 
                    <h5 class="card-title"><?= $noteData['title'] ?></h5>
                    <p class="card-text"><?= excerpt($noteData['content'], false, 50)?></p>
                    <span class='badge text-bg-info'><?= excerpt($noteData['kategoris'], false, 10) . ', ' ?></span>
                    <br><a href="/edit/<?= $noteData['id_diary'] ?>" class="btn btn-outline-primary my-3">Detail</a>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
                    <p class="text-secondary" class="updatedAt" >Diubah Pada : <?= $noteData['updated_at']?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
        <button class="btn btn-dark btn-bin" data-bs-toggle="modal" data-bs-target="#recycleBin"><img src="<?= base_url(); ?>image\bin.png" ></button>
        <?= $pager->links('note', 'bootstrap_full'); ?>
        <?php foreach ($note as $noteData): ?>
        <form action="/delete/<?= $noteData['id_diary'] ?>" method="post" class="d-inline">
        <?php endforeach; ?>
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
                            <p>Apakah Anda Yakin Ingin Menghapus Catatan ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning">Ya</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="recycleBin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recycleBinLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tempat Sampah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($softdel as $key) : ?>
                        <div class="card-container">
                            <div class="card-bin mb-4">
                                <div class="card-body"> 
                                    <h5 class="card-title"><?= $key['title'] ?></h5>
                                    <p class="card-text"><?= excerpt($key['content'], false, 50) ?></p>
                                    <br><a href="/restoreNote/<?= $key['id_diary'] ?>" role="button" class="btn btn-outline-primary my-3">Pulihkan</a>
                                    <form action="/deletePermanent/<?= $key['id_diary'] ?>" method="post" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?= csrf_field() ?>  
                                        <button type="submit" class="btn btn-outline-danger my-3" data-bs-toggle="modal" data-bs-target="#delPerModal">Hapus Permanen</button>
                                    </form>
                                    <!-- <button class="btn btn-outline-danger my-3" data-bs-toggle="modal" data-bs-target="#delPerModal">Hapus Permanen</button> -->
                                    <!-- <span class='badge text-bg-info'></span>  -->
                                </div>
                            </div>
                        </div>
                        <?php endforeach;  ?>
                    </div>
                    <div class="modal-footer">
                        <a href="/restoreNote" role="button" class="btn btn-outline-primary my-3">Pulihkan Semua</a>
                        <form action="/deletePermanent" method="post" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-danger my-3" data-bs-toggle="modal" data-bs-target="#delAllPerModal">Hapus Permanen Semua</button>
                        </form>
                        <!-- <button class="btn btn-outline-danger my-3"  data-bs-toggle="modal" data-bs-target="#delAllPerModal">Hapus Permanen Semua</button> -->
                    </div>
                </div>
            </div>
        </div>
               
        <?php foreach ($softdel as $key) : ?>
        <form action="/deletePermanent/<?= $key['id_diary'] ?>" method="post" class="d-inline">
        <input type="hidden" name="_method" value="DELETE">
        <?php endforeach; ?>
        <?= csrf_field() ?>  
            <div class="modal fade modal-lg" id="delPerModal" aria-hidden="true" aria-labelledby="delPerModalLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-danger">PERINGATAN !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Melakukan Hapus Permanen ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning">Ya</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-target="#recycleBin" data-bs-toggle="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <?php foreach ($softdel as $key) : ?>
        <form action="/deletePermanent" method="post" class="d-inline">
        <input type="hidden" name="_method" value="DELETE">
        <?php endforeach; ?>
        <?= csrf_field() ?>
            <div class="modal fade modal-lg" id="delAllPerModal" tabindex="-1" aria-labelledby="delAllPerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title text-danger">PERINGATAN !</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Apakah Anda Yakin Ingin Melakukan Hapus Permanen Pada Semua Data ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning">Ya</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-target="#recycleBin" data-bs-toggle="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<?= $this->endSection() ?>