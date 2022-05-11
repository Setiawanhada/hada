<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // $this->load->model("M_undangan");
		
	}

	public function index()
	{
		$invite = '';
		// $web = $this->uri->getSegment(2); //memabaca domain user
		$invite = $this->uri->getSegment(3); //orang yang diundang disini

		// $data['web'] = urldecode($web);
		// $data['invite'] = urldecode($invite);
		
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
				'tanggal_resepsi' => '2022/11/06',
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
			$data['komen'] = '';
			$data['data'] = $dat;
			$data['cerita'] = '';
			$data['album'] = $album;
			$data['rules'] = '';
			$data['invite'] = $invite;

			$temanya = 'blueroses';
			
			$dataTraffic['id_user'] = '';
			
			

			//kirim semua data pada view
			$this->load->view('undangan/themes/'.$temanya, $data);
			
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
