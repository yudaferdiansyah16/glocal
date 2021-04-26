<?php
die('This file is used for development purposes only.');
/**
 * PhpStorm Code Completion to CodeIgniter + HMVC
 *
 * @package       CodeIgniter
 * @subpackage    PhpStorm
 * @category      Code Completion
 * @version       3.1.4
 * @author        Natan Felles
 * @link          http://github.com/natanfelles/codeigniter-phpstorm
 */

/*
 * To enable code completion to your own libraries add a line above each class as follows:
 *
 * @property Library_name       $library_name                        Library description
 *
 */

/**
 * @property CI_Benchmark        $benchmark                           This class enables you to mark points and calculate the time difference between them. Memory consumption can also be displayed.
 * @property CI_Calendar         $calendar                            This class enables the creation of calendars
 * @property CI_Cache            $cache                               Caching Class
 * @property CI_Cart             $cart                                Shopping Cart Class
 * @property CI_Config           $config                              This class contains functions that enable config files to be managed
 * @property CI_Controller       $master                          This class object is the super class that every library in CodeIgniter will be assigned to
 * @property CI_DB_forge         $dbforge                             Database Forge Class
 * @property CI_DB_mysql_driver|CI_DB_query_builder $db                                  This is the platform-independent base Query Builder implementation class
 * @property CI_DB_utility       $dbutil                              Database Utility Class
 * @property CI_Driver_Library   $driver                              Driver Library Class
 * @property CI_Email            $email                               Permits email to be sent using Mail, Sendmail, or SMTP
 * @property CI_Encrypt          $encrypt                             Provides two-way keyed encoding using Mcrypt
 * @property CI_Encryption       $encryption                          Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions
 * @property CI_Exceptions       $exceptions                          Exceptions Class
 * @property CI_Form_validation  $form_validation                     Form Validation Class
 * @property CI_FTP              $ftp                                 FTP Class
 * @property CI_Hooks            $hooks                               Provides a mechanism to extend the base system without hacking
 * @property CI_Image_lib        $image_lib                           Image Manipulation class
 * @property CI_Input            $input                               Pre-processes global input data for security
 * @property CI_Javascript       $javascript                          Javascript Class
 * @property CI_Jquery           $jquery                              Jquery Class
 * @property CI_Lang             $lang                                Language Class
 * @property CI_Loader           $load                                Loads framework components
 * @property CI_Log              $log                                 Logging Class
 * @property CI_Migration        $migration                           All migrations should implement this, forces up() and down() and gives access to the CI super-global
 * @property CI_Model            $model                               CodeIgniter Model Class
 * @property CI_Output           $output                              Responsible for sending final output to the browser
 * @property CI_Pagination       $pagination                          Pagination Class
 * @property CI_Parser           $parser                              Parser Class
 * @property CI_Profiler          $profiler                             This class enables you to display benchmark, query, and other data in order to help with debugging and optimization.
 * @property CI_Router           $router                              Parses URIs and determines routing
 * @property CI_Security         $security                            Security Class
 * @property CI_Session          $session                             Session Class
 * @property CI_Table            $table                               Lets you create tables manually or from database result objects, or arrays
 * @property CI_Trackback        $trackback                           Trackback Sending/Receiving Class
 * @property CI_Typography       $typography                          Typography Class
 * @property CI_Unit_test        $unit                                Simple testing class
 * @property CI_Upload           $upload                              File Uploading Class
 * @property CI_URI              $uri                                 Parses URIs and determines routing
 * @property CI_User_agent       $agent                               Identifies the platform, browser, robot, or mobile device of the browsing agent
 * @property CI_Xmlrpc           $xmlrpc                              XML-RPC request handler class
 * @property CI_Xmlrpcs          $xmlrpcs                             XML-RPC server class
 * @property CI_Zip              $zip                                 Zip Compression Class
 * @property CI_Utf8             $utf8                                Provides support for UTF-8 environments
 *
 * @property	Mm_akun	$mm_akun
 * @property	Mm_asal_fasilitas	$mm_asal_fasilitas
 * @property	Mm_asset	$mm_asset
 * @property	Mm_bagian	$mm_bagian
 * @property	Mm_barang	$mm_barang
 * @property	Mm_brand	$mm_brand
 * @property	Mm_class	$mm_class
 * @property	Mm_detail_supplier_destination	$mm_detail_supplier_destination
 * @property	Mm_fasilitas	$mm_fasilitas
 * @property	Mm_grup_akun	$mm_grup_akun
 * @property	Mm_gudang	$mm_gudang
 * @property	Mm_hs	$mm_hs
 * @property	Mm_jenis_job	$mm_jenis_job
 * @property	Mm_jenis_laporan	$mm_jenis_laporan
 * @property	Mm_jenis_laporan_keuangan	$mm_jenis_laporan_keuangan
 * @property	Mm_jenis_mutasi	$mm_jenis_mutasi
 * @property	Mm_jenis_pp	$mm_jenis_pp
 * @property	Mm_jenis_pp_rutinitas	$mm_jenis_pp_rutinitas
 * @property	Mm_kategori	$mm_kategori
 * @property	Mm_konversi	$mm_konversi
 * @property	Mm_manager_plant	$mm_manager_plant
 * @property	Mm_menu	$mm_menu
 * @property	Mm_mesin	$mm_mesin
 * @property	Mm_mutasi	$mm_mutasi
 * @property	Mm_no_doc	$mm_no_doc
 * @property	Mm_part	$mm_part
 * @property	Mm_point	$mm_point
 * @property	Mm_payment_term	$mm_payment_term
 * @property	Mm_priv	$mm_priv
 * @property	Mm_sbu	$mm_sbu
 * @property	Mm_status	$mm_status
 * @property	Mm_style	$mm_style
 * @property	Mm_sub_barang	$mm_sub_barang
 * @property	Mm_tipe_akun	$mm_tipe_akun
 * @property	Mm_tipe_depresiasi	$mm_tipe_depresiasi
 * @property	Mm_tipe_sales	$mm_tipe_sales
 * @property	Mm_user	$mm_user
 * @property	Mm_workflow	$mm_workflow
 * @property	Mprivilege_menu	$mprivilege_menu
 * @property	Mreferensi_asal_barang	$mreferensi_asal_barang
 * @property	Mreferensi_asal_data	$mreferensi_asal_data
 * @property	Mreferensi_asuransi	$mreferensi_asuransi
 * @property	Mreferensi_cara_angkut	$mreferensi_cara_angkut
 * @property	Mreferensi_cara_bayar	$mreferensi_cara_bayar
 * @property	Mreferensi_daerah	$mreferensi_daerah
 * @property	Mreferensi_dokumen	$mreferensi_dokumen
 * @property	Mreferensi_dokumen_pabean	$mreferensi_dokumen_pabean
 * @property	Mreferensi_fasilitas	$mreferensi_fasilitas
 * @property	Mreferensi_filter_komunikasi	$mreferensi_filter_komunikasi
 * @property	Mreferensi_harga	$mreferensi_harga
 * @property	Mreferensi_jenis_api	$mreferensi_jenis_api
 * @property	Mreferensi_jenis_bc25	$mreferensi_jenis_bc25
 * @property	Mreferensi_jenis_jaminan	$mreferensi_jenis_jaminan
 * @property	Mreferensi_jenis_kendaraan	$mreferensi_jenis_kendaraan
 * @property	Mreferensi_jenis_nilai	$mreferensi_jenis_nilai
 * @property	Mreferensi_jenis_pemasukan01	$mreferensi_jenis_pemasukan01
 * @property	Mreferensi_jenis_pemasukan02	$mreferensi_jenis_pemasukan02
 * @property	Mreferensi_jenis_tanda_pengaman	$mreferensi_jenis_tanda_pengaman
 * @property	Mreferensi_jenis_tarif	$mreferensi_jenis_tarif
 * @property	Mreferensi_jenis_tpb	$mreferensi_jenis_tpb
 * @property	Mreferensi_kantor_pabean	$mreferensi_kantor_pabean
 * @property	Mreferensi_kapal	$mreferensi_kapal
 * @property	Mreferensi_kategori_barang	$mreferensi_kategori_barang
 * @property	Mreferensi_kategori_barangbc25	$mreferensi_kategori_barangbc25
 * @property	Mreferensi_kemasan	$mreferensi_kemasan
 * @property	Mreferensi_kode_barang	$mreferensi_kode_barang
 * @property	Mreferensi_kode_guna	$mreferensi_kode_guna
 * @property	Mreferensi_kode_id	$mreferensi_kode_id
 * @property	Mreferensi_komoditi	$mreferensi_komoditi
 * @property	Mreferensi_kondisi_barang	$mreferensi_kondisi_barang
 * @property	Mreferensi_lokasi_bayar	$mreferensi_lokasi_bayar
 * @property	Mreferensi_negara	$mreferensi_negara
 * @property	Mreferensi_pelabuhan	$mreferensi_pelabuhan
 * @property	Mreferensi_pemasok	$mreferensi_pemasok
 * @property	Mreferensi_pembayar	$mreferensi_pembayar
 * @property	Mreferensi_pengusaha	$mreferensi_pengusaha
 * @property	Mreferensi_pos_tarif	$mreferensi_pos_tarif
 * @property	Mreferensi_pungutan	$mreferensi_pungutan
 * @property	Mreferensi_respon	$mreferensi_respon
 * @property	Mreferensi_satuan	$mreferensi_satuan
 * @property	Mreferensi_skema_tarif	$mreferensi_skema_tarif
 * @property	Mreferensi_status	$mreferensi_status
 * @property	Mreferensi_status_pengusaha	$mreferensi_status_pengusaha
 * @property	Mreferensi_tarif_fasilitas	$mreferensi_tarif_fasilitas
 * @property	Mreferensi_tipe_kontainer	$mreferensi_tipe_kontainer
 * @property	Mreferensi_tps	$mreferensi_tps
 * @property	Mreferensi_tujuan_pemasukan	$mreferensi_tujuan_pemasukan
 * @property	Mreferensi_tujuan_pengiriman	$mreferensi_tujuan_pengiriman
 * @property	Mreferensi_tujuan_tpb	$mreferensi_tujuan_tpb
 * @property	Mreferensi_tutup_pu	$mreferensi_tutup_pu
 * @property	Mreferensi_ukuran_kontainer	$mreferensi_ukuran_kontainer
 * @property	Mreferensi_validasi	$mreferensi_validasi
 * @property	Mreferensi_valuta	$mreferensi_valuta
 * @property	Msetting_aplikasi	$msetting_aplikasi
 * @property	Mt_bom	$mt_bom
 * @property	Mt_bom_detail	$mt_bom_detail
 * @property	Mt_bom_produksi	$mt_bom_produksi
 * @property	Mt_bom_workflow	$mt_bom_workflow
 * @property	Mt_buffer_stock	$mt_buffer_stock
 * @property	Mt_dn	$mt_delivery_note
 * @property	Mt_detail_dn	$mt_detail_dn
 * @property	Mt_detail_job	$mt_detail_job
 * @property	Mt_detail_line_history	$mt_detail_line_history
 * @property	Mt_detail_po	$mt_detail_po
 * @property	Mt_detail_pp	$mt_detail_pp
 * @property	Mt_detail_spk	$mt_detail_spk
 * @property	Mt_detail_stuffing	$mt_detail_stuffing
 * @property	Mt_invoice	$mt_invoice
 * @property	Mt_job	$mt_job
 * @property	Mt_line	$mt_line
 * @property	Mt_packing_list	$mt_packing_list
 * @property	Mt_po	$mt_po
 * @property	Mt_pp	$mt_pp
 * @property	Mt_so	$mt_so
 * @property	Mt_detail_so	$mt_detail_so
 * @property	Mt_main_so	$mt_main_so
 * @property	Mt_main_so_detail	$mt_main_so_detail
 * @property	Mt_production	$mt_production
 * @property	Mt_spk	$mt_spk
 * @property	Mt_stuffing	$mt_stuffing
 * @property	Mt_wh	$mt_transaksi_warehouse
 * @property	Mtpb_approval	$mtpb_approval
 * @property	Mtpb_bahan_baku	$mtpb_bahan_baku
 * @property	Mtpb_bahan_baku_dokumen	$mtpb_bahan_baku_dokumen
 * @property	Mtpb_bahan_baku_tarif	$mtpb_bahan_baku_tarif
 * @property	Mtpb_barang	$mtpb_barang
 * @property	Mtpb_barang_dokumen	$mtpb_barang_dokumen
 * @property	Mtpb_barang_penerima	$mtpb_barang_penerima
 * @property	Mtpb_barang_tarif	$mtpb_barang_tarif
 * @property	Mtpb_detil_status	$mtpb_detil_status
 * @property	Mtpb_dokumen	$mtpb_dokumen
 * @property	Mtpb_dokumen_detail	$mtpb_dokumen_detail
 * @property	Mtpb_header	$mtpb_header
 * @property	Mtpb_jaminan	$mtpb_jaminan
 * @property	Mtpb_kemasan	$mtpb_kemasan
 * @property	Mtpb_kontainer	$mtpb_kontainer
 * @property	Mtpb_npwp_billing	$mtpb_npwp_billing
 * @property	Mtpb_penerima	$mtpb_penerima
 * @property	Mtpb_pungutan	$mtpb_pungutan
 * @property	Mtpb_respon	$mtpb_respon
 * @property	Texim_transaksidoc_in	$texim_posting_in
 * @property	Texim_transaksidoc_out	$texim_posting_out
 * @property	Tprocurement_approval_po	$tprocurement_approval_po
 * @property	Tprocurement_approval_pr	$tprocurement_approval_pr
 * @property	Tprocurement_cancel_po	$tprocurement_cancel_po
 * @property	Tprocurement_cancel_pr	$tprocurement_cancel_pr
 * @property	Tprocurement_closing_po	$tprocurement_closing_po
 * @property	Tprocurement_closing_pr	$tprocurement_closing_pr
 * @property	Mt_delivery_note_	$tprocurement_delivery_note_po
 * @property	Tprocurement_purchase_order	$tprocurement_purchase_order
 * @property	Tprocurement_purchase_requisition	$tprocurement_purchase_requisition
 * @property	Tprocurement_reporting_po	$tprocurement_reporting_po
 * @property	Tprocurement_reporting_pr	$tprocurement_reporting_pr
 * @property	Tproduction_request	$tproduction_request
 * @property	Tproduction_detail_request	$tproduction_detail_request
 * @property	Tproduction_realisasi_request	$tproduction_realisasi_request
 * @property	Tproduction_return_request	$tproduction_return_request
 * @property	Twarehouse_approval_request	$twarehouse_approval_request
 * @property	Twarehouse_detail_approval_request	$twarehouse_detail_approval_request
 * @property	Twarehouse_realisasi_request	$twarehouse_realisasi_request
 * @property	Twarehouse_return_request	$twarehouse_return_request
 * @property	Twarehouse_detail_realisasi_request	$twarehouse_detail_realisasi_request
 *
 */

class CI_Controller {

    public function __construct()
    {
    }
}

/**
 * @property CI_Benchmark        $benchmark                           This class enables you to mark points and calculate the time difference between them. Memory consumption can also be displayed.
 * @property CI_Calendar         $calendar                            This class enables the creation of calendars
 * @property CI_Cache            $cache                               Caching Class
 * @property CI_Cart             $cart                                Shopping Cart Class
 * @property CI_Config           $config                              This class contains functions that enable config files to be managed
 * @property CI_Controller       $master                          This class object is the super class that every library in CodeIgniter will be assigned to
 * @property CI_DB_forge         $dbforge                             Database Forge Class
 * @property CI_DB_mysql_driver|CI_DB_query_builder $db                                  This is the platform-independent base Query Builder implementation class
 * @property CI_DB_utility       $dbutil                              Database Utility Class
 * @property CI_Driver_Library   $driver                              Driver Library Class
 * @property CI_Email            $email                               Permits email to be sent using Mail, Sendmail, or SMTP
 * @property CI_Encrypt          $encrypt                             Provides two-way keyed encoding using Mcrypt
 * @property CI_Encryption       $encryption                          Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions
 * @property CI_Exceptions       $exceptions                          Exceptions Class
 * @property CI_Form_validation  $form_validation                     Form Validation Class
 * @property CI_FTP              $ftp                                 FTP Class
 * @property CI_Hooks            $hooks                               Provides a mechanism to extend the base system without hacking
 * @property CI_Image_lib        $image_lib                           Image Manipulation class
 * @property CI_Input            $input                               Pre-processes global input data for security
 * @property CI_Javascript       $javascript                          Javascript Class
 * @property CI_Jquery           $jquery                              Jquery Class
 * @property CI_Lang             $lang                                Language Class
 * @property CI_Loader           $load                                Loads framework components
 * @property CI_Log              $log                                 Logging Class
 * @property CI_Migration        $migration                           All migrations should implement this, forces up() and down() and gives access to the CI super-global
 * @property CI_Model            $model                               CodeIgniter Model Class
 * @property CI_Output           $output                              Responsible for sending final output to the browser
 * @property CI_Pagination       $pagination                          Pagination Class
 * @property CI_Parser           $parser                              Parser Class
 * @property CI_Profiler         $profiler                            This class enables you to display benchmark, query, and other data in order to help with debugging and optimization.
 * @property CI_Router           $router                              Parses URIs and determines routing
 * @property CI_Security         $security                            Security Class
 * @property CI_Session          $session                             Session Class
 * @property CI_Table            $table                               Lets you create tables manually or from database result objects, or arrays
 * @property CI_Trackback        $trackback                           Trackback Sending/Receiving Class
 * @property CI_Typography       $typography                          Typography Class
 * @property CI_Unit_test        $unit                                Simple testing class
 * @property CI_Upload           $upload                              File Uploading Class
 * @property CI_URI              $uri                                 Parses URIs and determines routing
 * @property CI_User_agent       $agent                               Identifies the platform, browser, robot, or mobile device of the browsing agent
 * @property CI_Xmlrpc           $xmlrpc                              XML-RPC request handler class
 * @property CI_Xmlrpcs          $xmlrpcs                             XML-RPC server class
 * @property CI_Zip              $zip                                 Zip Compression Class
 * @property CI_Utf8             $utf8                                Provides support for UTF-8 environments
 */
class CI_Model {

    public function __construct()
    {
    }
}

/**
 * @property CI_Benchmark        $benchmark                           This class enables you to mark points and calculate the time difference between them. Memory consumption can also be displayed.
 * @property CI_Calendar         $calendar                            This class enables the creation of calendars
 * @property CI_Cache            $cache                               Caching Class
 * @property CI_Cart             $cart                                Shopping Cart Class
 * @property CI_Config           $config                              This class contains functions that enable config files to be managed
 * @property CI_Controller       $master                          This class object is the super class that every library in CodeIgniter will be assigned to
 * @property CI_DB_forge         $dbforge                             Database Forge Class
 * @property CI_DB_mysql_driver|CI_DB_query_builder $db                                  This is the platform-independent base Query Builder implementation class
 * @property CI_DB_utility       $dbutil                              Database Utility Class
 * @property CI_Driver_Library   $driver                              Driver Library Class
 * @property CI_Email            $email                               Permits email to be sent using Mail, Sendmail, or SMTP
 * @property CI_Encrypt          $encrypt                             Provides two-way keyed encoding using Mcrypt
 * @property CI_Encryption       $encryption                          Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions
 * @property CI_Exceptions       $exceptions                          Exceptions Class
 * @property CI_Form_validation  $form_validation                     Form Validation Class
 * @property CI_FTP              $ftp                                 FTP Class
 * @property CI_Hooks            $hooks                               Provides a mechanism to extend the base system without hacking
 * @property CI_Image_lib        $image_lib                           Image Manipulation class
 * @property CI_Input            $input                               Pre-processes global input data for security
 * @property CI_Javascript       $javascript                          Javascript Class
 * @property CI_Jquery           $jquery                              Jquery Class
 * @property CI_Lang             $lang                                Language Class
 * @property CI_Loader           $load                                Loads framework components
 * @property CI_Log              $log                                 Logging Class
 * @property CI_Migration        $migration                           All migrations should implement this, forces up() and down() and gives access to the CI super-global
 * @property CI_Model            $model                               CodeIgniter Model Class
 * @property CI_Output           $output                              Responsible for sending final output to the browser
 * @property CI_Pagination       $pagination                          Pagination Class
 * @property CI_Parser           $parser                              Parser Class
 * @property CI_Profiler         $profiler                            This class enables you to display benchmark, query, and other data in order to help with debugging and optimization.
 * @property CI_Router           $router                              Parses URIs and determines routing
 * @property CI_Security         $security                            Security Class
 * @property CI_Session          $session                             Session Class
 * @property CI_Table            $table                               Lets you create tables manually or from database result objects, or arrays
 * @property CI_Trackback        $trackback                           Trackback Sending/Receiving Class
 * @property CI_Typography       $typography                          Typography Class
 * @property CI_Unit_test        $unit                                Simple testing class
 * @property CI_Upload           $upload                              File Uploading Class
 * @property CI_URI              $uri                                 Parses URIs and determines routing
 * @property CI_User_agent       $agent                               Identifies the platform, browser, robot, or mobile device of the browsing agent
 * @property CI_Xmlrpc           $xmlrpc                              XML-RPC request handler class
 * @property CI_Xmlrpcs          $xmlrpcs                             XML-RPC server class
 * @property CI_Zip              $zip                                 Zip Compression Class
 * @property CI_Utf8             $utf8                                Provides support for UTF-8 environments
 */
class MX_Controller {

    public function __construct()
    {
    }
}
