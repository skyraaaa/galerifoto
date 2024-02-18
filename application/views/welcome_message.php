<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Web Gallery</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="<?php echo base_url('assets/https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')?>"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
	<!-- <link href="assets/css/sb-admin-2.min.css" rel="stylesheet"> -->


    <style>
    <style>
    .navbar {
        background-color: #your_color; /* Ganti #your_color dengan kode warna yang diinginkan */
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Jika Anda ingin memberikan margin pada navbar */
    .navbar {
        margin: 10px;
    }
</style>

</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background: linear-gradient(45deg, #164863, #164863)" id="accordionSidebar">
<br>
            <!-- Sidebar - Brand -->
            <li class="nav-item dropdown">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="profile">
            <img src="<?= base_url('assets/images/icon.png') ?>" alt="" style="width: 50px; height: 50px; border-radius: 50%;">

            <div class="profile-text" style="font-size: 12px;">
                    <?php
                                // Ambil nama pengguna dari sesi
                                $username = $this->session->userdata('username');
                                echo $username;
                            ?>
            </div>
            </div>
            </a>
            </li>
            <!-- Divider -->
            

           
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Welcome/beranda');?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

             <!-- Divider -->
             

            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('Welcome/gallery'); ?>">
                    <i class="fas fa-solid fa-image"></i>
                    <span>Album</span></a>
            </li>

             <!-- Divider -->
        

            <!-- <li class="nav-item">
                <a class="nav-link"  href="<?php echo site_url('Welcome/foto'); ?>">
                <i class="fas fa-solid fa-camera-retro"></i>
                    <span>Foto</span></a>
            </li> -->
            <br>
            
            <li class="nav-item no-arrow">
                <!-- Tombol Logout -->
                <div class="text-center">
                    <a class="btn" data-toggle="modal" data-target="#logoutModal" href="<?php echo site_url('Home'); ?>"
                        style="background-color: #9BB8CD;">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

           


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
			

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               

                


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                     
                       


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
				<div class="container-fluid">

                </div>
                <!-- /.container-fluid -->
                <?php $this->load->view($content); ?>

            </div>
            <!-- End of Main Content -->
            

            
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

     <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin ingin keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" jika Anda ingin keluar dari aplikasi ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="<?php echo site_url('Welcome/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>



    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js')?>"></script>

</body>

</html>