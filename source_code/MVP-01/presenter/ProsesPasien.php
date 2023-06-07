<?php

include_once("kontrak/KontrakPasien.php");

class ProsesPasien implements KontrakPasienPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "pasien"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']);
				$pasien->setTelp($row['telp']);

				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}
	function delete_Pasien($id) {
		try {
			$pasien = new Pasien(); 
			$pasien->setId($id); 
			$this->tabelpasien->open(); 
			$this->tabelpasien->deletePasien($pasien->getId()); 
			$this->tabelpasien->close(); 
		} catch (Exception $e) {
			echo "wiw error part 3" . $e->getMessage();
		}
	}
	function add_Pasien($data) {
		try {
			$this->tabelpasien->open(); 
			$this->tabelpasien->addPasien($data); 
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "wiw error part 4" . $e->getMessage();
		}
	}
	function getDataPasienById($id) {
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->getPasienById($id);
			$row = $this->tabelpasien->getResult();
			$this->data[] = $row; 
			
		} catch (Exception $e) {
			echo "wiw error part 6" . $e->getMessage();
		}
	} 
	function edit_Pasien($id, $data) {
		$this->tabelpasien->open();
		$this->tabelpasien->editPasien($id, $data);
		$this->tabelpasien->close();
	}
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}