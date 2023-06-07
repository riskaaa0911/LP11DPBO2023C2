<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
include_once("view/TampilPasien.php");


$tp = new TampilPasien();
if (isset($_POST['btn-submit'])) {
   $id = $_GET['id_edit'];
    if ($id != null) {
      $tp->edit($id, $_POST);
      header("location:index.php");
    }
    else {
     // memanggil add
      $tp->add($_POST);
      header("location:index.php");
    }
}
//mengecek apakah ada id_hapus, jika ada maka memanggil fungsi delete
if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $tp->delete($id);
    header("location:index.php");
}
else if (isset($_GET['add'])) {
  $tp->tampil_form();
}
else if (isset($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $tp->tampil_form_edit($id);
}
else{
    $data = $tp->tampil();;
}