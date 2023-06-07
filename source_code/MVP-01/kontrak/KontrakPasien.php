<?php

  interface KontrakPasienView {
      public function tampil();
      public function delete($id);
      public function add($data);
      public function edit($id, $data);
      public function tampil_form();
      public function tampil_form_edit($id);
  }

  interface KontrakPasienPresenter {
      public function prosesDataPasien();
      public function delete_Pasien($id);
      public function add_Pasien($data);
      public function getDataPasienById($id);
      public function edit_Pasien($id, $data);
      public function getId($i);
      public function getNik($i);
      public function getNama($i);
      public function getTempat($i);
      public function getTl($i);
      public function getGender($i);
      public function getEmail($i);
      public function getTelp($i);
      public function getSize();
  }