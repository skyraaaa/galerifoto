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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa; /* Soft background color */
        }

        .container {
            padding-top: 20px;
        }

        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.3s ease-in-out;
            border: none;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0px 0px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
        }

        .card-text {
            color: #6c757d;
        }

        .card-footer {
            background: linear-gradient(45deg, #9BB8CD, #9BB8CD);
            border: 1px solid #9BB8CD;
            border-radius: 0 0 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1px;
        }

        .card-footer a,
        .like-icon i,
        .card-footer span {
            font-size: 12px;
            line-height: 1;
        }


        .card-footer a {
            color: #fff;
        }

        .like-icon {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .like-icon i {
            margin-right: 3px;
            font-size: 1.2rem;
        }

        .card-footer span {
            margin-right: 5px;
            color: #fff;
        }

        .modal-body p {
            margin: 0;
        }

        .btn-primary {
            background-color: #B47B84;
            border: none;
        }
/* 
        .small-title {
            font-size: 18px;
        } */

        .modal-body img {
            max-width: 70%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 0.5rem;
        }

		.user_name{
			font-size:18px;
			font-weight: semibold;
		}

    </style>

</head>

<body>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            <?php
            if (!empty($DataFoto)) {
                foreach ($DataFoto as $ReadDS) {
                    $likeCount = $this->MSudi->hitung_like($ReadDS->userid, $ReadDS->fotoid)->jumlah;
                ?>
            <div class="col">
                <div class="card">
                    <img src="<?= base_url('/assets/img/' . $ReadDS->lokasifile) ?>" class="card-img-top" alt="Foto"
                        data-bs-toggle="modal" data-bs-target="#photoModal"
                        onclick="displayPhotoInfo('<?= $ReadDS->fotoid ?>', '<?= $ReadDS->judulfoto ?>', '<?= $ReadDS->deskripsifoto ?>', '<?= $ReadDS->namauser ?>', '<?= $ReadDS->userid ?>', '<?= $likeCount ?>', '<?= base_url('/assets/img/' . $ReadDS->lokasifile)?>'), getComments('<?= $ReadDS->fotoid ?>')">
                     
                    <div class="card-footer">
                        <div class="like-icon">
                            <a href="<?= site_url('Like/likeFoto/' . $ReadDS->fotoid) ?>" class="btn">
                                <i class="fas fa-heart"></i>
                            </a>
                            <span><?= $likeCount ?></span>
                        </div>
                        <a href="index.php#/<?= $ReadDS->fotoid ?>" class="float-end" onclick="displayCommentModal('<?= $ReadDS->fotoid ?>', '<?= $ReadDS->judulfoto ?>', '<?= $ReadDS->deskripsifoto ?>', '<?= $ReadDS->namauser ?>', '<?= $ReadDS->userid ?>', '<?= $likeCount ?>', '<?= base_url('/assets/img/' . $ReadDS->lokasifile) ?>')" data-bs-toggle="modal" data-bs-target="#commentModal">
                            <i class="fas fa-comment"></i> Comment
                        </a>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


<!-- Modal Komentar -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Tambah Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="commentForm" action="<?php echo site_url('Welcome/addDataKomentar/'); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar Anda</label>
                        <textarea class="form-control" id="comment" name="comment" placeholder="Ketik komentar Anda"></textarea>
                    </div>
                    <input type="hidden" id="fotoid" name="fotoid" value="">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Detail Foto -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content overflow-auto" style="min-height: 90vh; max-height: 90vh;">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel">Detail Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
						<div class="flex">
							<img src="" id="modalPhoto" style="min-width: 100%; margin: 0px;" alt="Detail Foto">
						</div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="modal-title small-title" id="modalTitle"></h4>
                        <p id="modalUserInfo"></p>
                        <p id="modalDescription"></p>
                        <p id="modalLikeCount"></p>
                        <p>album<?= $ReadDS->albumid ?></p>

                        <!-- Daftar Komentar -->
                        <h5 class="mt-4 mb-1">Komentar </h3>
                        <ul id="modalCommentList" class="list-group pr-4 pt-2">
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-LCf3E/2tp/wg9QDt6VuvSGj7tmwS5B4hD4FJBB1qt+I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qNfrEZxxM2MZGjDRL9qDye2sjWKROHmWE5nr8rfEnbukPPrUZY0KAFsUe/E8ahgr"
        crossorigin="anonymous"></script>

        <script>

        function displayPhotoInfo(fotoId, judulFoto, deskripsiFoto, namaUser, userId, likeCount, imgUrl) {
        var modalPhoto = document.getElementById('modalPhoto');
        var modalTitle = document.getElementById('modalTitle');
        var modalUserInfo = document.getElementById('modalUserInfo');
        var modalDescription = document.getElementById('modalDescription');
        var modalLikeCount = document.getElementById('modalLikeCount');

        modalPhoto.src = imgUrl;
        modalTitle.innerHTML = judulFoto;
        modalUserInfo.innerHTML = 'User: ' + namaUser;
        modalDescription.innerHTML = 'Deskripsi Foto: ' + deskripsiFoto;
        modalLikeCount.innerHTML = 'Jumlah Like: ' + likeCount; 

        $('#photoModal').modal('show');
    }

   
    function displayCommentModal(fotoId, judulFoto, deskripsiFoto, namaUser, userId, likeCount, imgUrl, comments) {
        // Set data attribute untuk form komentar
        $('#commentForm').attr('data-fotoid', fotoId);
        document.getElementById('fotoid').value = fotoId;
        $('#commentForm').attr('data-judul', judulFoto);
        $('#commentForm').attr('data-deskripsi', deskripsiFoto);
        $('#commentForm').attr('data-userid', userId);
        $('#commentForm').attr('data-namauser', namaUser);
        $('#commentForm').attr('data-likecount', likeCount);
        $('#commentForm').attr('data-imgurl', imgUrl);

        $('#commentModal').modal('show');
    }

	// TODO by HamsterKaget : function to get comment
	function getComments(fotoId) {
		$.ajax({
			url: '<?php echo base_url("index.php/Welcome/getComment"); ?>',
			type: 'GET',
			data: { fotoId: fotoId },
			success: function(response) {
				$('#modalCommentList').html(response);
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	}

</script>

</body>

</html>