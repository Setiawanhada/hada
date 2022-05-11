<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_undangan");
		
	}
	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }

	public function index()
	{
		$invite = '';
		// $web = $this->uri->getSegment(2); //memabaca domain user
		// $invite = $this->uri->getSegment(3); //orang yang diundang disini

		// $data['web'] = urldecode($web);
		// $data['invite'] = urldecode($invite);
		
		//melakukan pengeceakan ke database
		// $cekDomain = $this->UndanganModel->cek_domain(urldecode($web));

		//jika ditemukan lanjut ke proses selanjutnya
		// if(!empty($cekDomain->getResult())){
			
			//jika data ditemukan maka kita akan ambil id_user nya
			// foreach ($cekDomain->getResult() as $row)
			// {
			// 	$idnya = $row->id_user;
			// 	$this->session->set('id_user',$idnya); //save di session untuk di load jika komentar
			// }
			
			//id_user kemudian digunakan untuk mengambil semua data yang dibutuhkan
			// $data['mempelai'] = $this->UndanganModel->get_mempelai($idnya);
			// $data['acara'] = $this->UndanganModel->get_acara($idnya);
			// $data['komen'] = $this->UndanganModel->get_komen($idnya);
			// $data['data'] = $this->UndanganModel->get_data($idnya);
			// $data['cerita'] = $this->UndanganModel->get_cerita($idnya);
			// $data['album'] = $this->UndanganModel->get_album($idnya);
			// $data['rules'] = $this->UndanganModel->get_rules($idnya);
			$mempelai = array(
				'nama_panggilan_pria'   => 'hada',
				'nama_lengkap_pria'     => 'Suhada Budi Setiawan A.Md.Kom',
				'ayah_pria'             => 'Bapak Supardi',
				'ibu_pria'              => 'Ibu Sri Narsiti',
				'nama_panggilan_wanita' => 'puspa',
				'nama_lengkap_wanita'   => 'Tri Puspasari A.Md.Keb',
				'ayah_wanita'           => 'Bapak Matori Wardoyo',
				'ibu_wanita'            => 'Ibu Tukiyem',
			);
			$dat = array(
				'kunc'          => 'mIjh78y8ge13b89d99c1a29132e57d2ca',
				'video'         => 'https://youtu.be/qtvIQ9D99LI',
				'salam_pembuka' => 'Assalamualaikum warahmatullahi wabarakatuh Dengan memohon rahmat dan ridho Allah SWT, Kami akan menyelenggarakan resepsi pernikahan Putra-Putri kami :',
				'maps'          => '<iframe src="https://goo.gl/maps/xqJWeyBrYciBGvGd6" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
			);
			$acara = array(
				'tanggal_akad'    => '2022/11/06',
				'tempat_akad'     => 'Balai Desa Jatimulyo',
				'alamat_akad'     => 'Jatimulyo, Kec.Pedan, Kabupaten Klaten, Jawa Tengah',
				'tanggal_resepsi' => '2022/21/06',
				'jam_resepsi'     => '09.00 WIB',
				'jam_akad'        => '07.00 WIB',
				'tempat_resepsi'  => 'Balai Desa Jatimulyo',
				'alamat_resepsi'  => 'Jatimulyo, Kec.Pedan, Kabupaten Klaten, Jawa Tengah',
			);
			$album = array(
				'album'	=> 'album1',
			);
			$data['mempelai'] = $mempelai;
			$data['acara'] = $acara;
			$data['komen'] = $this->M_undangan->get_data_komen();
			$data['data'] = $dat;
			$data['cerita'] = '';
			$data['album'] = $album;
			$data['rules'] = '';
			$data['invite'] = $invite;

			//cek pada tabel order untuk mengambil tema yang digunakan user
			// $ordernya = $this->UndanganModel->get_order($idnya);

			//ini untuk mendefinisikan tema undangan secara default 
			//apabila tema yang direquest user tidak ditemukan
			$temanya = 'blueroses';
			
			//jika tema ditemukan maka
			//variabel tema akan di 'repleace' sesuai tema pilihan user
			// foreach ($ordernya->getResult() as $row){ 
			// 	$temanya = $row->nama_theme;
			// }
			$invite = "tes";
			//insert traffic to db
			// if($invite != NULL){
			// 	$dataTraffic['nama_pengunjung'] = urldecode($invite);
			// }else{
			// 	$dataTraffic['nama_pengunjung'] = "Unknown";
			// }
			// $dataTraffic['id_user'] = $idnya;
			$dataTraffic['id_user'] = '';
			// $dataTraffic['addr'] = $this->get_client_ip();

			// $this->UndanganModel->insert_traffic($dataTraffic);
			

			//kirim semua data pada view
			$this->load->view('undangan/themes/'.$temanya, $data);
			// return view('undangan/themes/'.$temanya, $data);
		// }else{
			// return $this->index();
		// }
	}
	public function add_komentar(){
		$data['nama_komentar'] = $_POST['nama'];
		$data['isi_komentar'] = $_POST['komentar'];
		// echo"<pre>";print_r($data);die();
		// $data['id_user'] = $_SESSION['id_user'];

		$update = $this->M_undangan->insert('komen',$data);
		if($update){
			echo json_encode(array('status' => 'sukses','nama' => ($data['nama_komentar']),'komentar' => ($data['isi_komentar']) ));
		}else{
			echo json_encode(array('status' => 'gagal'));
		}

	}
}
