<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Admin_model");
		if ($_SESSION["nama_lengkap_admin"]==""){
				$tampung = base_url()."backend";
				header("Location: $tampung");
		}
		error_reporting(E_ERROR|E_PARSE);
	}
	
	public function index()
	{	
		$data["navnav"] = 1;
		$data["invoice"] = $this->Admin_model->getInvoice()->result();
        $this->load->view("admin/v_header");
        $this->load->view("admin/v_beranda",$data);
        $this->load->view("admin/v_footer");
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."administrator/");
	}

	public function user()
	{
		$data["navnav"] = 2;
		$data["user"] = $this->Admin_model->getUser()->result();
        $this->load->view("admin/v_header");
        $this->load->view("admin/v_user",$data);
        $this->load->view("admin/v_footer");
	}

	public function contact()
	{
		$data["navnav"] = 3;
		$data["contact"] = $this->Admin_model->getContact()->result();
        $this->load->view("admin/v_header");
        $this->load->view("admin/v_contact",$data);
        $this->load->view("admin/v_footer");
	}
	
	public function edit()
	{	
		$data["navnav"] = 1;
		
		$nomor_invoice = $this->uri->segment(3);

		if ($nomor_invoice == ""){
			redirect(base_url()."administrator");
		}


		$data["getInvoice"]=$this->Admin_model->getDetail($nomor_invoice)->result();

        $this->load->view("admin/v_header");
        $this->load->view("admin/v_invoice_edit",$data);
        $this->load->view("admin/v_footer");
	}
	
	public function konfirmasiPenerimaanBarang(){
		$nomor_invoice = $this->input->post("nomor_invoice"); 
		$confirmation = $this->input->post("confirmation"); 
		if ($confirmation == "ya"){
			$email = $this->input->post("email_user");
			$messages = "
				<!DOCTYPE html>
				<html>
				<head>
				<title>Meldi Store</title>
				
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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

						.padding-copy {
							padding: 10px 5% 10px 5% !important;
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
					Detail Order Pembelian Kamu
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
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<!-- COPY -->
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Pembelian anda sedang dikirim</td>
											</tr>
											<tr>
												<td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Pembayaran dengan nomor invoice <span style='color:green;'>'INV-00".$nomor_invoice."'</span> sudah dikonfirmasi dan sedang dalam proses pengiriman.</td>
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
						<td bgcolor='#ffffff' align='center'>
							<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											
											<tr>
												<td align='center'>
													<!-- BULLETPROOF BUTTON -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='center' style='padding-top: 25px;' class='padding'>
																<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
																	<tr>
																		<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."profile/invoice/".$nomor_invoice."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Lihat Detail Product</a></td>
																	</tr>
																</table>
															
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
					<tr><td><br><br></td></tr>
					<tr>
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td>
													<!-- COPY -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='left' style='padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;' class='padding-copy'>Terima kasih telah berbelanja di Meldi Store, Kami tunggu pesanan anda selanjutnya :) </td>
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
				</html>";
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
						$this->email->subject('Your Product is being Shipped');
						$this->email->message($messages);
						$this->email->send();
						
						// php mailer :
						
			// 			$this->load->library('phpmailer_lib');
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
            // $mail->Subject = 'Receipt of Purchase';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
			
			$this->Admin_model->konfirmasi($nomor_invoice,"Sudah dikonfirmasi","Sedang dikirim");
		}else{
			$this->Admin_model->konfirmasi($nomor_invoice,"Sudah dikonfirmasi","Belum dikirim");
		}
				redirect(base_url("administrator"));
}

public function konfirmasiPenerimaanBarang2()
	{
		$nomor_invoice = $this->input->post("nomor_invoice"); 
		$confirmation = $this->input->post("confirmation"); 
		if ($confirmation == "ya"){
			$email = $this->input->post("email_user");
			$messages = "
				<!DOCTYPE html>
				<html>
				<head>
				<title>Meldi Store</title>
				
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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

						.padding-copy {
							 padding: 10px 5% 10px 5% !important;
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
					Detail Order Pembelian Kamu
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td style='background-color:white;' align='center'>
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
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<!-- COPY -->
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Anda sudah menerima produk yang dibeli</td>
											</tr>
											<tr>
												<td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Produk yang telah anda bayar dengan nomor invoice <span style='color:green;'>'INV-00".$nomor_invoice."'</span> sudah diterima.</td>
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
						<td bgcolor='#ffffff' align='center'>
							<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											
											<tr>
												<td align='center'>
													<!-- BULLETPROOF BUTTON -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='center' style='padding-top: 25px;' class='padding'>
																<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
																	<tr>
																		<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."profile/invoice/".$nomor_invoice."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Lihat Detail Product</a></td>
																	</tr>
																</table>
															
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
					<tr><td><br><br></td></tr>
					<tr>
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td>
													<!-- COPY -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='left' style='padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;' class='padding-copy'>Terima kasih telah berbelanja di Meldi Store, Kami tunggu pesanan anda selanjutnya :) </td>
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
				</html>";
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
            $this->email->subject('Receipt of Purchase');
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
            // $mail->Subject = 'Receipt of Purchase';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
			
			$this->Admin_model->konfirmasi($nomor_invoice,"Sudah dikonfirmasi","Sudah diterima");
		}
        redirect(base_url("administrator"));
	}



	public function konfirmasiPembayaran(){
		
		$nomor_invoice = $this->input->post("nomor_invoice"); 
		$confirmation = $this->input->post("confirmation"); 
		$pengiriman2 = $this->input->post("pengiriman2"); 
		if ($confirmation == "ya" && $pengiriman2 == "ya"){
			
			$email = $this->input->post("email_user");
			$messages = "
				<!DOCTYPE html>
				<html>
				<head>
				<title>Meldi Store</title>
				
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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

						.padding-copy {
							 padding: 10px 5% 10px 5% !important;
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
					Detail Order Pembelian Kamu
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td style='background-color:white;' align='center'>
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
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<!-- COPY -->
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Pembayaran Anda Sudah di Konfirmasi</td>
											</tr>
											<tr>
												<td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Pembayaran anda dengan nomor invoice <span style='color:green;'>'INV-00".$nomor_invoice."'</span> sudah dikonfirmasi dan sedang <span style='color:green;'>di kirim</span>  ke alamat anda. Harap bersabar yaa, terima kasih.</td>
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
						<td bgcolor='#ffffff' align='center'>
							<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											
											<tr>
												<td align='center'>
													<!-- BULLETPROOF BUTTON -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='center' style='padding-top: 25px;' class='padding'>
																<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
																	<tr>
																		<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."profile/invoice/".$nomor_invoice."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Lihat Detail Product</a></td>
																	</tr>
																</table>
															
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
					<tr><td><br><br></td></tr>
					<tr>
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td>
													<!-- COPY -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='left' style='padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;' class='padding-copy'>Terima kasih telah berbelanja di Meldi Store, Kami tunggu pesanan anda selanjutnya :) </td>
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
				</html>";
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
            $this->email->subject('Your Payment has been Confirmed and The Product is being Sent');
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
            // $mail->Subject = 'Your Payment has been Confirmed and The Product is being Sent';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
			
			
			$this->Admin_model->konfirmasi($nomor_invoice,"Sudah dikonfirmasi","Sedang dikirim");
		}
		if ($confirmation == "ya" && $pengiriman2 == "tidak"){
			$email = $this->input->post("email_user");
			$messages = "
				<!DOCTYPE html>
				<html>
				<head>
				<title>Meldi Store</title>
				
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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

						.padding-copy {
							 padding: 10px 5% 10px 5% !important;
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
					Detail Order Pembelian Kamu
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td style='background-color:white;' align='center'>
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
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<!-- COPY -->
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Pembayaran Anda Sudah di Konfirmasi</td>
											</tr>
											<tr>
												<td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Pembayaran anda dengan nomor invoice <span style='color:green;'>'INV-00".$nomor_invoice."'</span> sudah dikonfirmasi, namun belum  <span style='color:red;'>di kirim</span>  ke alamat anda. Harap bersabar yaa, terima kasih.</td>
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
						<td bgcolor='#ffffff' align='center'>
							<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											
											<tr>
												<td align='center'>
													<!-- BULLETPROOF BUTTON -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='center' style='padding-top: 25px;' class='padding'>
																<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
																	<tr>
																		<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."profile/invoice/".$nomor_invoice."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Lihat Detail Product</a></td>
																	</tr>
																</table>
															
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
					<tr><td><br><br></td></tr>
					<tr>
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td>
													<!-- COPY -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='left' style='padding: 0 0 0 0; font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color: #aaaaaa; font-style: italic;' class='padding-copy'>Terima kasih telah berbelanja di Meldi Store, Kami tunggu pesanan anda selanjutnya :) </td>
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
				</html>";
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
            $this->email->subject('Your Payment Confirmation');
            $this->email->message($messages);
            $this->email->send();
            
            //php mailer:
            
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
            // $mail->Subject = 'Your Payment Confirmation';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
			
			
			$this->Admin_model->konfirmasi($nomor_invoice,"Sudah dikonfirmasi","Belum dikirim");
		}
		if ($confirmation == "tidak"){
			
			$email = $this->input->post("email_user");
			$messages = "
				<!DOCTYPE html>
				<html>
				<head>
				<title>Meldi Store</title>
				
				<meta charset='utf-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1'>
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

						.padding-copy {
							 padding: 10px 5% 10px 5% !important;
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
					Pembayaran tidak Diterima
				</div>

				<!-- HEADER -->
				<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					<tr>
						<td style='background-color:white;' align='center'>
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
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<!-- COPY -->
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Pembayaran Anda Tidak Kami Terima</td>
											</tr>
											<tr>
												<td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Mohon maaf, Pembayaran anda dengan nomor invoice <span style='color:red;'>'INV-00".$nomor_invoice."'</span> tidak kami terima, Karena bukti pembayaran yang anda kirim <span style='color:red;'>Salah</span>. Silahkan kirim kembali bukti pembayaran anda.</td>
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
						<td bgcolor='#ffffff' align='center'>
							<table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											
											<tr>
												<td align='center'>
													<!-- BULLETPROOF BUTTON -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
														<tr>
															<td align='center' style='padding-top: 25px;' class='padding'>
																<table border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'>
																	<tr>
																		<td align='center' style='border-radius: 3px;' bgcolor='#256F9C'><a href='".base_url()."profile/invoice/".$nomor_invoice."' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; border-radius: 3px; padding: 15px 25px; border: 1px solid #256F9C; display: inline-block;' class='mobile-button'>Lihat Detail Product</a></td>
																	</tr>
																</table>
															
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
					<tr><td><br><br></td></tr>
					<tr>
						<td bgcolor='#ffffff' align='center' style='padding: 15px;'>
							<!--[if (gte mso 9)|(IE)]>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
							<tr>
							<td align='center' valign='top' width='500'>
							<![endif]-->
							<table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
								<tr>
									<td>
										<table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tr>
												<td>
													<!-- COPY -->
													<table width='100%' border='0' cellspacing='0' cellpadding='0'>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
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
				</html>";
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
            $this->email->subject('Your Payment is not Accepted!');
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
            // $mail->Subject = 'Your Payment is not Accepted!';
            // $mail->isHTML(true);
            // $mail->Body = $messages;
            // $mail->send();
			
			$this->Admin_model->konfirmasi($nomor_invoice,"Bukti Transfer Salah","-");
		}
		
        redirect(base_url("administrator"));
	}
}
