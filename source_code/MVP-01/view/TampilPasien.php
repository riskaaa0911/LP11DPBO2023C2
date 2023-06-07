<?php


include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class TampilPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
			<a href='index.php?id_edit=" . $this->prosespasien->getId($i). "' class='btn btn-success''>Edit</a>
			<a href='index.php?id_hapus=" .$this->prosespasien->getId($i). "' class='btn btn-danger''>Hapus</a>
			</td>
		</tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	function delete($id){
		$this->prosespasien->delete_Pasien($id);
	}
	function add($data){
		$this->prosespasien->add_Pasien($data);
	}
	function edit($id, $data){
		$this->prosespasien->edit_Pasien($id,$data);
	}
	function tampil_form(){
		$this->tpl = new Template("templates/form.html");
		$title = "ADD Data Pasien";
		$this->tpl->replace("DATA_TITLE", $title);
		$this->tpl->write();
	}
	function tampil_form_edit($id) {
		$this->prosespasien->getDataPasienById($id);
		$this->tpl = new Template("templates/form.html");
		$this->tpl->replace("DATA_TITLE", "Edit Data Pasien");
		
		$this->tpl->replace("DATA_NIK", $this->prosespasien->getNik(0));
        $this->tpl->replace("DATA_NAMA", $this->prosespasien->getNama(0));
        $this->tpl->replace("DATA_TEMPAT", $this->prosespasien->getTempat(0));
        $this->tpl->replace("DATA_TL", $this->prosespasien->getTl(0));
        $this->tpl->replace("DATA_EMAIL", $this->prosespasien->getEmail(0));
        $this->tpl->replace("DATA_TELP", $this->prosespasien->getTelp(0));
        $lk = $this->prosespasien->getGender(0) === "Laki-laki" ? "checked" : "";
        $pr = $this->prosespasien->getGender(0) === "Perempuan" ? "checked" : "";
        $this->tpl->replace("DATA_LK", $lk);
        $this->tpl->replace("DATA_PR", $pr);

		// Menampilkan ke layar
		$this->tpl->write();

	}
}