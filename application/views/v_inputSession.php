<?php
	foreach ($data_userTrue as $akun){
       $this->session->set_userdata('id_user',$akun->id_user);
       $this->session->set_userdata('userFullName',$akun->userFullName);
       $this->session->set_userdata('email',$akun->userEmail);
       $this->session->set_userdata('awal_daftar',$akun->awal_daftar);
       $this->session->set_userdata('userPhoneNumber',$akun->userPhoneNumber);
    }

    $name = $this->session->userdata('userFullName');
    $parts = explode(' ', $name);
    $firstname = $parts[0];
    $this->session->set_userdata('namaDepan',trim($firstname));
   	
    $tampung = base_url();
   	header("Location: $tampung");
?>