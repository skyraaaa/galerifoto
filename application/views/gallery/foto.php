<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-...">
    </script>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>">



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .card {
            width: 100%;
            border: none;
            transition: transform 0.2s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-text {
            color: #6c757d;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .btn-tambah {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #164863;
            border-color: #164863;
            color: #ffffff;
            border-radius: 50%;
            padding: 10px 14px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .btn-tambah:hover {
            background-color: #164863;
            border-color: #164863;
            color: #ffffff;
        }

        .btn-update,
        .btn-delete {
            width: 45%;
            padding: 0.5rem;
            font-size: 0.9rem;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
            margin-right: 5px;
        }

        .btn-update {
            background-color: #198754;
            border-color: #198754;
            color: #ffffff;
        }

        .btn-update:hover {
            background-color: #146c43;
            border-color: #146c43;
            color: #ffffff;
        }

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #ffffff;
        }

        .btn-delete:hover {
            background-color: #bd2130;
            border-color: #bd2130;
            color: #ffffff;
        }

        /* Style untuk modal */
        .modal-content {
            width: 50%; /* Mengatur lebar modal */
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-dialog {
            max-width: none; /* Menghilangkan pembatas lebar maksimum modal */
            width: auto;
            margin: 10px; /* Memberi jarak dari sisi kiri */
        }

        .modal-body img {
            max-width: 100%; /* Menggunakan 100% dari lebar modal */
            height: auto; /* Mengikuti perubahan proporsi lebar gambar */
            display: block; /* Membuat gambar menjadi blok untuk mengatur margin secara efektif */
            margin: 0 auto; /* Menengahkan gambar di dalam modal */
            border-radius: 0.5rem; /* Menambahkan sudut melengkung pada gambar */
        }


        .modal-header {
            border-bottom: none;
            padding: 1rem;
            text-align: center;
        }

        .modal-body {
            text-align: left;
            padding: 1rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem;
            text-align: center;
        }

        /* Style untuk tombol Edit dan Delete */
        .btn-edit,
        .btn-delete {
            width: 100%; /* Membuat tombol Edit dan Delete memenuhi lebar modal */
            margin-top: 10px; /* Memberi jarak antara tombol */
        }
    </style>
</head>

<body>
    <?php $albumid = $this->uri->segment('3');?>

    <!-- judul (card) -->
    <div class="container mt-4">
        <h2 class="text-center">Data Foto</h2>

        <button type="button" class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('Welcome/addDataFoto/' . $albumid); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judulfoto" class="form-label">Judul Foto</label>
                        <input type="text" class="form-control" id="judulfoto" name="judulfoto" placeholder="Masukkan Judul Foto">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsifoto" class="form-label">Deskripsi Foto</label>
                        <textarea class="form-control" id="deskripsifoto" name="deskripsifoto" rows="3" placeholder="Masukkan Deskripsi Foto"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalunggah" class="form-label">Tanggal Unggah</label>
                        <input type="date" class="form-control" id="tanggalunggah" name="tanggalunggah">
                    </div>
                    <div class="mb-3">
                        <label for="lokasifile" class="form-label">Pilih Foto</label>
                        <input type="file" class="form-control" id="lokasifile" name="lokasifile">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                <div id="pesan" class="alert" style="display: none;"></div>
            </div>
        </div>
    </div>
</div>

        <!-- tabel -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($DataFoto)) {
                foreach ($DataFoto as $ReadDS) {
                    // Retrieve like count for current photo
                    $likeCount = $this->MSudi->hitung_like($ReadDS->userid, $ReadDS->fotoid)->jumlah;
                    ?>
                    <div class="col-md-3 mb-4"> <!-- Adjust the col class to make the column smaller -->
                        <div class="card h-100">
                            <img src="<?= base_url('/assets/img/' . $ReadDS->lokasifile) ?>" class="card-img-top" alt="..." data-bs-toggle="modal" data-bs-target="#photoModal<?= $ReadDS->fotoid ?>">
                            <div class="card-body p-6"> <!-- Adjust the padding to make it more compact -->
                                <h5 class="card-title"><?= $ReadDS->judulfoto ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Detail Foto -->
                    <div class="modal fade" id="photoModal<?= $ReadDS->fotoid ?>" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="photoModalLabel">Detail Foto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?= base_url('/assets/img/' . $ReadDS->lokasifile) ?>" class="img-fluid" alt="Detail Foto">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="modal-title small-title"><?= $ReadDS->judulfoto ?></h5>
                                            <p>Deskripsi Foto: <?= $ReadDS->deskripsifoto ?></p>
                                            <p>Userid: <small><?= $ReadDS->userid ?></small></p>
                                            <!-- Tampilkan jumlah like yang telah didefinisikan -->
                                            <p>Jumlah Like: <?= $likeCount ?></p>
                                            <!-- Tombol Delete -->
                                            <button type="button" class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $ReadDS->fotoid ?>">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Delete Foto -->
                    <div class="modal fade" id="deleteModal<?= $ReadDS->fotoid ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="<?php echo site_url('Welcome/deleteDataFoto/' . $ReadDS->fotoid); ?>" class="btn btn-delete">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } ?>
        </div>
    </div>


    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
