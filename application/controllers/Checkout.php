<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cart_model');
		$this->load->model('Checkout_model');
		error_reporting(E_ERROR|E_PARSE);
		if ($_SESSION["email"]==""){
            header("Location: ".base_url("login"));
        }
	}
	
	public function index()
	{
        
        $where = array(
			'id_user' => $this->session->userdata('id_user'),
			'nomor_invoice' => 101
        );

		$data["pemesanan"]=$this->Checkout_model->getPembayaran($whereCheck);
		
		$where = array(
			'id_user' => $this->session->userdata('id_user'),
			'nomor_invoice' => 101
		);
		$data["cart"]=$this->Cart_model->getCart($where)->result();
		
		$data["nav"]=1;
        
		$this->load->view('v_checkout',$data);
	}
	
	public function checkout(){
		$where = array(
			'id_user' => $this->session->userdata('id_user'),
			'nomor_invoice' => 101
		);
		$nomor = $this->Checkout_model->getNomor()->result();
		
		foreach ($nomor as $inv){
			$nomor_invoice = $inv->nomor_invoice;
		}
		
		$nomor_invoice = $nomor_invoice+1;

		$orderBiayaTotal = $this->input->post('totalZ');
		$orderBiayaPengiriman = $this->input->post('ongkirG');
		$orderBeratKeranjang = $this->input->post('beratG');
		$orderDurasiPengiriman = $this->input->post('durasiG');
		$orderKurir = $this->input->post('kurirG');
		$orderPaketKurir = $this->input->post('paketG');
		
		
		$orderProvinsi = $this->input->post('provGG');
		
		
		
		$orderKota = $this->input->post('kotaGG');
		
		$saya = $this->input->post('detailSaya');
		
		if ($saya == "saya"){
			$orderDetailAlamat = $this->input->post('detailG');
		}
		
		if ($saya == "baru"){
			$orderDetailAlamat = $this->input->post('newAddress');
		}
		
		$orderCatatan = $this->input->post('noteG');
		
		if ($orderCatatan == null){
			$oderCatatan = "Tidak ada";
		}
		
		$orderTanggalInvoice = date("h:i A, Y/m/d");
		
		$whereInsert = array(
			'nomor_invoice' => $nomor_invoice,
			'id_user' => $this->session->userdata('id_user'),
			'orderBiayaTotal' => $orderBiayaTotal,
			'orderBiayaPengiriman' => $orderBiayaPengiriman,
			'orderBeratKeranjang' => $orderBeratKeranjang,
			'orderDurasiPengiriman' => $orderDurasiPengiriman,
			'orderKurir' => $orderKurir,
			'orderPaketKurir' => $orderPaketKurir,
			'orderProvinsi' => $orderProvinsi,
			'orderKota' => $orderKota,
			'orderDetailAlamat' => $orderDetailAlamat,
			'orderCatatan' => $orderCatatan,
			'orderTanggalInvoice' => $orderTanggalInvoice,
			'status_pengiriman_barang' => '-',
			'status_pembayaran' => 'Belum dibayar'
		);
		
		$this->Checkout_model->ubahNomor($this->session->userdata('id_user'),$nomor_invoice);
		$this->Checkout_model->insert($whereInsert);
		redirect(base_url("profile/invoice/".$nomor_invoice));
	}
	
	public function order()
	{
		$nomor_invoice = $this->input->post('nomor');

		$gambar = $_FILES['gambar']['name'];

		$config = array(
	    'upload_path' => "./assets/bukti/",
	    'allowed_types' => "jpg|png|jpeg",
	    'overwrite' => FALSE,
	    'max_size' => "3000000", //File Size
	    'max_height' => "30000",
	    'max_width' => "30000"
	    );
		$this->load->library('upload', $config);
		$this->upload->do_upload('gambar');

		$email = $this->session->userdata('email');
		
		$berat = $this->input->post('berat');
		$ongkir = $this->input->post('ongkir');
		$subtotal = $this->input->post('subtotal');
		$total = $this->input->post('total');
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
			                                <td align='center' style='font-size: 32px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Pembayaran Anda Sudah Kami Terima</td>
			                            </tr>
			                            <tr>
			                                <td align='justify' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Kami akan segera mengkonfirmasi pembelian anda dengan nomor invoice <span style='color:red;'>'INV-00".$nomor_invoice."'</span>. Jika bukti pembayaran anda salah, maka kami akan <span style='color:red;'>'Menolak'</span> pembelian anda.</td>
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
			        <td bgcolor='#ffffff' align='center' style='padding: 15px;' class='padding'>
			            <!--[if (gte mso 9)|(IE)]>
			            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
			            <tr>
			            <td align='center' valign='top' width='500'>
			            <![endif]-->
			            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
							<tr>
			                    <td>
			                        <!-- TWO COLUMNS -->
			                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
			                            <tr>
			                                <td valign='top' style='padding: 0;' class='mobile-wrapper'>
			                                    <!-- LEFT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='left'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='left' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>Berat Keranjang</td>
			                                                    </tr>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                    </table>
			                                    <!-- RIGHT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='right'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='right' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>".$berat." kg</td>
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
			                    <td>
			                        <!-- TWO COLUMNS -->
			                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
			                            <tr>
			                                <td valign='top' style='padding: 0;' class='mobile-wrapper'>
			                                    <!-- LEFT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='left'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='left' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>Ongkos Kirim</td>
			                                                    </tr>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                    </table>
			                                    <!-- RIGHT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='right'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='right' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>Rp. ".strrev(implode('.',str_split(strrev(strval($ongkir)),3)))."</td>
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
			                    <td style='padding: 10px 0 0 0; border-top: 1px dashed #aaaaaa;'>
			                        <!-- TWO COLUMNS -->
			                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
			                            <tr>
			                                <td valign='top' class='mobile-wrapper'>
			                                    <!-- LEFT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='left'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='left' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>Subtotal (Total Keranjang + PPN 5%)</td>
			                                                    </tr>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                    </table>
			                                    <!-- RIGHT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='right'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='right' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px;'>Rp. ".strrev(implode('.',str_split(strrev(strval($subtotal)),3)))."</td>
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
			                    <td style='padding: 10px 0 0px 0; border-top: 1px solid #eaeaea; border-bottom: 1px dashed #aaaaaa;'>
			                        <!-- TWO COLUMNS -->
			                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
			                            <tr>
			                                <td valign='top' class='mobile-wrapper'>
			                                    <!-- LEFT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='left'>
			                                        <tr>
			                                            <td style='padding: 0 0 10px 0;'>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='left' style='font-family: Arial, sans-serif; color: #333333; font-size: 16px; font-weight: bold;'>Total (Subtotal + Ongkir)</td>
			                                                    </tr>
			                                                </table>
			                                            </td>
			                                        </tr>
			                                    </table>
			                                    <!-- RIGHT COLUMN -->
			                                    <table cellpadding='0' cellspacing='0' border='0' width='47%' style='width: 47%;' align='right'>
			                                        <tr>
			                                            <td>
			                                                <table cellpadding='0' cellspacing='0' border='0' width='100%'>
			                                                    <tr>
			                                                        <td align='right' style='font-family: Arial, sans-serif; color: #7ca230; font-size: 16px; font-weight: bold;'>Rp. ".strrev(implode('.',str_split(strrev(strval($total)),3)))."</td>
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
			        </td>
			    </tr>
			    <tr>
			        <td bgcolor='#ffffff' align='center' style='padding: 15px;'>
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
            $this->email->subject('Your Payment Receipt');
            $this->email->message($messages);
            $this->email->send();

        //Php mailer
        
        // $this->load->library('phpmailer_lib');
        //     $mail = $this->phpmailer_lib->load();
        //     $mail->isSMTP();
        //     $mail->Host     = 'mail.bhinestorm.com';
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'meldi@bhinestorm.com';
        //     $mail->Password = 'meldi123';
        //     $mail->SMTPSecure = 'ssl';
        //     $mail->Port     = 465;
        //     $mail->setFrom('meldi@bhinestorm.com', 'Meldi Store');
        //     $mail->addReplyTo('meldi@bhinestorm.com', 'Meldi Store');
        //     $mail->addAddress($email);
        //     $mail->Subject = 'Your Payment Receipt';
        //     $mail->isHTML(true);
        //     $mail->Body = $messages;
        //     $mail->send();
		
		$gambar = str_replace(' ', '_', $gambar);
		$this->Checkout_model->orderProduct($this->session->userdata('id_user'),$nomor_invoice,$gambar);
		
		$this->session->set_flashdata('berhasil', "1");
		redirect(base_url("checkout/berhasil"));
	}


	public function berhasil(){
		if($this->session->flashdata("berhasil") == "1"){
			$this->load->view("v_header");
			$this->load->view("v_berhasil");
			$this->load->view("v_footer");
		}else{
			redirect(base_url("profile"));
		}
	}
}
?>