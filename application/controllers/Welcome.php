<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Welcome extends CI_Controller
	{

		public $input;
		public $MSudi;
		function __construct()
		{
			parent::__construct();
			$this->load->model('MSudi');
		}

		public function index()
		{
			if ($this->session->userdata('Login')) {
				// Memuat model MSudi
				$this->load->model('MSudi');
			
				$userid = $this->session->userdata('userid');
		
				// Mengakses data dari model
				$data['DataFoto'] = $this->MSudi->GetData('foto');
				$data['content'] = 'beranda';
				$this->load->view('welcome_message', $data);
			} else {
				redirect(site_url('Login'));
			}
		}

		public function beranda()
		{
			if ($this->session->userdata('Login')) {
				// Memuat model MSudi
				$this->load->model('MSudi');
			
				$userid = $this->session->userdata('userid');
		
				// Mengakses data dari model
				$data['DataFoto'] = $this->MSudi->GetData('foto');
				$data['content'] = 'beranda';
				$this->load->view('welcome_message', $data);
			} else {
				redirect(site_url('Login'));
			}
		}

		public function gallery()
		{
			if ($this->session->userdata('Login')){
			// Memuat model MSudi
			$this->load->model('MSudi');

			// Mengakses data dari model
			$userid = $this->session->userdata('userid');
			$data['DataAlbum'] = $this->MSudi->GetDataWhere('album', 'userid', $userid)->result();
			$data['content'] = 'gallery/album';
			$this->load->view('welcome_message', $data);
		} else {
			redirect(site_url('Login'));
		}
		}

		public function addDataAlbum()
		{
			if ($this->session->userdata('Login')){
			$add['albumid'] = $this->input->post('albumid');
			$add['namaalbum'] = $this->input->post('namaalbum');
			$add['deskripsi'] = $this->input->post('deskripsi');
			$add['tanggaldibuat'] = $this->input->post('tanggaldibuat');
			$add['userid'] = $this->input->post('userid');
			$this->MSudi->AddData('album', $add);
			redirect(site_url('Welcome/gallery'));
		} else {
			redirect(site_url('Login'));
		}
		}

		public function updateDataAlbum()
		{
			if ($this->session->userdata('Login')){
			$albumid = $this->input->post('albumid');
			$update['namaalbum'] = $this->input->post('namaalbum');
			$update['deskripsi'] = $this->input->post('deskripsi');
			$update['tanggaldibuat'] = $this->input->post('tanggaldibuat');
			$this->MSudi->UpdateData('album', 'albumid', $albumid, $update);
			redirect(site_url('Welcome/gallery'));
		} else {
			redirect(site_url('Login'));
		}
		}

		public function deleteDataAlbum($albumid)
		{
			if ($this->session->userdata('Login')){
			$this->load->model('MSudi');

			$this->MSudi->DeleteData('album', 'albumid', $albumid);

			// Redirect ke halaman master setelah penghapusan
			redirect(site_url('Welcome/gallery'));
		} else {
			redirect(site_url('Login'));
		}
		}

		public function foto($albumid = null)
		{
			if ($this->session->userdata('Login')) {
				// Load the MSudi model
				$this->load->model('MSudi');

				// Check if albumid is provided
				if (!is_null($albumid)) {
					// Get photos for the selected album
					$data['DataFoto'] = $this->MSudi->GetDataWhere('foto', 'albumid', $albumid)->result();
				} else {
					// If albumid is not provided, you can handle it accordingly (e.g., show an error message)
					$data['DataFoto'] = array(); // Set empty array
				}

				// Load the view
				$data['content'] = 'gallery/foto';
				$this->load->view('welcome_message', $data);
			} else {
				redirect(site_url('Login'));
			}
		}

		public function addDataFoto($albumid) {
			if ($this->session->userdata('Login')) {
				$config['upload_path']   = './assets/img/';  // Sesuaikan dengan direktori penyimpanan gambar Anda
				$config['allowed_types'] = 'gif|jpg|jpeg|png';  // Format gambar yang diizinkan
				$config['max_size']      = 3218319;  // Ukuran maksimal file dalam KB
				$config['encrypt_name']  = TRUE;  // Mengenkripsi nama file untuk menghindari konflik nama
		
				$this->load->library('upload', $config);
				$userid=$this->session->userdata('userid');
			
		
				if ($this->upload->do_upload('lokasifile')) {
					// Gambar berhasil diunggah
					$upload_data = $this->upload->data();


		
					// Menyiapkan data untuk disimpan ke database
					$add['judulfoto'] = $this->input->post('judulfoto');
					$add['deskripsifoto'] = $this->input->post('deskripsifoto');
					$add['tanggalunggah'] = $this->input->post('tanggalunggah');
					$add['albumid'] = $albumid;
					$add['userid'] = $userid;
					$add['lokasifile'] = $upload_data['file_name'];  // Menyimpan nama file gambar yang diunggah
		
					// Menyimpan data ke database
					$this->MSudi->AddData('foto', $add);
		
					// Redirect atau lakukan operasi lain setelah menyimpan data
					redirect(site_url('Welcome/foto/'.$add['albumid']));
				} else {
					// Kesalahan saat mengunggah gambar
					$error = array('error' => $this->upload->display_errors());
					// Tambahkan log atau tangani kesalahan sesuai kebutuhan aplikasi Anda
					print_r($error);
				}
			} else {
				redirect(site_url('Login'));
			}
		}
	

// 		public function updateDataFoto()
// {
//     if ($this->session->userdata('Login')) {
//         $config['upload_path']   = './assets/img/';  
//         $config['allowed_types'] = 'gif|jpg|jpeg|png';  
//         $config['max_size']      = 3218319;  
//         $config['encrypt_name']  = TRUE;  

//         $this->load->library('upload', $config);

//         $fotoid = $this->input->post('fotoid');
//         $update['judulfoto'] = $this->input->post('judulfoto');
//         $update['deskripsifoto'] = $this->input->post('deskripsifoto');
//         $update['tanggalunggah'] = $this->input->post('tanggalunggah');
//         $update['albumid'] = $this->input->post('albumid');

//         // Cek apakah file berhasil diunggah
//         if ($this->upload->do_upload('lokasifile')) {
//             $upload_data = $this->upload->data();
//             $update['lokasifile'] = $upload_data['file_name'];  
//         } else {
//             // Jika tidak ada file yang diunggah, gunakan nama file yang ada di database
//             $update['lokasifile'] = $this->input->post('lokasifile_existing');
//         }

//         // Panggil model untuk melakukan update data
//         $this->load->model('MSudi');

//         // Panggil fungsi getAlbumIdByFotoId untuk mendapatkan albumid
//         $albumid = $this->MSudi->getAlbumIdByFotoId($fotoid);

//         if ($albumid) {
//             // Albumid ditemukan, lanjutkan dengan update dan redirect ke halaman yang sesuai
//             $this->MSudi->UpdateData('foto', 'fotoid', $fotoid, $update);
//             redirect(site_url('Welcome/foto/'.$albumid));
//         } else {
//             // Albumid tidak ditemukan, redirect ke halaman foto tanpa albumid
//             redirect(site_url('Welcome/foto'));
//         }
//     } else {
//         redirect(site_url('Login'));
//     }
// }



		

		public function deleteDataFoto($fotoid)
		{
			if ($this->session->userdata('Login')) {
				$this->load->model('MSudi');

				// Dapatkan albumid terlebih dahulu sebelum menghapus
				$albumid = $this->MSudi->getAlbumIdByFotoId($fotoid); // Misalkan ada fungsi untuk mendapatkan albumid berdasarkan fotoid

				$this->MSudi->DeleteData('foto', 'fotoid', $fotoid);

				// Redirect ke halaman yang sama dengan albumid yang sama
				redirect(site_url('Welcome/foto/'.$albumid));
			} else {
				redirect(site_url('Login'));
			}
		}


		public function user()
		{
			
			if ($this->session->userdata('Login')) {
				// Memuat model MSudi
				$this->load->model('MSudi');
		
				// Mengakses data dari model
				$data['DataUser'] = $this->MSudi->GetData('user');
				$data['userid']    = $this->MSudi->GetblokAlbum('user');
				$data['content'] = 'gallery/user';
				$this->load->view('welcome_message', $data);
			} else {
				redirect(site_url('Login'));
			}
		}
		
		public function addDataUser()
			{
				if ($this->session->userdata('Login')) {
					$add['userid'] = $this->input->post('userid');
					$add['username'] = $this->input->post('username');
					$add['password'] = $this->input->post('password');
					$add['email'] = $this->input->post('email');
					$add['namalengkap'] = $this->input->post('namalengkap');
					$add['alamat'] = $this->input->post('alamat');
					
		
					$this->MSudi->AddData('user', $add);
					redirect(site_url('Welcome/user'));
				} else {
					redirect(site_url('Login'));
				}
			}
		
			
			public function updateDataUser()
			{
				if ($this->session->userdata('Login')) {
					$userid = $this->input->post('userid');
					$update['userid'] = $this->input->post('userid');
					$update['username'] = $this->input->post('username');
					$update['password'] = $this->input->post('password');
					$update['email'] = $this->input->post('email');
					$update['namalengkap'] = $this->input->post('namalengkap');
					$update['alamat'] = $this->input->post('alamat');
		
					$this->MSudi->UpdateData('user', 'userid', $userid, $update);
					redirect(site_url('Welcome/user'));
				} else {
					redirect(site_url('Login'));
				}
			}
		
			
			public function deleteDataUser($userid)
			{
				if ($this->session->userdata('Login')) {
					$this->load->model('MSudi');
					$this->MSudi->DeleteData('user', 'userid', $userid);
		
					// Redirect ke halaman master setelah penghapusan
					redirect(site_url('Welcome/user'));
				} else {
					redirect(site_url('Login'));
				}
			}

			public function logout()
			{
				// Unset session data
				$this->session->unset_userdata('Login');
		
				// Redirect to 'Login' controller
				redirect(site_url('Login'));
			}

			
			public function display_namaalbum() {
				// Call the method in the model to get only namaalbum
				$data['album'] = $this->MSudi->relasialbum();
		
				// Load a view to display the data
				$this->load->view('foto', $data);
			}

			public function addDataKomentar()
			{
				if ($this->session->userdata('Login')) {
					$userId = $this->session->userdata('userid');
					$fotoId = $this->input->post('fotoid');
					$isiKomentar = $this->input->post('comment');
					$tanggalKomentar = date('Y-m-d H:i:s'); // Menggunakan waktu saat ini sebagai tanggal komentar

					// Menyiapkan data komentar untuk dimasukkan ke dalam database
					$komentarfoto = array(
						'fotoid' => $fotoId,
						'userid' => $userId,
						'isikomentar' => $isiKomentar,
						'tanggalkomentar' => $tanggalKomentar
					);
					
					echo $fotoId;
					// Memasukkan komentar ke dalam database menggunakan model MSudi
					$this->MSudi->AddData('komentarfoto', $komentarfoto);

					// Mengirimkan data komentar ke view
					$data['komentarfoto'] = $komentarfoto;

					$this->load->view('beranda', $komentarfoto);

					// Mengarahkan kembali ke halaman beranda setelah berhasil menambahkan komentar
					redirect(site_url('../index.php/Welcome/beranda'));
				} else {
					// Jika pengguna tidak login, mengarahkan ke halaman login
					redirect(site_url('Login'));
				}
			}

			// TODO by HamsterKaget : function to format the commentar time
			public function formatTime($tanggalkomentar){
				// $tanggalkomentar = '2024-02-16 01:55:04';

				// Convert the timestamp to a DateTime object
				$commentDateTime = new DateTime($tanggalkomentar);
				$currentDateTime = new DateTime();

				// Calculate the difference between the comment date and current date
				$interval = $commentDateTime->diff($currentDateTime);
				
				$formattedDate = '';
				// Format the date accordingly
				if ($interval->days > 0) {
					if ($interval->days == 1) {
						$formattedDate = '1 day ago';
					} else {
						$formattedDate = $interval->days . ' days ago';
					}
				} elseif ($interval->h > 0) {
					if ($interval->h == 1) {
						$formattedDate = '1 hour ago';
					} else {
						$formattedDate = $interval->h . ' hours ago';
					}
				} elseif ($interval->i > 0) {
					if ($interval->i == 1) {
						$formattedDate = '1 minute ago';
					} else {
						$formattedDate = $interval->i . ' minutes ago';
					}
				} else {
					$formattedDate = 'Just now';
				}

				return $formattedDate;
			}

			// TODO by HamsterKaget : function to send the list of comentar
			public function getComment() {
				$fotoId = $this->input->get('fotoId');
				// Load your model assuming you have a model named KomentarFotoModel
				$comments = $this->MSudi->getComment($fotoId);
				$html = '';
				// var_dump($comments);
				if(count($comments) != 0) {
					foreach ($comments as $comment) {
						$html .= '
						<li class="list-group-item">
							<div class="media flex flex-column">
								<h4 class="media-heading user_name">'.$comment->username.'</h4>
								<p style="margin-top: -6px; margin-bottom: 6px;"><small>'.$this->formatTime($comment->tanggalkomentar).'</small></p>
								<div class="media-body">
									'. $comment->isikomentar .'
								</div>
							</div>
						</li>';
					}
				} else {
					$html .= '
					<li class="list-group-item">
						<div class="alert alert-warning" role="alert">
						Belum ada komentar pada foto ini
						</div>
					</li>
					';
				}
				echo $html;
			}

			
	

	}