<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        echo "hao";die();
		$this->load->view('welcome_message');
	}

	public function undangan()
	{
		
		// $web = $this->uri->getSegment(2); //memabaca domain user
		// $invite = $this->uri->getSegment(3); //orang yang diundang disini

		// $data['web'] = urldecode($web);
		// $data['invite'] = urldecode($invite);
		
		//melakukan pengeceakan ke database
		// $cekDomain = $this->UndanganModel->cek_domain(urldecode($web));

		//jika ditemukan lanjut ke proses selanjutnya
		// if(!empty($cekDomain->getResult())){
			
			//jika data ditemukan maka kita akan ambil id_user nya
			foreach ($cekDomain->getResult() as $row)
			{
				$idnya = $row->id_user;
				$this->session->set('id_user',$idnya); //save di session untuk di load jika komentar
			}
			
			//id_user kemudian digunakan untuk mengambil semua data yang dibutuhkan
			// $data['mempelai'] = $this->UndanganModel->get_mempelai($idnya);
			// $data['acara'] = $this->UndanganModel->get_acara($idnya);
			// $data['komen'] = $this->UndanganModel->get_komen($idnya);
			// $data['data'] = $this->UndanganModel->get_data($idnya);
			// $data['cerita'] = $this->UndanganModel->get_cerita($idnya);
			// $data['album'] = $this->UndanganModel->get_album($idnya);
			// $data['rules'] = $this->UndanganModel->get_rules($idnya);

			$data['mempelai'] = '';
			$data['acara'] = '';
			$data['komen'] = '';
			$data['data'] = '';
			$data['cerita'] = '';
			$data['album'] = '';
			$data['rules'] = '';

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
			$invite = NULL;
			//insert traffic to db
			if($invite != NULL){
				$dataTraffic['nama_pengunjung'] = urldecode($invite);
			}else{
				$dataTraffic['nama_pengunjung'] = "Unknown";
			}
			// $dataTraffic['id_user'] = $idnya;
			$dataTraffic['id_user'] = '';
			$dataTraffic['addr'] = $this->get_client_ip();

			// $this->UndanganModel->insert_traffic($dataTraffic);
			

			//kirim semua data pada view
			return view('undangan/themes/'.$temanya, $data);
		// }else{
			// return $this->index();
		// }
	}
}
