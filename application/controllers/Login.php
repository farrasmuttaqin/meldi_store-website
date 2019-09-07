<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		error_reporting(E_ERROR|E_PARSE);
		if ($this->session->userdata('email')!=""){
            header("Location: ".base_url());
        }
    }
    
	public function index()
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
   		$data['provinsi'] = $get_prov->result();
   		$data['path'] = base_url('assets');   
        $this->load->view('v_header');
        $this->load->view('v_login',$data);
        $this->load->view('v_footer');
	}
	
	public function loginAction()
	{
		$email = $this->input->post('emailL');
		$password = $this->input->post('password');

		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
   		$data['provinsi'] = $get_prov->result();
   		$data['path'] = base_url('assets'); 

		$whereEmail = array(
			'userEmail' => $email
		);

		$where = array(
			'userEmail' => $email,
			'pass' => md5($password)
		);
		$whereSecond = array(
			'userEmail' => $email,
			'pass' => md5($password),
			'active' => 1
		);
		$cekEmail = $this->Login_model->loginCheck("tb_users",$whereEmail)->num_rows();
		$cek = $this->Login_model->loginCheck("tb_users",$where)->num_rows();
		$cekSecond = $this->Login_model->loginCheckSecond("tb_users",$whereSecond)->num_rows();

		if($cekEmail>0){
			if($cek > 0) {
				if ($cekSecond > 0){
					$data["data_userTrue"] = $this->Login_model->loginCheck("tb_users",$where)->result();
					$this->load->view('v_inputSession', $data);
				}else{
					$data["tampungLogin"] = 999;
					$data["superLogin"] = 1;
					$data["data_userFalse"] = $this->Login_model->loginCheck("tb_users",$where)->result();
					$this->load->view('v_header');
					$this->load->view('v_login',$data);
					$this->load->view('v_footer');
				}
			} else {
				$this->session->set_flashdata('lolwut', "99");
				redirect(base_url("login"));
			}
		}else{
			$this->session->set_flashdata('lolwut', "98");
			redirect(base_url("login"));
		}
			
	}

	public function forgot()
	{
		$hashh = $this->uri->segment(3);
		$email = $this->uri->segment(4);

		if (!$hashh == "" || !$email == "")
		{
			if ($this->Login_model->verifyCheckTwo($hashh,$email)){
				$this->load->view('v_header');
				$this->load->view('v_ubahPass');
				$this->load->view('v_footer');
				
			}else{
				redirect(base_url("login"));
			}
		}else{
			redirect(base_url("login"));
		}
	}

	public function changePassword()
	{
		$password = md5($this->input->post('p2'));
		$hashh = $this->input->post('hashh');
		$email = $this->input->post('email');

		$where = array(
			'hashh' => $hashh,
			'userEmail' => $email
		);

		$cek = $this->Login_model->changeMyPass("tb_users",$where)->num_rows();

		if ($cek>0){
			$this->Login_model->changePass($hashh,$email,$password);
			$this->Login_model->changeHash($hashh,$email);
			$data["tampung"] = 10;
			$this->load->view('v_header');
			$this->load->view('v_ubahPass',$data);
			$this->load->view('v_footer');
		}else{
			redirect(base_url());
		}
	}

	public function forgotAction()
	{
		$email = $this->input->post('emailF');

		$where = array(
			'userEmail' => $email
		);

		$cek = $this->Login_model->forgotPassword("tb_users",$where)->num_rows();
		$result = $this->Login_model->forgotPassword("tb_users",$where)->result();

		if($cek > 0) {

			foreach ($result as $hasil){
				$hash2=$hasil->hashh;
			}

			$messages = "
			<!DOCTYPE html>
				<html>
				<head>
				<title>Forgot Password</title>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
				<meta http-equiv='X-UA-Compatible' content='IE=edge' />
				<style type='text/css'>
				    /* CLIENT-SPECIFIC STYLES */
				    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
				    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
				    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

				    /* RESET STYLES */
				    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
				    table{border-collapse: collapse !important;}
				    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

				    /* iOS BLUE LINKS */
				    a[x-apple-data-detectors] {
				        color: inherit !important;
				        text-decoration: none !important;
				        font-size: inherit !important;
				        font-family: inherit !important;
				        font-weight: inherit !important;
				        line-height: inherit !important;
				    }

				    /* MOBILE STYLES */
				    @media screen and (max-width: 525px) {

				        /* ALLOWS FOR FLUID TABLES */
				        .wrapper {
				          width: 100% !important;
				        	max-width: 100% !important;
				        }

				        /* ADJUSTS LAYOUT OF LOGO IMAGE */
				        .logo img {
				          margin: 0 auto !important;
				        }

				        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
				        .mobile-hide {
				          display: none !important;
				        }

				        .img-max {
				          max-width: 100% !important;
				          width: 100% !important;
				          height: auto !important;
				        }

				        /* FULL-WIDTH TABLES */
				        .responsive-table {
				          width: 100% !important;
				        }

				        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
				        .padding {
				          padding: 10px 5% 15px 5% !important;
				        }

				        .padding-meta {
				          padding: 30px 5% 0px 5% !important;
				          text-align: center;
				        }

				        .no-padding {
				          padding: 0 !important;
				        }

				        .section-padding {
				          padding: 50px 15px 50px 15px !important;
				        }

				        /* ADJUST BUTTONS ON MOBILE */
				        .mobile-button-container {
				            margin: 0 auto;
				            width: 100% !important;
				        }

				        .mobile-button {
				            padding: 15px !important;
				            border: 0 !important;
				            font-size: 16px !important;
				            display: block !important;
				        }

				    }

				    /* ANDROID CENTER FIX */
				    div[style*='margin: 16px 0;'] { margin: 0 !important; }
				</style>
				</head>
				<body style='margin: 0 !important; padding: 0 !important;'>

				<!-- HIDDEN PREHEADER TEXT -->
				<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
				    Silahkan Reset Password Kamu Disini
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				    <tr>
				        <td style='background-color: white;' align='center'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='wrapper'>
				                <tr>
				                    <td align='center' valign='top' style='padding: 15px 0;' class='logo'>
				                        <a href='".base_url()."' target='_blank'>
				                            <img alt='Logo' src='https://meldistore.com/assets/images/toplogo.png' width='150' height='75' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;' border='0'>
				                        </a>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
				    <tr>
				        <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
				                <tr>
				                    <td>
				                        <!-- HERO IMAGE -->
				                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                           
				                            <tr>
				                                <td>
				                                    <!-- COPY -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding'>Reset Password</td>
				                                        </tr>
				                                        <tr>
				                                            <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>Reset Password Akun Meldi Store Kamu dengan Menekan Tombol Reset link dibawah</td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                            <tr>
				                                <td align='center'>
				                                    <!-- BULLETPROOF BUTTON -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='padding-top: 25px;' class='padding'>
				                                                <table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
				                                                    <tr>
				                                                    	<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."login/forgot/$hash2/$email' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Reset Password</a></td>
				                                                    </tr>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                        </table>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
					<tr>
					<td bgcolor='#ffffff' align='center' style='padding: 20px 0px;'>
						<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='max-width: 500px;' class='responsive-table'>
							<tr>
								<td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
									Meldi Store, Jl. Rw. Taman Cimanggis, Tanah Sereal
									<br>

									<a href='#' style='color: #666666; text-decoration: none;'>Kota Bogor, Jawa Barat</a>
									<span style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
									<a href='#' target='_blank' style='color: #666666; text-decoration: none;'>Indonesia</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				</table>
				</body>
				</html>
			";

            $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'mail.bhinestorm.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'meldi@bhinestorm.com';
            $config['smtp_pass']    = 'meldi123';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);
            $this->email->from('meldi@bhinestorm.com', 'Meldi Store');
            $this->email->to($email); 
            $this->email->subject('Reset Your Account Password');
            $this->email->message($messages);
            $this->email->send();
            
            //php mailer :
            
            // $this->load->library('phpmailer_lib');
            // $mail = $this->phpmailer_lib->load();
            // $mail->isSMTP();
            // $mail->Host     = 'mail.bhinestorm.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'meldi@bhinestorm.com';
            // $mail->Password = 'meldi123';
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port     = 465;
            // $mail->setFrom('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addReplyTo('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addAddress($email);
            // $mail->Subject = 'Reset Your Account Password';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();

			$this->session->set_flashdata('lolwut', "3");
			redirect(base_url("login"));
		} else {
			$this->session->set_flashdata('lolwut', "4");
			redirect(base_url("login"));
		}
	}

    public function register()
	{
        $namaLengkap = $this->input->post('namaLengkap');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gmapz = $this->input->post('gmapz');

        
		$provinsi = $this->input->post('prov');
		$whereProvinsi = array(
			'id' => $provinsi
		);
		$getProvinsi=$this->Login_model->getAddress("wilayah_provinsi",$whereProvinsi)->result();
		foreach ($getProvinsi as $prov){
			$provinsiS = $prov->nama;
		}

		
		$kabupaten = $this->input->post('kab');
		$whereKabupaten = array(
			'id' => $kabupaten
		);
		$getKabupaten=$this->Login_model->getAddress("wilayah_kabupaten",$whereKabupaten)->result();
		foreach ($getKabupaten as $kab){
			$kabupatenS = $kab->nama;
		}


		$kecamatan = $this->input->post('kec');
		$whereKecamatan = array(
			'id' => $kecamatan
		);
		$getKecamatan=$this->Login_model->getAddress("wilayah_kecamatan",$whereKecamatan)->result();
		foreach ($getKecamatan as $kec){
			$kecamatanS = $kec->nama;
		}


		$desa = $this->input->post('des');
		$whereDesa = array(
			'id' => $desa
		);
		$getDesa=$this->Login_model->getAddress("wilayah_desa",$whereDesa)->result();
		foreach ($getDesa as $des){
			$desaS = $des->nama;
		}
		

		$detailAlamat = $this->input->post('detailAlamat');

        $password = md5($this->input->post('password2'));
        $hash = md5(uniqid(rand(), true));
        $date = date("h:i A, Y/m/d");
        $active = 0;

        $whereInsert = array(
			'userFullName' => $namaLengkap,
			'userEmail' => $email,
			'userPhoneNumber' => $phone,
			'userProvinsi' => $provinsiS,
			'userKabupaten' => $kabupatenS,
			'userKecamatan' => $kecamatanS,
			'userDesa' => $desaS,
			'userDetailAlamat' => $detailAlamat,
			'pass' => $password,
			'hashh' => $hash,
			'awal_daftar' => $date,
			'active' => $active
		);

        if ($this->Login_model->registerCheck($email,$phone)){
			$this->session->set_flashdata('lolwut', "1");
			redirect(base_url("login"));
		}else{

			$messages = "
			<!DOCTYPE html>
				<html>
				<head>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
				<meta http-equiv='X-UA-Compatible' content='IE=edge' />
				<style type='text/css'>
				    /* CLIENT-SPECIFIC STYLES */
				    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
				    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
				    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

				    /* RESET STYLES */
				    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
				    table{border-collapse: collapse !important;}
				    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

				    /* iOS BLUE LINKS */
				    a[x-apple-data-detectors] {
				        color: inherit !important;
				        text-decoration: none !important;
				        font-size: inherit !important;
				        font-family: inherit !important;
				        font-weight: inherit !important;
				        line-height: inherit !important;
				    }

				    /* MOBILE STYLES */
				    @media screen and (max-width: 525px) {

				        /* ALLOWS FOR FLUID TABLES */
				        .wrapper {
				          width: 100% !important;
				        	max-width: 100% !important;
				        }

				        /* ADJUSTS LAYOUT OF LOGO IMAGE */
				        .logo img {
				          margin: 0 auto !important;
				        }

				        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
				        .mobile-hide {
				          display: none !important;
				        }

				        .img-max {
				          max-width: 100% !important;
				          width: 100% !important;
				          height: auto !important;
				        }

				        /* FULL-WIDTH TABLES */
				        .responsive-table {
				          width: 100% !important;
				        }

				        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
				        .padding {
				          padding: 10px 5% 15px 5% !important;
				        }

				        .padding-meta {
				          padding: 30px 5% 0px 5% !important;
				          text-align: center;
				        }

				        .no-padding {
				          padding: 0 !important;
				        }

				        .section-padding {
				          padding: 50px 15px 50px 15px !important;
				        }

				        /* ADJUST BUTTONS ON MOBILE */
				        .mobile-button-container {
				            margin: 0 auto;
				            width: 100% !important;
				        }

				        .mobile-button {
				            padding: 15px !important;
				            border: 0 !important;
				            font-size: 16px !important;
				            display: block !important;
				        }

				    }

				    /* ANDROID CENTER FIX */
				    div[style*='margin: 16px 0;'] { margin: 0 !important; }
				</style>
				</head>
				<body style='margin: 0 !important; padding: 0 !important;'>

				<!-- HIDDEN PREHEADER TEXT -->
				<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
				    Silahkan Aktifkan Akun Kamu Disini
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				    <tr>
				        <td style='background-color: white;' align='center'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='wrapper'>
				                <tr>
				                    <td align='center' valign='top' style='padding: 15px 0;' class='logo'>
				                        <a href='".base_url()."' target='_blank'>
				                            <img alt='Logo' src='https://meldistore.com/assets/images/toplogo.png' width='150' height='75' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;' border='0'>
				                        </a>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
				    <tr>
				        <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
				                <tr>
				                    <td>
				                        <!-- HERO IMAGE -->
				                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                            
				                            <tr>
				                                <td>
				                                    <!-- COPY -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding'>Aktifkan Akun</td>
				                                        </tr>
				                                        <tr>
				                                            <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>Aktifkan Akun Meldi Store Kamu dengan Menekan Button di bawah ini</td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                            <tr>
				                                <td align='center'>
				                                    <!-- BULLETPROOF BUTTON -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='padding-top: 25px;' class='padding'>
				                                                <table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
				                                                    <tr>
				                                                    	<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."login/verify/$hash/$email' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Aktifkan Akun Saya</a></td>
				                                                    </tr>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                        </table>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
				    <tr>
				        <td bgcolor='#ffffff' align='center' style='padding: 20px 0px;'>
				            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='max-width: 500px;' class='responsive-table'>
				                <tr>
				                    <td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
										Meldi Store, Jl. Rw. Taman Cimanggis, Tanah Sereal
				                        <br>

				                        <a href='#' style='color: #666666; text-decoration: none;'>Kota Bogor, Jawa Barat</a>
				                        <span style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
				                        <a href='#' target='_blank' style='color: #666666; text-decoration: none;'>Indonesia</a>
				                    </td>
				                </tr>
				            </table>
				        </td>
				    </tr>
				</table>
				</body>
				</html>
			";

            $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'storemeldi@gmail.com';
            $config['smtp_pass']    = 'storemeldi165';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);
            $this->email->from('storemeldi@gmail.com', 'Meldi Store');
            $this->email->to($email); 
            $this->email->subject('Account Activation Code');
            $this->email->message($messages);
            $this->email->send();
            
            // $this->load->library('phpmailer_lib');
            // $mail = $this->phpmailer_lib->load();
            // $mail->isSMTP();
            // $mail->Host     = 'mail.bhinestorm.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'meldi@bhinestorm.com';
            // $mail->Password = 'meldi123';
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port     = 465;
            // $mail->setFrom('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addReplyTo('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addAddress($email);
            // $mail->Subject = 'Account Activation Code';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
            
            $this->session->set_flashdata('lolwut', "2");
			$this->Login_model->registerInsert($whereInsert);
			redirect(base_url("login"));
		}
	}

	public function verify()
	{
		$hashh = $this->uri->segment(3);
		$email = $this->uri->segment(4);
		if ($hashh == ''|| $email == ''){
			redirect(base_url());
		}else{
			if ($this->Login_model->verifyCheckOne($hashh,$email)){
				$this->Login_model->verify($hashh,$email);
				$data["tampung"] = 1;
				$this->load->view('v_header');
				$this->load->view('v_verify',$data);
				$this->load->view('v_footer');
			}else{
				if ($this->Login_model->verifyCheckTwo($hashh,$email)){
					$data["tampung"] = 2; //ditemukan sudah di verif
					$this->load->view('v_header');
					$this->load->view('v_verify',$data);
					$this->load->view('v_footer');
				}else{
					redirect(base_url("login"));
				}
			}
		}
	}

	public function verificationSent()
	{
		$data["tampungLogin"] = 999;
		$this->load->view('v_header');
        $this->load->view('v_login',$data);
        $this->load->view('v_footer');
	}

	public function sentVerification()
	{
		$email = $_SESSION["emailFalse"];
		$hashh = $_SESSION["hashh"];

		$messages = "
			<!DOCTYPE html>
				<html>
				<head>
				<title>Sent Verification</title>
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
				<meta http-equiv='X-UA-Compatible' content='IE=edge' />
				<style type='text/css'>
				    /* CLIENT-SPECIFIC STYLES */
				    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
				    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
				    img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

				    /* RESET STYLES */
				    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
				    table{border-collapse: collapse !important;}
				    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

				    /* iOS BLUE LINKS */
				    a[x-apple-data-detectors] {
				        color: inherit !important;
				        text-decoration: none !important;
				        font-size: inherit !important;
				        font-family: inherit !important;
				        font-weight: inherit !important;
				        line-height: inherit !important;
				    }

				    /* MOBILE STYLES */
				    @media screen and (max-width: 525px) {

				        /* ALLOWS FOR FLUID TABLES */
				        .wrapper {
				          width: 100% !important;
				        	max-width: 100% !important;
				        }

				        /* ADJUSTS LAYOUT OF LOGO IMAGE */
				        .logo img {
				          margin: 0 auto !important;
				        }

				        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
				        .mobile-hide {
				          display: none !important;
				        }

				        .img-max {
				          max-width: 100% !important;
				          width: 100% !important;
				          height: auto !important;
				        }

				        /* FULL-WIDTH TABLES */
				        .responsive-table {
				          width: 100% !important;
				        }

				        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
				        .padding {
				          padding: 10px 5% 15px 5% !important;
				        }

				        .padding-meta {
				          padding: 30px 5% 0px 5% !important;
				          text-align: center;
				        }

				        .no-padding {
				          padding: 0 !important;
				        }

				        .section-padding {
				          padding: 50px 15px 50px 15px !important;
				        }

				        /* ADJUST BUTTONS ON MOBILE */
				        .mobile-button-container {
				            margin: 0 auto;
				            width: 100% !important;
				        }

				        .mobile-button {
				            padding: 15px !important;
				            border: 0 !important;
				            font-size: 16px !important;
				            display: block !important;
				        }

				    }

				    /* ANDROID CENTER FIX */
				    div[style*='margin: 16px 0;'] { margin: 0 !important; }
				</style>
				</head>
				<body style='margin: 0 !important; padding: 0 !important;'>

				<!-- HIDDEN PREHEADER TEXT -->
				<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
				    Silahkan Aktifkan Akun Kamu Disini
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
				    <tr>
				        <td style='background-color: white;' align='center'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='wrapper'>
				                <tr>
				                    <td align='center' valign='top' style='padding: 15px 0;' class='logo'>
				                        <a href='".base_url()."' target='_blank'>
				                            <img alt='Logo' src='https://meldistore.com/assets/images/toplogo.png' width='150' height='75' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;' border='0'>
				                        </a>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
				    <tr>
				        <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'>
				            <!--[if (gte mso 9)|(IE)]>
				            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
				            <tr>
				            <td align='center' valign='top' width='500'>
				            <![endif]-->
				            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
				                <tr>
				                    <td>
				                        <!-- HERO IMAGE -->
				                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                            
				                            <tr>
				                                <td>
				                                    <!-- COPY -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding'>Aktifkan Akun</td>
				                                        </tr>
				                                        <tr>
				                                            <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>Aktifkan Akun Meldi Store Kamu dengan Menekan Button dibawah ini</td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                            <tr>
				                                <td align='center'>
				                                    <!-- BULLETPROOF BUTTON -->
				                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
				                                        <tr>
				                                            <td align='center' style='padding-top: 25px;' class='padding'>
				                                                <table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
				                                                    <tr>
				                                                    	<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."login/verify/$hashh/$email' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Aktifkan Akun Saya</a></td>
				                                                    </tr>
				                                                </table>
				                                            </td>
				                                        </tr>
				                                    </table>
				                                </td>
				                            </tr>
				                        </table>
				                    </td>
				                </tr>
				            </table>
				            <!--[if (gte mso 9)|(IE)]>
				            </td>
				            </tr>
				            </table>
				            <![endif]-->
				        </td>
				    </tr>
					<tr>
					<td bgcolor='#ffffff' align='center' style='padding: 20px 0px;'>
						<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='max-width: 500px;' class='responsive-table'>
							<tr>
								<td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
									Meldi Store, Jl. Rw. Taman Cimanggis, Tanah Sereal
									<br>

									<a href='#' style='color: #666666; text-decoration: none;'>Kota Bogor, Jawa Barat</a>
									<span style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
									<a href='#' target='_blank' style='color: #666666; text-decoration: none;'>Indonesia</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				</table>
				</body>
				</html>
			";

        $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'storemeldi@gmail.com';
            $config['smtp_pass']    = 'storemeldi165';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            $this->email->initialize($config);
            $this->email->from('storemeldi@gmail.com', 'Meldi Store');
            $this->email->to($email); 
            $this->email->subject('Account Activation Code');
            $this->email->message($messages);
            $this->email->send();
        
        // php mailer:
        
            // $this->load->library('phpmailer_lib');
            // $mail = $this->phpmailer_lib->load();
            // $mail->isSMTP();
            // $mail->Host     = 'mail.bhinestorm.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'meldi@bhinestorm.com';
            // $mail->Password = 'meldi123';
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port     = 465;
            // $mail->setFrom('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addReplyTo('meldi@bhinestorm.com', 'Meldi Store');
            // $mail->addAddress($email);
            // $mail->Subject = 'Account Activation Code';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();

        redirect(base_url()."login/verificationSent/1/");
	}
  
	function add_ajax_kab($id_prov)
	{
    	$query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
    	$data = "<option value=''>- Select Kabupaten -</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_kec($id_kab)
	{
    	$query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
    	$data = "<option value=''> - Pilih Kecamatan - </option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}
  
	function add_ajax_des($id_kec)
	{
    	$query = $this->db->get_where('wilayah_desa',array('kecamatan_id'=>$id_kec));
    	$data = "<option value=''> - Pilih Desa - </option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id."'>".$value->nama."</option>";
    	}
    	echo $data;
	}
}