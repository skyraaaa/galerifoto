<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Gaya tambahan untuk tombol Tambah */
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
            /* Warna latar belakang saat tombol dihover */
            border-color: #164863;
            /* Warna border saat tombol dihover */
            color: #ffffff;
            /* Warna teks saat tombol dihover */
        }

        /* Gaya tambahan untuk kartu album */
        .card {
            border: none;
            transition: transform 0.2s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk tombol dropdown aksi */
        .dropdown-toggle::after {
            display: none !important;
        }

        .dropdown-toggle {
            border-radius: 50%;
            padding: 0;
            width: 30px;
            height: 30px;
            line-height: 0.5;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Data Album</h2>
        <!-- Tombol Tambah -->
        <button type="button" class="btn btn-tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>

             <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                          <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Album</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="<?php echo site_url('Welcome/addDataAlbum'); ?>" method="post">
                              <div class="mb-3">
                                  <label for="namaalbum" class="form-label">Nama Album</label>
                                  <input type="text" class="form-control" id="namaalbum" name="namaalbum" placeholder="Masukkan Nama Album">
                              </div>
                              <div class="mb-3">
                                  <label for="deskripsi" class="form-label">Deskripsi</label>
                                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi"></textarea>
                              </div>
                              <div class="mb-3">
                                  <label for="tanggaldibuat" class="form-label">Tanggal Dibuat</label>
                                  <input type="date" class="form-control" id="tanggaldibuat" name="tanggaldibuat">
                              </div>
                              <input type="hidden" class="form-control" id="userid" name="userid" value="<?php $userid = $this->session->userdata('userid'); echo $userid; ?>">
                              <div class="d-grid gap-2">
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                          </form>
                          <div id="pesan" class="alert" style="display: none;"></div>
                      </div>
                  </div>
              </div>
          </div>
        <!-- Modal Update -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Data Album</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo site_url('Welcome/updateDataAlbum'); ?>" method="post">
                            <input type="hidden" id="update_albumid" name="albumid">
                            <div class="mb-3">
                                <label for="update_namaalbum" class="form-label">Nama Album</label>
                                <input type="text" class="form-control" id="update_namaalbum" name="namaalbum" placeholder="Masukkan Nama Album">
                            </div>
                            <div class="mb-3">
                                <label for="update_deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" id="update_deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
                            </div>
                            <div class="mb-3">
                                <label for="update_tanggaldibuat" class="form-label">Tanggal Dibuat</label>
                                <input type="date" class="form-control" id="update_tanggaldibuat" name="tanggaldibuat" placeholder="Masukkan Tanggal Dibuat">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar album -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if (!empty($DataAlbum)) {
                foreach ($DataAlbum as $ReadDS) {
            ?>
                   <div class="col">
                          <div class="card" style="background-color: #9BB8CD; padding-left: 13px;">
                              <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo $ReadDS->namaalbum; ?></h5>
                                    <p class="card-text"><?php echo $ReadDS->deskripsi; ?></p>
                                    <a href="<?php echo site_url('Welcome/foto/' . $ReadDS->albumid); ?>" class="btn btn-primary" style="background-color: #164863; border-color: #164863; color: #your-text-color;"><b>Detail -></b></a>
                                </div>
                                <!-- Dropdown untuk aksi Update dan Delete -->
                                <div class="dropdown">
                                    <button class="btn btnz dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="#" onclick="updateModal('<?php echo $ReadDS->albumid; ?>', '<?php echo $ReadDS->namaalbum; ?>', '<?php echo $ReadDS->deskripsi; ?>', '<?php echo $ReadDS->tanggaldibuat; ?>')">Update</a></li>
                                        <li><a class="dropdown-item" href="<?php echo site_url('Welcome/deleteDataAlbum/' . $ReadDS->albumid); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>

    <script>
        function updateModal(albumid, namaalbum, deskripsi, tanggaldibuat) {
            document.getElementById('update_albumid').value = albumid;
            document.getElementById('update_namaalbum').value = namaalbum;
            document.getElementById('update_deskripsi').value = deskripsi;
            document.getElementById('update_tanggaldibuat').value = tanggaldibuat;
            $('#updateModal').modal('show');
        }
    </script>
</body>

</html>